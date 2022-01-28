<?php

namespace App\Repository;

namespace App\Repository\Eloquent;

use App\Jobs\SendSMS;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Sms;
use App\Models\User;
use App\Repository\SmsRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SmsRepository extends BaseRepository implements SmsRepositoryInterface
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
    public function __construct(Sms $model)
    {
        $this->model = $model;
    }

    public function createSms($payload)
    {

        $receivers = [];

        if ($payload['sms_to'] == 'all') {
            $receivers = Profile::where('status', 1)->pluck('phone_number');
            $this->model->receiver = 'All Users';
        }
        elseif ($payload['sms_to'] == 'specific' && $payload['receiver'] != null) {
            $this->model->receiver = $payload['receiver'];
            array_push($receivers, $payload['receiver']);
        }else{
            $role = Role::where('slug', $payload['sms_to'])->first();
            $users = DB::table('role_assign_to_user')->where('role_id', $role->id)->get();
            foreach ($users as $user) {
                $number = Profile::where('status', 1)->where('user_id', $user->user_id)->pluck('phone_number');
                if ($number != null) {
                    array_push($receivers, $number[0]);
                }
            }
            $this->model->receiver = 'All'.' '.ucwords($payload['sms_to'].'s');
        }
            $this->model->subject = $payload['subject'];
            $this->model->message = $payload['message'];
            $this->model->sender = auth()->user()->profile->full_name;


        if (!empty($receivers) && $this->model->message != null) {
            foreach ($receivers as $item) {
                SendSMS::dispatch($item, $this->model->message);
            }
        }
        return $this->model->save();
//         $this->model;
    }
}
