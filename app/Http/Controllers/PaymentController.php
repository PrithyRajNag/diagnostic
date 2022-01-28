<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Account;
use App\Models\Payment;
use App\Repository\PaymentRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{
    private $repository;
    public function __construct(PaymentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(PaymentRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Payment::latest()->with(['accounts'])->get();

                return DataTables::of($data)
                    ->addColumn('account_name',  function($row) {
                        return  ucwords($row->accounts->account_name) ?? 'N/A';
                    })
                    ->editColumn('reference_number',  function($row) {
                        return  ucfirst($row->reference_number) ?? 'N/A';
                    })
                    ->editColumn('payment_date',  function($row) {
                        if ($row->due_payment_date != null){
                            return  $row->due_payment_date ?? 'N/A';
                        }
                        else{
                            return  $row->date ?? 'N/A';
                        }
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->status == "PAID") {
                            return '<span class="badge bg-success mb-1">' . ($row->status == "PAID" ? "Paid" : "Unpaid") . '</span>';
                        }elseif($row->status == "DUE") {
                            return '<span class="badge bg-warning mb-1">' . ($row->status == "DUE" ? "Due" : "Paid") . '</span>';
                        }
                        else {
                            return '<span class="badge bg-danger mb-1">' . ($row->status == "UNPAID" ? "Unpaid" : "Paid") . '</span>';
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('payment.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('payment.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('payment.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            return view('accountManager.payment.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }



    public function show($uuid)
    {
        $payment = $this->repository->findByUuid($uuid);
        return view('accountManager.payment.info', ['payment' => $payment]);

    }

    public function edit($uuid)
    {
        $accounts = Account::all();
        $payment = $this->repository->findByUuid($uuid);
        return view('accountManager.payment.edit', ['payment' => $payment, 'accounts' => $accounts]);
    }

    public function update(PaymentRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updatePayment($uuid,$data);
            return redirect()->route('payment.index')->with('success', 'Payment updated Successfully');
        }catch (Exception $exception)
        {
            return redirect()->route('payment.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteAccount($uuid);
            return redirect()->route('payment.index')->with('success', 'Payment Deleted Successfully');

        }catch (Exception $exception)
        {
            return redirect()->route('payment.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
