<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Jobs\SendSMS;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Setting;
use App\Models\Sms;
use App\Repository\AppointmentRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class AppointmentRepository extends BaseRepository implements AppointmentRepositoryInterface
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
    public function __construct(Appointment $model)
    {
        $this->model = $model;
    }

    public function createAppointment($payload)
    {


        $patientId = $payload->patient_id;
        try {
            if (Patient::where('id', $patientId)->first()){
                $appointment = new Appointment();
                $appointment->patient_id = $payload->patient_id;
                $appointment->doctor_id = $payload->doctor_id;
                $appointment->schedule_id = $payload->schedule_id;
                $appointment->appointment_date = $payload->appointment_date;
                $appointment->problem = $payload->problem;
                $appointment->status = $payload->status;
                $appointment->save();

                $appointment_date = Carbon::create($payload->appointment_date);
//                $appointment = Appointment::where('schedule_id', $payload->schedule_id)->first();
                $appointment_time =   date('h:i a', strtotime($appointment->schedules->start_time)). ' - '. date('h:i a', strtotime($appointment->schedules->end_time));
                $setting = Setting::first();
                $sms = new Sms();
                $sms->receiver = $payload->phone_no;
                $sms->subject = 'Appointment';
                $sms->message = "Mr/Ms. " . $payload->first_name .' '. $payload->last_name .  " your appointment has been placed for " . $appointment_date->format('l jS \\of F Y') . " between "  . $appointment_time . " Regards- " . $setting->title . " Thank You";
                $sms->sender = auth()->user()->profile->full_name;
                if ($payload->phone_no != null) {
                    SendSMS::dispatchSync($sms->receiver, $sms->message);
                }
                $sms->save();
//                $saved_sms = $sms->save();
//                if ($saved_sms){
//                    if ($payload->phone_no != null) {
//                        SendSMS::dispatchSync($sms->receiver, $sms->message);
//                    }
//                }

            }else{
                $checkDuplication = Patient::where('phone_no',  $payload['phone_no'])->first();
                if ($checkDuplication){
                    throw new Exception('Patient already exists');
//                    return redirect()->route('appointment.index')->withErrors(['errors' => 'Patient Already Exists']);
                } else {
                    $patient = new Patient();
                    $patient->first_name = $payload->first_name;
                    $patient->last_name = $payload->last_name;
                    $patient->phone_no = $payload->phone_no;
                    if ($payload->age != null){
                        $patient->age = $payload->age;
                    }
                    if ($payload->gender != null){
                        $patient->gender = $payload->gender;
                    }
                    $patient->save();

                    $appointment = new Appointment();
                    $appointment->patient_id = $patient->id;
                    $appointment->doctor_id = $payload->doctor_id;
                    $appointment->schedule_id = $payload->schedule_id;
                    $appointment->appointment_date = $payload->appointment_date;
                    $appointment->problem = $payload->problem;
                    $appointment->status = $payload->status;
                    $appointment->save();

                    $appointment_date = Carbon::create($payload->appointment_date);
                    $appointment_time =   date('h:i a', strtotime($appointment->schedules->start_time)). ' - '. date('h:i a', strtotime($appointment->schedules->end_time));
                    $setting = Setting::first();
                    $sms = new Sms();
                    $sms->receiver = $payload->phone_no;
                    $sms->subject = 'Appointment';
                    $sms->message = "Mr/Ms. " . $payload->first_name .' '. $payload->last_name .  " your appointment has been placed for " . $appointment_date->format('l jS \\of F Y') . " at "  . $appointment_time . " Regards- " . $setting->title . " Thank You";
                    $sms->sender = auth()->user()->profile->full_name;
                    if ($payload->phone_no != null) {
                        SendSMS::dispatchSync($sms->receiver, $sms->message);
                    }
                    $sms->save();
                }
            }
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function updateAppointment($uuid,$payload){

        try {
            $appointment = $this->model->where('uuid',$uuid)->first();
            $item = $this->model->where('uuid',$uuid)->first();
            $item->doctor_id = $payload['doctor_id'];
            $item->schedule_id = $payload['schedule_id'];
            $item->appointment_date = $payload['appointment_date'];
            $item->problem = $payload['problem'];
            $item->status = $payload['status'];
            $item->save();
            if ($appointment['schedule_id'] != $payload['schedule_id'] || $appointment->appointment_date != $payload['appointment_date']){
                $appointment_date = Carbon::create($payload['appointment_date']);
                $appointment_time =   date('h:i a', strtotime($item->schedules->start_time)). ' - '. date('h:i a', strtotime($item->schedules->end_time));
                $setting = Setting::first();
                $sms = Sms::where('receiver', $payload['phone_no'])->first();
                $sms->receiver = $payload['phone_no'];
                $sms->subject = 'Appointment Updated';
                $sms->message = "Mr/Ms. " . $payload['first_name'] .' '. $payload['last_name'] .  " your appointment has been updated for " . $appointment_date->format('l jS \\of F Y') . " between "  . $appointment_time . " Regards- " . $setting->title . " Thank You";
                $sms->sender = auth()->user()->profile->full_name;
                $sms->save();
                if ($payload['phone_no'] != null) {
                    SendSMS::dispatchSync($sms->receiver, $sms->message);
                }
            }

        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
}
