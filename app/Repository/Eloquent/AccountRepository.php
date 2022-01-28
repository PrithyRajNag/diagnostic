<?php

namespace App\Repository;

namespace App\Repository\Eloquent;

use App\Models\Account;
use App\Models\Payment;
use App\Repository\AccountRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
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
    public function __construct(Account $model)
    {
        $this->model = $model;
    }

    public function createAccount($payload)
    {
        try {
                $today = date("Ymd");
                $rand = strtoupper(substr(uniqid(sha1(time())), 0, 2));
                $unique = $today . $rand;

                $account = new Account();
                $account->account_name = $payload['account_name'];
                $account->type = $payload['type'];
                $account->description = $payload['description'];
                $account->reference_number = 'paid-' . $unique;
                if ($payload['due'] != 0) {
                    $account->status = "UNPAID";
                } else {
                    $account->status = "PAID";
                }
                $acc = $account->save();
                if ($acc) {
                    $payment = new Payment();
                    $payment->date = Carbon::now();
                    $payment->total = $payload['total'];
                    $payment->paid_amount = $payload['paid_amount'];
                    $payment->due = $payload['due'];
                    $payment->pay_to = $payload['pay_to'];
                    $payment->paid_by = auth()->user()->profile->full_name;
                    $payment->account_id = $account->id;
                    $payment->reference_number = $account->reference_number;
                    if ($payload['due'] != 0) {
                        $payment->status = "UNPAID";
                    } else {
                        $payment->status = "PAID";
                    }
                    $pay = $payment->save();
                    if ($pay) {
                        $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $account->id, 'payment_date' => Carbon::now(), 'amount' => $payload['paid_amount']]]);
                    }
                } else {
                    throw new \Exception('Account cannot created successfully');
                }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function updateAccount($uuid, $payload)
    {
        try {
                $account = $this->model->where('uuid', $uuid)->first();
                $account->account_name = $payload['account_name'];
                $account->type = $payload['type'];
                $account->description = $payload['description'];
                if ($payload['due'] != 0) {
                    $account->status = "UNPAID";
                } else {
                    $account->status = "PAID";
                }
                $acc = $account->save();

                $payment = Payment::where('account_id', $account->id)->first();
                if ($payload['new_paid'] != null) {
                    $payment->due_payment_date = Carbon::now();
                }
                $payment->total = $payload['total'];
                $payment->paid_amount = $payload['paid_amount'];
                $payment->due = $payload['due'];
                if ($payment->paid_by != null) {
                    $payment->pay_to = $payload['pay_to'];
                }
                if ($payload['due'] != 0) {
                    $payment->status = "UNPAID";
                } else {
                    $payment->status = "PAID";
                }
                $pay = $payment->save();
                if ($pay && $payload['new_paid'] != null) {
                    $payment->transactions()->attach([1 => ['payment_id' => $payment->id, 'account_id' => $account->id, 'payment_date' => Carbon::now(), 'amount' => $payload['new_paid']]]);
                }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteAccount($uuid)
    {
        $item = $this->model->where('uuid', $uuid)->with('payments')->first();
        $payment = Payment::where('account_id', $item->id)->with('transactions')->first();
        $payment->transactions()->detach();
        $payment->delete();
        $item->delete();
    }
}
