<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestReportRequest;
use App\Models\TestInvoice;
use App\Models\TestItem;
use App\Models\TestReport;
use App\Models\TestReportTemplate;
use App\Repository\TestReportRepositoryInterface;
use Exception;
use Yajra\DataTables\Facades\DataTables;



class TestReportController extends Controller
{
    private $repository;

    public function __construct(TestReportRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function index(TestReportRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = TestReport::latest()->get();
                return DataTables::of($data)
                    ->addColumn('status', function ($row) {
                        if ($row->status == "PROCESSING") {
                            return '<span class="badge bg-primary mb-1">' . ($row->status == "PROCESSING" ? "PROCESSING" : "DELIVERED") . '</span>';
                        } elseif ($row->status == "DONE") {
                            return '<span class="badge bg-warning mb-1">' . ($row->status == "DONE" ? "DONE" : "DELIVERED") . '</span>';
                        } else {
                            return '<span class="badge bg-success mb-1">' . ($row->status == "DELIVERED" ? "DELIVERED" : "PROCESSING") . '</span>';
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('test-report.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('test-report.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('test-report.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            return view('test.result.report.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function create()
    {
        $testItems = TestItem::all();
        return view('test.result.report.create', ['testItems' => $testItems]);
    }

    public function store(TestReportRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated) {
                if (auth()->user()->profile != null) {
                    $data = $request->all();
                    $this->repository->createReport($data);
                    return redirect()->route('test-report.index')->with('success', 'Test Result Report Created Successfully');
                } else {
                    throw new Exception('User does not have a name in system');
                }
            }
        } catch (Exception $exception) {
            return redirect()->route('test-report.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function edit($uuid)
    {
        $items = TestItem::all();
        $report = $this->repository->findByUuid($uuid);
        return view('test.result.report.edit', ['items' => $items, 'report' => $report]);
    }


    public function update(TestReportRequest $request, $uuid)
    {
        try {
            if (auth()->user()->profile != null) {
                $data = $request->all();
                $this->repository->updateReport($uuid, $data);
                return redirect()->route('test-report.index')->with('success', 'Test Report Updated Successfully');
            } else {
                throw new Exception('User does not have a name in system');
            }
        } catch (Exception $exception) {
            return redirect()->route('test-report.index')->withErrors(['errors' => $exception->getMessage()]);
        }

    }

    public function show($uuid)
    {
        $report = $this->repository->findByUuid($uuid);
        return view('test.result.report.info', ['report' => $report]);

    }

    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('test-report.index')->with('success', 'Test Report Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('test-report.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function findPatientByInvoice($number)
    {
        $invoice = TestInvoice::where('invoice_number', $number)->first();
        return $invoice;
    }

    public function findTemplate($test)
    {
        $template = TestReportTemplate::where('test_item_id', $test)->first();
        return $template;
    }
}
