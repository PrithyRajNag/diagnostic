<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\LabRequest;
use App\Http\Requests\TestCategoryRequest;
use App\Models\Lab;
use App\Models\TestCategory;
use App\Repository\TestCategoryRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use League\Flysystem\Adapter\AbstractAdapter;
use Yajra\DataTables\Facades\DataTables;

class TestCategoryController extends Controller
{
    private $repository;
    public function __construct(TestCategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(TestCategoryRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = TestCategory::latest()->get();
                return DataTables::of($data)->addColumn('lab_id',  function(TestCategory $testCategory) {
                    return  $testCategory->labs->lab_name ?? 'N/A';
                })
                    ->addColumn('status', function ($row) {
                        if($row->status == 1) {
                            return '<span class="badge bg-success mb-1">' . ($row->status == 0 ? "Inactive" : "Active") . '</span>';
                        }else {
                            return '<span class="badge bg-danger mb-1">' . ($row->status == 0 ? "Inactive" : "Active") . '</span>';
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('test-category.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('test-category.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('test-category.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            return view('test.category.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        $labs = Lab::all();
        return view('test.category.create', ['labs' => $labs]);
    }

    public function store(TestCategoryRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated)
            {
                $data = $request->all();
                $this->repository->create($data);
                return redirect()->route('test-category.index')->with('success', 'Test Category Created Successfully');
            }
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-category.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $testCategory = $this->repository->findByUuid($uuid);
        return view('test.category.info', ['testCategory' => $testCategory]);

    }


    public function edit($uuid)
    {
        $labs = Lab::all();
        $testCategory = $this->repository->findByUuid($uuid);
        return view('test.category.edit', ['testCategory' => $testCategory, 'labs' => $labs]);
    }


    public function update(TestCategoryRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid, $data);
            return redirect()->route('test-category.index')->with('success', 'Test Category Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-category.index')->withErrors(['errors' => $exception->getMessage()]);
        }

    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);

            return redirect()->route('test-category.index')->with('success', 'Test Category Deleted Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-category.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
