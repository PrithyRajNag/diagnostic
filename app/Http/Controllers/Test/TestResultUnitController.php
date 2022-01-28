<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestResultUnitRequest;
use App\Models\TestResultUnit;
use App\Repository\TestResultUnitRepositoryInterface;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class TestResultUnitController extends Controller
{
    private $repository;
    public function __construct(TestResultUnitRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(TestResultUnitRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = TestResultUnit::latest()->get();
                return DataTables::of($data)
                    ->editColumn('description',  function($row) {
                        return ucwords($row->description ?? 'N/A');
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
                        $btn = '<a href="' . route('test-result-unit.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('test-result-unit.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('test-result-unit.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            return view('test.result.unit.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function create()
    {
        return view('test.result.unit.create');
    }

    public function store(TestResultUnitRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated)
            {
                $data = $request->all();
                $this->repository->create($data);
                return redirect()->route('test-result-unit.index')->with('success', 'Test Result Unit Created Successfully');
            }
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-result-unit.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function show($uuid)
    {
        $testResultUnit = $this->repository->findByUuid($uuid);
        return view('test.result.unit.info', ['testResultUnit' => $testResultUnit]);
    }

    public function edit($uuid)
    {
        $testResultUnit = $this->repository->findByUuid($uuid);
        return view('test.result.unit.edit', ['testResultUnit' => $testResultUnit]);
    }

    public function update(TestResultUnitRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid, $data);
            return redirect()->route('test-result-unit.index')->with('success', 'Test Result Unit Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-result-unit.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('test-result-unit.index')->with('success', 'Test Result Unit Deleted Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-result-unit.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
