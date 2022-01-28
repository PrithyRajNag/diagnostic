<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestReportTemplateRequest;
use App\Models\TestItem;
use App\Models\TestReportTemplate;
use App\Repository\TestReportTemplateRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TestReportTemplateController extends Controller
{
    private $repository;
    public function __construct(TestReportTemplateRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(TestReportTemplateRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = TestReportTemplate::latest()->get();
                return DataTables::of($data)
                    ->addColumn('test_item_id',  function($row) {
                    return  $row->testItems->test_name ?? 'N/A';
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
                        $btn = '<a href="' . route('test-report-template.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('test-report-template.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('test-report-template.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            return view('test.result.template.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function create()
    {
        $items = TestItem::all();
        return view('test.result.template.create', ['items' => $items]);
    }

    public function store(TestReportTemplateRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated)
            {
                $data = $request->all();
                $this->repository->create($data);
                return redirect()->route('test-report-template.index')->with('success', 'Test Report Template Created Successfully');
            }
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-report-template.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function show($uuid)
    {
        $template = $this->repository->findByUuid($uuid);
        return view('test.result.template.info', ['template' => $template]);

    }


    public function edit($uuid)
    {
        $items = TestItem::all();
        $template = $this->repository->findByUuid($uuid);
        return view('test.result.template.edit', ['items' => $items, 'template' => $template]);
    }


    public function update(TestReportTemplateRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid, $data);
            return redirect()->route('test-report-template.index')->with('success', 'Test Report Template Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-report-template.index')->withErrors(['errors' => $exception->getMessage()]);
        }

    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('test-report-template.index')->with('success', 'Test Report Template Deleted Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('test-report-template.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
