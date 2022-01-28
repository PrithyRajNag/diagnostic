<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\TestReport;
use App\Repository\TestReportRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TestReportRepository extends BaseRepository implements TestReportRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(TestReport $model)
    {
        $this->model = $model;
    }

    public function createReport($payload)
    {
        $report = new TestReport();
        $report->invoice_number = $payload['invoice_number'];
        $report->pid = $payload['pid'];
        $report->first_name =$payload['first_name'];
        $report->last_name =$payload['last_name'];
        $report->invoice_date =$payload['invoice_date'];
        $report->delivery_date =$payload['delivery_date'];
        $report->phone_number =$payload['phone_number'];
        $report->test_item_id =$payload['test_item_id'];
        $report->report_name =$payload['report_name'];
        $report->report =$payload['report'];
        $report->status =$payload['status'];
        $report->issuer = auth()->user()->profile->full_name;

        $report->save();
    }

    public function updateReport($uuid,$payload)
    {
        $report = TestReport::where('uuid',$uuid)->first();
        $report->invoice_number = $payload['invoice_number'];
        $report->pid = $payload['pid'];
        $report->first_name =$payload['first_name'];
        $report->last_name =$payload['last_name'];
        $report->invoice_date =$payload['invoice_date'];
        $report->delivery_date =$payload['delivery_date'];
        $report->phone_number =$payload['phone_number'];
        $report->test_item_id =$payload['test_item_id'];
        $report->report_name =$payload['report_name'];
        $report->report =$payload['report'];
        $report->status =$payload['status'];
        $report->issuer = auth()->user()->profile->full_name;

        $report->save();
    }
}
