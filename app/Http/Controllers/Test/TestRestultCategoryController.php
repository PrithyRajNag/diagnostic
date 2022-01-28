<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestResultCategoryRequest;
use App\Models\TestResultCategory;
use App\Repository\TestResultCategoryRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TestRestultCategoryController extends Controller
{
    private $repository;
    public function __construct(TestResultCategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(TestResultCategoryRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = TestResultCategory::latest()->get();
                return DataTables::of($data)
                    ->editColumn('reference',  function($row) {
                        return ucwords($row->reference ?? 'N/A');
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
                        $btn = '<a href="' . route('test-result-category.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('test-result-category.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('test-result-category.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            return view('test.result.category.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        return view('test.result.category.create');
    }

    public function store(TestResultCategoryRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated)
            {
                $data = $request->all();
                $this->repository->create($data);
                return redirect()->route('test-result-category.index')->with('success', 'Test Result Category Created Successfully');
            }
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-result-category.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $testResultCategory = $this->repository->findByUuid($uuid);
        return view('test.result.category.info', ['testResultCategory' => $testResultCategory]);
    }


    public function edit($uuid)
    {
        $testResultCategory = $this->repository->findByUuid($uuid);
        return view('test.result.category.edit', ['testResultCategory' => $testResultCategory]);
    }


    public function update(TestResultCategoryRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid, $data);
            return redirect()->route('test-result-category.index')->with('success', 'Test Result Category Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-result-category.index')->withErrors(['errors' => $exception->getMessage()]);
        }

    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);

            return redirect()->route('test-result-category.index')->with('success', 'Test Result Category Deleted Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-result-category.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
