<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{

    public function index()
    {
    }

    public function debit(ReportRequest $request)
    {
        try {
            $query = "SELECT t.account_id, t.payment_id , t.amount , t.payment_date, a.id as account_id,
                a.type , a.account_name, p.id  as payment_id,p.reference_number, p.total
                FROM transactions AS t
                INNER JOIN accounts AS a
                ON t.account_id = a.id AND a.type = 'DEBIT'
                INNER JOIN payments AS p
                ON t.payment_id = p.id";

            $query2 = "SELECT t.account_id, t.payment_id , t.amount , t.payment_date, a.id as account_id,
                a.type , a.account_name, p.id  as payment_id,p.reference_number, p.total
                FROM transactions AS t
                INNER JOIN accounts AS a
                ON t.account_id = a.id AND a.type = 'DEBIT'
                INNER JOIN payments AS p
                ON t.payment_id = p.id  AND t.payment_date BETWEEN '{$request->from_date}' AND '{$request->to_date}'";
            if ($request->ajax()) {
                if (empty($request->from_date) && empty($request->to_date)) {
                    return DataTables::of(DB::select($query))->make(true);
                } else {
                    return DataTables::of(DB::select($query2))->make(true);
                }
            }

            return view('accountManager.report.debit');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function credit(ReportRequest $request)
    {
        try {
            $query = "SELECT t.account_id, t.payment_id , t.amount , t.payment_date, a.id as account_id,
                a.type , a.account_name, p.id  as payment_id,p.reference_number, p.total
                FROM transactions AS t
                INNER JOIN accounts AS a
                ON t.account_id = a.id AND a.type = 'CREDIT'
                INNER JOIN payments AS p
                ON t.payment_id = p.id";

            $query2 = "SELECT t.account_id, t.payment_id , t.amount , t.payment_date, a.id as account_id,
                a.type , a.account_name, p.id  as payment_id,p.reference_number, p.total
                FROM transactions AS t
                INNER JOIN accounts AS a
                ON t.account_id = a.id AND a.type = 'CREDIT'
                INNER JOIN payments AS p
                ON t.payment_id = p.id" . "  AND t.payment_date BETWEEN '{$request->from_date}' AND '{$request->to_date}'";
            if ($request->ajax()) {
                if (empty($request->from_date) && empty($request->to_date)) {
                    return DataTables::of(DB::select($query))->make(true);
                } else {
                    return DataTables::of(DB::select($query2))->make(true);
                }
            }
            return view('accountManager.report.credit');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function getCredit($filter)

    {
        $start = $filter;
        $end = Carbon::now()->toDateString();
        $data = DB::select("SELECT t.account_id, t.payment_id , t.amount , t.payment_date, a.id as account_id,
                a.type , a.account_name, p.id  as payment_id,p.reference_number, p.total
                FROM transactions AS t
                INNER JOIN accounts AS a
                ON t.account_id = a.id AND a.type = 'CREDIT'
                INNER JOIN payments AS p
                ON t.payment_id = p.id  AND t.payment_date BETWEEN '" . $start . "' AND '" . $end . "' ");
        return $data;
        try {
            if ($request->ajax()) {

                return DataTables::of($data)
                    ->editColumn('payment_date', function ($row) {
                        return $row->payment_date ?? 'N/A';
                    })
                    ->editColumn('account_name', function ($row) {
                        return ucfirst($row->account_name) ?? 'N/A';
                    })
                    ->editColumn('reference_number', function ($row) {
                        return ucfirst($row->reference_number) ?? 'N/A';
                    })
                    ->editColumn('amount', function ($row) {
                        return $row->amount ?? 'N/A';
                    })
                    ->editColumn('pay_to', function ($row) {
                        return ucfirst($row->pay_to) ?? 'N/A';
                    })
                    ->addIndexColumn()
                    ->make(true);
            }
            return view('accountManager.report.credit');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
