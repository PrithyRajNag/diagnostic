<?php

namespace App\Repository;

namespace App\Repository\Eloquent;

use App\Models\Account;
use App\Models\Payment;
use App\Models\SalaryInvoice;
use App\Repository\SalaryInvoiceRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SalaryInvoiceRepository extends BaseRepository implements SalaryInvoiceRepositoryInterface
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
    public function __construct(SalaryInvoice $model)
    {
        $this->model = $model;
    }

    public function createSalaryInvoice($payload, $description)
    {
        try {

                $salaryInvoice = new SalaryInvoice();
                $salaryInvoice->tax = $payload->tax;
                $salaryInvoice->bonus = $payload->bonus;
                $salaryInvoice->overtime = $payload->overtime;
                $salaryInvoice->due = $payload->due;
                $salaryInvoice->net_salary = $payload->net_salary;
                $salaryInvoice->payment_date = Carbon::now();
                $salaryInvoice->issuer = auth()->user()->profile->full_name;
                $salaryInvoice->description = $description;
                $salaryInvoice->profile_id = $payload->profile_id;
                $salaryInvoice->save();

                $account = new Account();
                $account->account_name = $payload->first_name . ' ' . $payload->last_name;
                $account->type = 'CREDIT';
                $account->reference_number = 'salary-' . $salaryInvoice->invoice_number;
                $account->description = json_encode($salaryInvoice->description);
                if ($payload->paid_amount == $salaryInvoice->net_salary) {
                    $account->status = 'PAID';
                } elseif ($salaryInvoice->net_salary == $payload->due) {
                    $account->status = 'UNPAID';
                } else {
                    $account->status = 'DUE';
                }
                $account->save();

                $tax = new Account();
                $tax->account_name = 'Tax';
                $tax->type = 'DEBIT';
                $tax->reference_number = 'tax-' . $salaryInvoice->invoice_number;
                $tax->description = $payload->tax;
                $tax->status = 'PAID';
                $tax->save();

                $payment = new Payment();
                $payment->account_id = $account->id;
                $payment->date = Carbon::parse(now());
                $payment->tax = $salaryInvoice->tax;
                $payment->bonus = $salaryInvoice->bonus;
                $payment->due = $salaryInvoice->due;
                $payment->total = $salaryInvoice->net_salary;
                $payment->paid_amount = $payload->paid_amount;
                $payment->pay_to = $payload->first_name . ' ' . $payload->last_name;
                $payment->paid_by = auth()->user()->profile->full_name;
                $payment->reference_number = $account->reference_number;
                if ($payload->paid_amount == $salaryInvoice->net_salary) {
                    $payment->status = 'PAID';
                } elseif ($salaryInvoice->net_salary == $payload->due) {
                    $payment->status = 'UNPAID';
                } else {
                    $payment->status = 'DUE';
                }
                $pay = $payment->save();
                if ($pay && $payload['paid_amount'] != null) {
                    $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $account->id, 'payment_date' => Carbon::now(), 'amount' => $payload['paid_amount']]]);
                    $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $tax->id, 'payment_date' => Carbon::now(), 'amount' => $payload['tax']]]);
                }

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function updateSalaryInvoice($uuid, $payload, $description)
    {
        try {
                $item = $this->model->where('uuid', $uuid)->first();
                $item->tax = $payload['tax'];
                $item->bonus = $payload['bonus'];
                $item->overtime = $payload['overtime'];
                $item->due = $payload['due'];
                $item->net_salary = $payload['net_salary'];
                $item->payment_date = Carbon::now();
                $item->issuer = auth()->user()->profile->full_name;
                $item->description = $description;
                $item->profile_id = $payload['profile_id'];
                $item->save();

                $account = Account::where('reference_number', 'salary-' . $item->invoice_number)->first();
                $account->account_name = $payload['first_name'] . ' ' . $payload['last_name'];
                $account->type = 'CREDIT';
                $account->reference_number = 'salary-' . $item->invoice_number;
                $account->description = json_encode($item->description);
                if ($payload['paid_amount'] == $item->net_salary) {
                    $account->status = 'PAID';
                } elseif ($item->net_salary == $payload['due']) {
                    $account->status = 'UNPAID';
                } else {
                    $account->status = 'DUE';
                }
                $account->save();


                $payment = Payment::where('account_id', $account->id)->first();
                $payment->account_id = $account->id;
                $payment->due_payment_date = Carbon::parse(now());
                $payment->tax = $item->tax;
                $payment->bonus = $item->bonus;
                $payment->due = $item->due;
                $payment->total = $item->net_salary;
                $payment->paid_amount = $payload['paid_amount'];
                $payment->pay_to = $payload['first_name'] . ' ' . $payload['last_name'];
                $payment->paid_by = auth()->user()->profile->full_name;
                $payment->reference_number = $account->reference_number;
                if ($payload['paid_amount'] == $item->net_salary) {
                    $payment->status = 'PAID';
                } elseif ($item->net_salary == $payload['due']) {
                    $payment->status = 'UNPAID';
                } else {
                    $payment->status = 'DUE';
                }
                $pay = $payment->save();
                if ($pay && $payload['current_paid_amount'] != null) {
                    $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $account->id, 'payment_date' => Carbon::now(), 'amount' => $payload['current_paid_amount']]]);
                }

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


    }

    public function deleteSalaryInvoice($uuid)
    {
        $salaryInvoice = $this->model->where('uuid', $uuid)->with(['accounts'])->first();
        $account = Account::where('reference_number', 'salary-' . $salaryInvoice->invoice_number)->with(['payments'])->first();
        $payment = Payment::where('account_id', $account->id)->with('transactions')->first();

        $payment->transactions()->detach();
        $payment->delete();
        $account->delete();
        $salaryInvoice->delete();
    }
}
