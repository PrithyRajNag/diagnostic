<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestResultItemRequest;
use App\Models\TestResultCategory;
use App\Models\TestResultItem;
use App\Repository\TestResultItemRepositoryInterface;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class TestResultItemController extends Controller
{
    private $repository;
    public function __construct(TestResultItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(TestResultItemRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = TestResultItem::latest()->get();
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
                        $btn = '<a href="' . route('test-result-item.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('test-result-item.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('test-result-item.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            return view('test.result.item.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function create()
    {
        $categories = TestResultCategory::all();
        return view('test.result.item.create', ['categories' => $categories]);
    }

    public function store(TestResultItemRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated)
            {
                $data = $request->all();
                $this->repository->create($data);
                return redirect()->route('test-result-item.index')->with('success', 'Test Result Item Created Successfully');
            }
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-result-item.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function show($uuid)
    {
        $testResultItem = $this->repository->findByUuid($uuid);
        return view('test.result.item.info', ['testResultItem' => $testResultItem]);
    }

    public function edit($uuid)
    {
        $categories = TestResultCategory::all();
        $testResultItem = $this->repository->findByUuid($uuid);
        return view('test.result.item.edit', ['testResultItem' => $testResultItem,'categories' => $categories]);
    }

    public function update(TestResultItemRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid, $data);
            return redirect()->route('test-result-item.index')->with('success', 'Test Result Item Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-result-item.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);

            return redirect()->route('test-result-item.index')->with('success', 'Test Result Item Deleted Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-result-item.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
