<?php

namespace App\Repository;

namespace App\Repository\Eloquent;

use App\Models\Account;
use App\Models\BedList;
use App\Models\Patient;
use App\Models\PatientBillingInvoice;
use App\Models\Payment;
use App\Repository\PatientBillingInvoiceRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PatientBillingInvoiceRepository extends BaseRepository implements PatientBillingInvoiceRepositoryInterface
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
    public function __construct(PatientBillingInvoice $model)
    {
        $this->model = $model;
    }

    public function createInvoice($payload, $details, $service_id)
    {
        try {
            $uuid = $payload['p_uuid'];
            $patient = Patient::where('uuid', $uuid)->first();
            if ($payload->discharge == "YES") {
                $patient->discharge_date = Carbon::now();
                $patient->save();
                $patient->histories()->attach([1 => ['patient_id' => $patient->id, 'bed_list_id' => null, 'category' => 'CHANGES', 'type' => 'Discharge', 'time' => Carbon::now(), 'description' => 'The Discharge Date is : ' . date('d-m-y', strtotime(Carbon::now())) . ' .', 'updated_by' => auth()->user()->profile->full_name]]);
                $bed = DB::table('bed_assigns')->where('patient_id', $patient->id)->first();
                if ($bed != null) {
                    $bedList = BedList::where('id', $bed->bed_list_id)->with('patients')->first();
                    $bedList->update(['availability' => true]);
                    $patient->histories()->attach([1 => ['patient_id' => $patient->id, 'bed_list_id' => $bedList->id, 'category' => 'BED', 'type' => 'Unassigned', 'time' => Carbon::now(), 'description' => 'The bed number ' . $bedList->bed_number . ' is unassigned .', 'updated_by' => auth()->user()->profile->full_name]]);
                    $bedList->patients()->detach();
                }
            }
            $this->model->patient_id = $patient->id;
            $this->model->pid = $patient->pid;
            $this->model->first_name = $patient->first_name;
            $this->model->last_name = $patient->last_name;
            $this->model->phone_number = $patient->phone_no;
            $this->model->details = $details;
            $this->model->total = $payload->total_amount;
            $this->model->vat = $payload->vat_amount;
            $this->model->discount = $payload->discount_amount;
            $this->model->hospital_discount = $payload->hospital_discount;
            $this->model->net_total = $payload->net_total;
            $this->model->issuer = auth()->user()->profile->full_name;
            $this->model->note = $payload->note;
            $this->model->bed_cost = $payload->total_bed_price;
            if ($payload->package_price) {
                $this->model->package_cost = $payload->package_price[0];
            }
            $this->model->service_cost = $payload->total_service_price;
            $invoice = $this->model->save();
            if ($invoice) {
                if ($service_id != null) {
                    for ($i = 0; $i < count($service_id); $i++) {
                        if ($payload->service_date[$i] != null) {
                            $this->model->services()->attach([1 => ['patient_id' => $patient->id, 'service_id' => $service_id[$i], 'service_date' => $payload['service_date'][$i], 'count' => $payload['service_count'][$i], 'amount' => $payload['service_price'][$i], 'updated_by' => auth()->user()->profile->full_name]]);
                        } else {
                            $this->model->services()->attach([1 => ['patient_id' => $patient->id, 'service_id' => $service_id[$i], 'service_date' => Carbon::now(), 'count' => $payload['service_count'][$i], 'amount' => $payload['service_price'][$i], 'updated_by' => auth()->user()->profile->full_name]]);
                        }
                    }
                }
            } else {
                throw new \Exception('Invoice cannot added successfully');
            }
            $account = new Account();
            $account->account_name = $this->model->first_name . ' ' . $this->model->last_name;
            $account->type = 'DEBIT';
            $account->reference_number = 'billing-' . $this->model->invoice_number;
            $account->description = json_encode($this->model->details);
            if ($payload->paid_amount == $this->model->net_total) {
                $account->status = 'PAID';
            } elseif ($payload->paid_amount == 0) {
                $account->status = 'UNPAID';
            } else {
                $account->status = 'DUE';
            }
            $account->save();
            $vat = new Account();
            $vat->account_name = 'Vat';
            $vat->type = 'CREDIT';
            $vat->reference_number = 'vat-' . $this->model->invoice_number;
            $vat->description = $payload->vat_amount;
            $vat->status = 'PAID';
            $vat->save();
            $discount = new Account();
            $discount->account_name = 'Discount';
            $discount->type = 'CREDIT';
            $discount->reference_number = 'discount-' . $this->model->invoice_number;
            $discount->description = $payload->discount_amount;
            $discount->status = 'PAID';
            $discount->save();
            $hospitalDiscount = new Account();
            $hospitalDiscount->account_name = 'Hospital Discount';
            $hospitalDiscount->type = 'CREDIT';
            $hospitalDiscount->reference_number = 'hospital-' . $this->model->invoice_number;
            $hospitalDiscount->description = $payload->hospital_discount;
            $hospitalDiscount->status = 'PAID';
            $hospitalDiscount->save();
            $payment = new Payment();
            $payment->account_id = $account->id;
            $payment->date = Carbon::now();
            $payment->vat = $this->model->vat;
            $payment->discount = $this->model->discount;
            $payment->hospital_discount = $this->model->hospital_discount;
            $payment->total = $this->model->net_total;
            $payment->paid_amount = $payload->paid_amount;
            $payment->due = $payload->due;
            $payment->pay_to = auth()->user()->profile->full_name;
            $payment->reference_number = $account->reference_number;
            if ($payload->paid_amount == $this->model->net_total) {
                $payment->status = 'PAID';
            } elseif ($payload->paid_amount == 0) {
                $payment->status = 'UNPAID';
            } else {
                $payment->status = 'DUE';
            }
            $pay = $payment->save();
            if ($pay) {
                if ($payload['paid_amount'] != 0) {
                    $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $account->id, 'payment_date' => Carbon::now(), 'amount' => $payload['paid_amount']]]);
                }
                if ($payload['vat_amount'] != 0) {
                    $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $vat->id, 'payment_date' => Carbon::now(), 'amount' => $payload['vat_amount']]]);
                }
                if ($payload['discount_amount'] != 0) {
                    $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $discount->id, 'payment_date' => Carbon::now(), 'amount' => $payload['discount_amount']]]);
                }
                if ($payload['hospital_discount'] != 0) {
                    $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $hospitalDiscount->id, 'payment_date' => Carbon::now(), 'amount' => $payload['hospital_discount']]]);
                }
            }
        } catch
        (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function updateInvoice($uuid, $payload, $details, $service_id)
    {
        try {
            $patient = Patient::where('uuid', $payload['p_uuid'])->first();
            $item = $this->model->where('uuid', $uuid)->first();
            if ($payload['discharge'] == "YES") {
                $patient->discharge_date = Carbon::now();
                $patient->save();
                $patient->histories()->attach([1 => ['patient_id' => $patient->id, 'bed_list_id' => null, 'category' => 'CHANGES', 'type' => 'Discharge', 'time' => Carbon::now(), 'description' => 'The Discharge Date is : ' . date('d-m-y', strtotime(Carbon::now())) . ' .', 'updated_by' => auth()->user()->profile->full_name]]);
                $bed = DB::table('bed_assigns')->where('patient_id', $patient->id)->first();
                if ($bed != null) {
                    $bedList = BedList::where('id', $bed->bed_list_id)->with('patients')->first();
                    $bedList->update(['availability' => true]);
                    $patient->histories()->attach([1 => ['patient_id' => $patient->id, 'bed_list_id' => $bedList->id, 'category' => 'BED', 'type' => 'Unassigned', 'time' => Carbon::now(), 'description' => 'The bed number ' . $bedList->bed_number . ' is unassigned .', 'updated_by' => auth()->user()->profile->full_name]]);
                    $bedList->patients()->detach();
                }
            }
            $item->details = $details;
            $item->total = $payload['total_amount'];
            if ($payload['vat_amount'] != 0) {
                $item->vat = $payload['vat_amount'];
            }
            if ($payload['discount_amount'] != 0) {
                $item->discount = $payload['discount_amount'];
            }
            if ($payload['hospital_discount'] != 0) {
                $item->hospital_discount = $payload['hospital_discount'];
            }
            $item->net_total = $payload['net_total'];
            $item->issuer = auth()->user()->profile->full_name;
            $item->note = $payload['note'];
            $item->bed_cost = $payload['total_bed_price'];
            if ($payload['package_price'] != null) {
                $item->package_cost = $payload['package_price'][0];
            }
            $item->service_cost = $payload['total_service_price'];
            $item->save();
            if ($item) {
                if ($service_id != null) {
                    DB::table('patient_services')->where('patient_id', $patient->id)->delete();
                    for ($i = 0; $i < count($service_id); $i++) {
                        if ($payload['service_date'][$i] != null) {
                            $item->services()->attach([1 => ['patient_id' => $patient->id, 'service_id' => $service_id[$i], 'service_date' => $payload['service_date'][$i], 'count' => $payload['service_count'][$i], 'amount' => $payload['service_price'][$i], 'updated_by' => auth()->user()->profile->full_name]]);
                        } else {
                            $item->services()->attach([1 => ['patient_id' => $patient->id, 'service_id' => $service_id[$i], 'service_date' => Carbon::now(), 'count' => $payload['service_date'][$i], 'amount' => $payload['service_price'][$i], 'updated_by' => auth()->user()->profile->full_name]]);
                        }
                    }
                }
            } else {
                throw new \Exception('Invoice cannot updated successfully');
            }
            $account = Account::where('reference_number', 'billing-' . $item->invoice_number)->first();
            $account->account_name = $item->first_name . ' ' . $item->last_name;
            $account->type = 'DEBIT';
            $account->reference_number = 'billing-' . $item->invoice_number;
            $account->description = json_encode($item->details);
            if ($payload['all_paid'] == $payload['net_total']) {
                $account->status = 'PAID';
            } elseif ($payload['all_paid'] == 0) {
                $account->status = 'UNPAID';
            } else {
                $account->status = 'DUE';
            }
            $account->save();
            if ($payload['vat_amount'] != 0) {
                $vat = Account::where('reference_number', 'vat-' . $item->invoice_number)->first();
                $vat->description = $payload['vat_amount'];
                $vat->save();
            }
            if ($payload['discount_amount'] != 0) {
                $discount = Account::where('reference_number', 'discount-' . $item->invoice_number)->first();
                $discount->description = $payload['discount_amount'];
                $discount->save();
            }
            if ($payload['hospital_discount'] != 0) {
                $hospitalDiscount = Account::where('reference_number', 'hospital-' . $item->invoice_number)->first();
                $hospitalDiscount->description = $payload['hospital_discount'];
                $hospitalDiscount->save();
            }
            $payment = Payment::where('account_id', $account->id)->first();
            $payment->account_id = $account->id;
            $payment->due_payment_date = Carbon::parse(now());
            $payment->vat = $item->vat;
            $payment->discount = $item->discount;
            $payment->hospital_discount = $item->hospital_discount;
            $payment->total = $item->net_total;
            $payment->paid_amount = $payload['all_paid'];
            $payment->due = $payload['due'];
            $payment->pay_to = auth()->user()->profile->full_name;
            $payment->reference_number = $account->reference_number;
            if ($payload['all_paid'] == $payload['net_total']) {
                $payment->status = 'PAID';
            } elseif ($payload['all_paid'] == 0) {
                $payment->status = 'UNPAID';
            } else {
                $payment->status = 'DUE';
            }
            $pay = $payment->save();
            if ($pay) {
                if ($payload['paid_amount'] != 0) {
                    $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $account->id, 'payment_date' => Carbon::now(), 'amount' => $payload['paid_amount']]]);
                }
                if ($payload['vat_amount'] != 0) {
                    $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $vat->id, 'payment_date' => Carbon::now(), 'amount' => $payload['vat_amount']]]);
                }
                if ($payload['discount_amount'] != 0) {
                    $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $discount->id, 'payment_date' => Carbon::now(), 'amount' => $payload['discount_amount']]]);
                }
                if ($payload['hospital_discount'] != 0) {
                    $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $hospitalDiscount->id, 'payment_date' => Carbon::now(), 'amount' => $payload['hospital_discount']]]);
                }
            }
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function deleteBillingInvoice($uuid)
    {
        $invoice = $this->model->where('uuid', $uuid)->with(['accounts'])->first();
        $account = Account::where('reference_number', 'billing-' . $invoice->invoice_number)->with(['payments'])->first();
        $payment = Payment::where('account_id', $account->id)->with('transactions')->first();
        $payment->transactions()->detach();
        $payment->delete();
        $account->delete();
        $invoice->delete();
    }
}
