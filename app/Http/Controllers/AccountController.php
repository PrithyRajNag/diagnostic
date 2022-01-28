<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Models\Account;
use App\Models\Payment;
use App\Repository\AccountRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\InvalidTag;
use Yajra\DataTables\DataTables;

class AccountController extends Controller
{
    private $repository;

    public function __construct(AccountRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(AccountRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Account::latest()->get();
                return DataTables::of($data)->editColumn('reference_number', function (Account $account) {
                    return ucfirst($account->reference_number) ?? 'N/A';
                })->editColumn('type', function (Account $account) {
                    return ucfirst(strtolower($account->type)) ?? 'N/A';
                })->addColumn('status', function ($row) {
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
                        $btn = '<a href="' . route('account.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                            <a href="' . route('account.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                            <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('account.destroy', $row->uuid) . '" name="delBtn"
                                                                class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            return view('accountManager.account.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        return view('accountManager.account.create');

    }


    public function store(AccountRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated) {
                if (auth()->user()->profile != null) {
                    $data = $request->all();
                    $this->repository->createAccount($data);
                    return redirect()->route('account.index')->with('success', 'Account Created Successfully');
                } else {
                    throw new Exception('User does not have a name in system');
                }
            }
        } catch (Exception $exception) {
            return redirect()->route('account.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $account = $this->repository->findByUuid($uuid);
        $payment = Payment::where('account_id', $account->id)->first();
        return view('accountManager.account.info', ['account' => $account, 'payment' => $payment]);
    }


    public function edit($uuid)
    {
        $account = $this->repository->findByUuid($uuid);
        $payment = Payment::where('account_id', $account->id)->first();
        return view('accountManager.account.edit', ['account' => $account, 'payment' => $payment]);
    }


    public function update(AccountRequest $request, $uuid)
    {
        try {
            if (auth()->user()->profile != null) {
                $data = $request->all();
                $this->repository->updateAccount($uuid, $data);
                return redirect()->route('account.index')->with('success', 'Account Updated Successfully');
            } else {
                throw new Exception('User does not have a name in system');
            }
        } catch (Exception $exception) {
            return redirect()->route('account.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public
    function destroy($uuid)
    {
        try {
            $this->repository->deleteAccount($uuid);
            return redirect()->route('account.index')->with('success', 'Account Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('account.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
