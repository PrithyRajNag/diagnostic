<?php

namespace App\Repository;

namespace App\Repository\Eloquent;

use App\Models\Account;
use App\Models\Payment;
use App\Repository\PaymentRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
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
    public function __construct(Payment $model)
    {
        $this->model = $model;
    }

    public function updatePayment($uuid, $payload)
    {
        try {
            $payment = $this->model->where('uuid', $uuid)->first();
            $account = Account::where('id', $payment->account_id)->first();

            $payment->paid_amount = $payload['paid_amount'];
            $payment->due = $payload['due'];
            if ($payload['new_paid'] != null) {
                $payment->due_payment_date = Carbon::now();
            }
            if ($payload['due'] != 0) {
                $account->status = "UNPAID";
                $payment->status = "UNPAID";
            } else {
                $account->status = "PAID";
                $payment->status = "PAID";
            }
            $account->save();
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
        $payment = Payment::where('uuid', $uuid)->with('transactions')->first();
        $payment->transactions()->detach();
        $payment->delete();
    }
}
