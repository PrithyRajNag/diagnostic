<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestItemRequest;
use App\Models\TestCategory;
use App\Models\TestItem;
use App\Repository\TestItemRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TestItemController extends Controller
{
    private $repository;
    public function __construct(TestItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function index(TestItemRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = TestItem::latest()->get();
                return DataTables::of($data)->addColumn('test_category_id',  function(TestItem $testItem) {
                        return  $testItem->testCategories->title ?? 'N/A';
                    }) ->addColumn('status', function ($row) {
                    if($row->status == 1) {
                        return '<span class="badge bg-success mb-1">' . ($row->status == 0 ? "Inactive" : "Active") . '</span>';
                    }else {
                        return '<span class="badge bg-danger mb-1">' . ($row->status == 0 ? "Inactive" : "Active") . '</span>';
                    }
                })

                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('test-item.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('test-item.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('test-item.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            return view('test.item.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        $categories = TestCategory::all();
        return view('test.item.create', ['categories' => $categories]);
    }

    public function store(TestItemRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated)
            {
                $data = $request->all();
                $this->repository->create($data);
                return redirect()->route('test-item.index')->with('success', 'Test Item Created Successfully');
            }
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-item.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $testItem = $this->repository->findByUuid($uuid);
        return view('test.item.info', ['testItem' => $testItem]);

    }


    public function edit($uuid)
    {
        $categories = TestCategory::all();
        $testItem = $this->repository->findByUuid($uuid);
        return view('test.item.edit', ['testItem' => $testItem, 'categories' => $categories]);
    }


    public function update(TestItemRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid, $data);
            return redirect()->route('test-item.index')->with('success', 'Test Item Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-item.index')->withErrors(['errors' => $exception->getMessage()]);
        }

    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('test-item.index')->with('success', 'Test Item Deleted Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-item.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
