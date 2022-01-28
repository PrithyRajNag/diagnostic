<?php

namespace App\Repository;

namespace App\Repository\Eloquent;

use App\Models\Account;
use App\Models\DoctorEarningFromTest;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\TestInvoice;
use App\Repository\TestInvoiceRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TestInvoiceRepository extends BaseRepository implements TestInvoiceRepositoryInterface
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
    public function __construct(TestInvoice $model)
    {
        $this->model = $model;
    }

    public function createInvoice($payload, $details)
    {

        $pid = $payload->pid;

        try {
                if (Patient::where('pid', $payload->pid)->first()) {
                    $invoice = new TestInvoice();
                    $invoice->pid = $payload->pid;
                    $invoice->first_name = $payload->first_name;
                    $invoice->last_name = $payload->last_name;
                    $invoice->phone_number = $payload->phone_number;
                    $invoice->details = $details;
                    $invoice->total = $payload->total;
                    $invoice->vat = $payload->vat_amount;
                    $invoice->discount = $payload->discount_amount;
                    $invoice->hospital_discount = $payload->hospital_discount;
                    $invoice->net_total = $payload->net_total;
                    $invoice->issuer = auth()->user()->profile->full_name;
                    if ($payload->invoice_date == null) {
                        $invoice->invoice_date = Carbon::now();
                    } else {
                        $invoice->invoice_date = $payload->invoice_date;
                    }
                    $invoice->delivery_date = $payload->delivery_date;
                    $invoice->patient_id = $payload->patient_id;
                    $invoice->doctor_percentage_id = $payload->doctor_percentage_id;
                    $invoice->save();
                    if ($payload->doctor_percentage_id != null){
                        $earning = new DoctorEarningFromTest();
                        $earning->doctor_percentage_id = $payload->doctor_percentage_id;
                        $earning->amount = $payload->doctor_percentage_amount;
                        $earning->save();
                    }


                    $account = new Account();
                    $account->account_name = $invoice->first_name . ' ' . $invoice->last_name;
                    $account->type = 'DEBIT';
                    $account->reference_number = 'test-' . $invoice->invoice_number;
                    $account->description = json_encode($invoice->details);
                    if ($payload->paid_amount == $invoice->net_total) {
                        $account->status = 'PAID';
                    }elseif($invoice->net_total == $payload->due) {
                        $account->status = 'UNPAID';
                    }else{
                        $account->status = 'DUE';
                    }
                    $account->save();
                    if ($payload->doctor_percentage_id != null){
                        $doctor_percentage = new Account();
                        $doctor_percentage->account_name = 'Doctor Percentage';
                        $doctor_percentage->type = 'CREDIT';
                        $doctor_percentage->reference_number = 'doctor-' . $invoice->invoice_number;
                        $doctor_percentage->description = $payload->doctor_percentage_amount;
                        $doctor_percentage->status = 'PAID';
                        $doctor_percentage->save();
                    }

                    $vat = new Account();
                    $vat->account_name = 'Vat';
                    $vat->type = 'CREDIT';
                    $vat->reference_number = 'vat-' . $invoice->invoice_number;
                    $vat->description = $payload->vat_amount;
                    $vat->status = 'PAID';
                    $vat->save();
                    $discount = new Account();
                    $discount->account_name = 'Discount';
                    $discount->type = 'CREDIT';
                    $discount->reference_number = 'discount-' . $invoice->invoice_number;
                    $discount->description = $payload->discount_amount;
                    $discount->status = 'PAID';
                    $discount->save();
                    $hospitalDiscount = new Account();
                    $hospitalDiscount->account_name = 'Hospital Discount';
                    $hospitalDiscount->type = 'CREDIT';
                    $hospitalDiscount->reference_number = 'hospital-' . $invoice->invoice_number;
                    $hospitalDiscount->description = $payload->hospital_discount;
                    $hospitalDiscount->status = 'PAID';
                    $hospitalDiscount->save();


                    $payment = new Payment();
                    $payment->account_id = $account->id;
                    $payment->date = Carbon::now();
                    $payment->vat = $invoice->vat;
                    $payment->discount = $invoice->discount;
                    $payment->hospital_discount = $invoice->hospital_discount;
                    $payment->total = $invoice->net_total;
                    $payment->paid_amount = $payload->paid_amount;
                    $payment->due = $payload->due;
                    $payment->pay_to = auth()->user()->profile->full_name;
                    $payment->reference_number = $account->reference_number;
                    if ($payload->paid_amount == $invoice->net_total) {
                        $payment->status = 'PAID';
                    }elseif($invoice->net_total == $payload->due) {
                        $payment->status = 'UNPAID';
                    }else{
                        $payment->status = 'DUE';
                    }
                    $pay = $payment->save();
                    if ($pay && $payload['paid_amount'] != null) {
                        $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $account->id, 'payment_date' => Carbon::now(), 'amount' => $payload['paid_amount']]]);
                        if ($payload['vat_amount'] != 0) {
                            $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $vat->id, 'payment_date' => Carbon::now(), 'amount' => $payload['vat_amount']]]);
                        }
                        if ($payload['discount_amount'] != 0) {
                            $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $discount->id, 'payment_date' => Carbon::now(), 'amount' => $payload['discount_amount']]]);
                        }
                        if ($payload['hospital_discount'] != 0) {
                            $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $hospitalDiscount->id, 'payment_date' => Carbon::now(), 'amount' => $payload['hospital_discount']]]);
                        }
                        if ($payload['doctor_percentage_id'] != null) {
                            $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $doctor_percentage->id, 'payment_date' => Carbon::now(), 'amount' => $payload['doctor_percentage_amount']]]);
                        }
                    }
            } else {
                    $patient = new Patient();
                    $patient->first_name = $payload->first_name;
                    $patient->last_name = $payload->last_name;
                    $patient->age = $payload->age;
                    $patient->gender = $payload->gender;
                    $patient->phone_no = $payload->phone_number;
                    $patient->admit_date = Carbon::now();
                    $patient->save();

                    $invoice = new TestInvoice();
                    $invoice->patient_id = $patient->id;
                    $invoice->pid = $patient->pid;
                    $invoice->first_name = $payload->first_name;
                    $invoice->last_name = $payload->last_name;
                    $invoice->phone_number = $payload->phone_number;
                    $invoice->details = $details;
                    $invoice->total = $payload->total;
                    $invoice->vat = $payload->vat_amount;
                    $invoice->discount = $payload->discount_amount;
                    $invoice->hospital_discount = $payload->hospital_discount;
                    $invoice->net_total = $payload->net_total;
                    $invoice->issuer = auth()->user()->profile->full_name;
                    if ($payload->invoice_date == null) {
                        $invoice->invoice_date = Carbon::now();
                    } else {
                        $invoice->invoice_date = $payload->invoice_date;
                    }
                    $invoice->delivery_date = $payload->delivery_date;
                    $invoice->doctor_percentage_id = $payload->doctor_percentage_id;
                    $invoice->save();

                    $earning = new DoctorEarningFromTest();
                    $earning->doctor_percentage_id = $payload->doctor_percentage_id;
                    $earning->amount = $payload->doctor_percentage_amount;

                    $account = new Account();
                    $account->account_name = $invoice->first_name . ' ' . $invoice->last_name;
                    $account->type = 'DEBIT';
                    $account->reference_number = 'test-' . $invoice->invoice_number;
                    $account->description = json_encode($invoice->details);
                    if ($payload->paid_amount == $invoice->net_total) {
                        $account->status = 'PAID';
                    }elseif($invoice->net_total == $payload->due) {
                        $account->status = 'UNPAID';
                    }else{
                        $account->status = 'DUE';
                    }
                    $account->save();
                    if ($payload->doctor_percentage_id != null){
                        $doctor_percentage = new Account();
                        $doctor_percentage->account_name = 'Doctor Percentage';
                        $doctor_percentage->type = 'CREDIT';
                        $doctor_percentage->reference_number = 'doctor-' . $invoice->invoice_number;
                        $doctor_percentage->description = $payload->doctor_percentage_amount;
                        $doctor_percentage->status = 'PAID';
                        $doctor_percentage->save();
                    }
                    $vat = new Account();
                    $vat->account_name = 'Vat';
                    $vat->type = 'CREDIT';
                    $vat->reference_number = 'vat-' . $invoice->invoice_number;
                    $vat->description = $payload->vat_amount;
                    $vat->status = 'PAID';
                    $vat->save();
                    $discount = new Account();
                    $discount->account_name = 'Discount';
                    $discount->type = 'CREDIT';
                    $discount->reference_number = 'discount-' . $invoice->invoice_number;
                    $discount->description = $payload->discount_amount;
                    $discount->status = 'PAID';
                    $discount->save();
                    $hospitalDiscount = new Account();
                    $hospitalDiscount->account_name = 'Hospital Discount';
                    $hospitalDiscount->type = 'CREDIT';
                    $hospitalDiscount->reference_number = 'hospital-' . $invoice->invoice_number;
                    $hospitalDiscount->description = $payload->hospital_discount;
                    $hospitalDiscount->status = 'PAID';
                    $hospitalDiscount->save();

                    $payment = new Payment();
                    $payment->account_id = $account->id;
                    $payment->date = Carbon::now();
                    $payment->vat = $invoice->vat;
                    $payment->discount = $invoice->discount;
                    $payment->hospital_discount = $invoice->hospital_discount;
                    $payment->total = $invoice->net_total;
                    $payment->paid_amount = $payload->paid_amount;
                    $payment->due = $payload->due;
                    $payment->pay_to = auth()->user()->profile->full_name;
                    $payment->reference_number = $account->reference_number;
                    if ($payload->paid_amount == $invoice->net_total) {
                        $payment->status = 'PAID';
                    }elseif($invoice->net_total == $payload->due) {
                        $payment->status = 'UNPAID';
                    }else{
                        $payment->status = 'DUE';
                    }
                    $pay = $payment->save();
                    if ($pay && $payload['paid_amount'] != null) {
                        $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $account->id, 'payment_date' => Carbon::now(), 'amount' => $payload['paid_amount']]]);
                        if ($payload['vat_amount'] != 0) {
                            $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $vat->id, 'payment_date' => Carbon::now(), 'amount' => $payload['vat_amount']]]);
                        }
                        if ($payload['discount_amount'] != 0) {
                            $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $discount->id, 'payment_date' => Carbon::now(), 'amount' => $payload['discount_amount']]]);
                        }
                        if ($payload['hospital_discount'] != 0) {
                            $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $hospitalDiscount->id, 'payment_date' => Carbon::now(), 'amount' => $payload['hospital_discount']]]);
                        }
                        if ($payload['doctor_percentage_id'] != null) {
                            $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $doctor_percentage->id, 'payment_date' => Carbon::now(), 'amount' => $payload['doctor_percentage_amount']]]);
                        }

                    }
            }
        } catch
        (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function updateInvoice($uuid, $payload, $details)
    {
        try {
                $item = $this->model->where('uuid', $uuid)->first();

                $item->pid = $payload['pid'];
                $item->first_name = $payload['first_name'];
                $item->last_name = $payload['last_name'];
                $item->phone_number = $payload['phone_number'];
                $item->details = $details;
                $item->total = $payload['total'];
                $item->vat = $payload['vat_amount'];
                $item->discount = $payload['discount_amount'];
                $item->hospital_discount = $payload['hospital_discount'];
                $item->net_total = $payload['net_total'];
                $item->issuer = auth()->user()->profile->full_name;
                $item->delivery_date = $payload['delivery_date'];
                $item->patient_id = $payload['patient_id'];
                $item->save();

                $account = Account::where('reference_number', 'test-' . $item->invoice_number)->first();
                $account->account_name = $item->first_name . ' ' . $item->last_name;
                $account->type = 'DEBIT';
                $account->reference_number = 'test-' . $item->invoice_number;
                $account->description = json_encode($item->details);

                if ($payload['paid_amount'] == $item['net_total']) {
                    $account->status = 'PAID';
                } elseif($item['net_total'] == $payload['due']) {
                    $account->status = 'UNPAID';
                }else{
                    $account->status = 'DUE';
                }
                $account->save();

                $payment = Payment::where('account_id', $account->id)->first();

                $payment->account_id = $account->id;
                $payment->due_payment_date = Carbon::parse(now());
                $payment->vat = $item->vat;
                $payment->discount = $item->discount;
                $payment->hospital_discount = $item->hospital_discount;
                $payment->total = $item->net_total;
                $payment->paid_amount = $payload['paid_amount'];
                $payment->due = $payload['due'];
                $payment->pay_to = auth()->user()->profile->full_name;
                $payment->reference_number = $account->reference_number;
                if ($payload['paid_amount'] == $item->net_total) {
                    $payment->status = 'PAID';
                } elseif($item->net_total == $payload['due']) {
                    $payment->status = 'UNPAID';
                }else{
                    $payment->status = 'DUE';
                }
                $pay = $payment->save();
                if ($pay && $payload['paid-amount'] != null) {
                    $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $account->id, 'payment_date' => Carbon::now(), 'amount' => $payload['paid-amount']]]);
                }


        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function deleteTestInvoice($uuid)
    {
        $testInvoice = $this->model->where('uuid', $uuid)->with(['accounts'])->first();
        $account = Account::where('reference_number', 'test-' . $testInvoice->invoice_number)->with(['payments'])->first();
        $payment = Payment::where('account_id', $account->id)->with('transactions')->first();

        $payment->transactions()->detach();
        $payment->delete();
        $account->delete();
        $testInvoice->delete();
    }
}
