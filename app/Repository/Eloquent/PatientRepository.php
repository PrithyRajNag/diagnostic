<?php

namespace App\Repository;

namespace App\Repository\Eloquent;

use App\Models\Patient;
use App\Repository\PatientRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PatientRepository extends BaseRepository implements PatientRepositoryInterface
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
    public function __construct(Patient $model)
    {
        $this->model = $model;
    }

    public function createPatient($payload)
    {
        if($payload['admit_date'] != null) {
            $p_admit_date = date('d-m-y', strtotime($payload['admit_date']));
        } else {
            $p_admit_date = date('d-m-y', strtotime(Carbon::now()));
        }
        if($payload['discharge_date'] != null) {
            $p_discharge_date = date('d-m-y', strtotime($payload['discharge_date']));
        }
        $patient = new Patient();
        $patient->first_name = $payload['first_name'];
        $patient->last_name = $payload['last_name'];
        $patient->phone_no = $payload['phone_no'];
        $patient->blood_group = $payload['blood_group'];
        $patient->age = $payload['age'];
        $patient->gender = $payload['gender'];
        $patient->religion = $payload['religion'];
        $patient->address = $payload['address'];
        $patient->dob = $payload['dob'];
        $patient->attendee_name = $payload['attendee_name'];
        $patient->attendee_relation = $payload['attendee_relation'];
        $patient->attendee_phone_no = $payload['attendee_phone_no'];
        if ($payload['admit_date'] != null) {
            $patient->admit_date = $payload['admit_date'];
        } else {
            $patient->admit_date = Carbon::now();
        }
        $patient->discharge_date = $payload['discharge_date'];
        if ($payload['doctor_id'] != null) {
            $patient->doctor_id = $payload['doctor_id'];
            $patient->assign_date = $payload['assign_date'];
            $patient->release_date = $payload['release_date'];
        }
        $patient->package_id = $payload['package_id'];
        $patient->status = $payload['status'];
        $patient->save();
        if ($payload['admit_date'] != null) {
            $patient->histories()->attach([1 => ['patient_id' => $patient->id, 'bed_list_id' => null, 'category' => 'CHANGES', 'type' => 'Admit', 'time' => $payload['admit_date'], 'description' => 'The Admit Date is : ' . $p_admit_date . ' .', 'updated_by' => auth()->user()->profile->full_name]]);
        } else {
            $patient->histories()->attach([1 => ['patient_id' => $patient->id, 'bed_list_id' => null, 'category' => 'CHANGES', 'type' => 'Admit', 'time' => Carbon::now(), 'description' => 'The Admit Date is : ' . $p_admit_date . ' .', 'updated_by' => auth()->user()->profile->full_name]]);
        }
        if ($payload['discharge_date'] != null) {
            $patient->histories()->attach([1 => ['patient_id' => $patient->id, 'bed_list_id' => null, 'category' => 'CHANGES', 'type' => 'Discharge', 'time' => $payload['discharge_date'], 'description' => 'The Discharge Date is : ' . $p_discharge_date . ' .', 'updated_by' => auth()->user()->profile->full_name]]);
        }
    }

    public function updatePatient($uuid, $payload)
    {
        try {
            $item = $this->model->where('uuid', $uuid)->first();
            $item_admit_date = date('d-m-y', strtotime($item->admit_date));
            $p_admit_date = date('d-m-y', strtotime($payload['admit_date']));
            if ($item->discharge_date != null) {
                $item_discharge_date = date('d-m-y', strtotime($item->discharge_date));
            }
            if ($payload['discharge_date'] != null) {
                $p_discharge_date = date('d-m-y', strtotime($payload['discharge_date']));
            }


            if ($item) {
                if ($payload['first_name'] != null && $item->first_name != $payload['first_name']) {
                    $item->histories()->attach([1 => ['patient_id' => $item->id, 'bed_list_id' => null, 'category' => 'CHANGES', 'type' => 'Name Change', 'time' => Carbon::now(), 'description' => 'The First Name is changed from ' . $item->first_name . ' to ' . $payload['first_name'] . ' .', 'updated_by' => auth()->user()->profile->full_name]]);
                }
                if ($payload['last_name'] != null && $item->last_name != $payload['last_name']) {
                    $item->histories()->attach([1 => ['patient_id' => $item->id, 'bed_list_id' => null, 'category' => 'CHANGES', 'type' => 'Name Change', 'time' => Carbon::now(), 'description' => 'The Last Name is changed from ' . $item->last_name . ' to ' . $payload['last_name'] . ' .', 'updated_by' => auth()->user()->profile->full_name]]);
                }
                if ($payload['phone_no'] != null && $item->phone_no != $payload['phone_no']) {
                    $item->histories()->attach([1 => ['patient_id' => $item->id, 'bed_list_id' => null, 'category' => 'CHANGES', 'type' => 'Phone Number Change', 'time' => Carbon::now(), 'description' => 'The Phone Number is changed from ' . $item->phone_no . ' to ' . $payload['phone_no'] . ' .', 'updated_by' => auth()->user()->profile->full_name]]);
                }
                if ($item->attendee_name != null && $item->attendee_name != $payload['attendee_name']) {
                    $item->histories()->attach([1 => ['patient_id' => $item->id, 'bed_list_id' => null, 'category' => 'CHANGES', 'type' => 'Attendee Name Change', 'time' => Carbon::now(), 'description' => 'The Attendee Name is changed from ' . $item->attendee_name . ' to ' . $payload['attendee_name'] . ' .', 'updated_by' => auth()->user()->profile->full_name]]);
                }
                if ($item->attendee_phone_no != null && $item->attendee_phone_no != $payload['attendee_phone_no']) {
                    $item->histories()->attach([1 => ['patient_id' => $item->id, 'bed_list_id' => null, 'category' => 'CHANGES', 'type' => 'Attendee Phone Number Change', 'time' => Carbon::now(), 'description' => 'The Attendee Contact Number is changed from ' . $item->attendee_phone_no . ' to ' . $payload['attendee_phone_no'] . ' .', 'updated_by' => auth()->user()->profile->full_name]]);
                }
                if ($item_admit_date != null && $item_admit_date !== $p_admit_date) {
                    $item->histories()->attach([1 => ['patient_id' => $item->id, 'bed_list_id' => null, 'category' => 'CHANGES', 'type' => 'Admit', 'time' => Carbon::now(), 'description' => 'The Admit Date is changed from ' . $item_admit_date . ' to ' . $p_admit_date . ' .', 'updated_by' => auth()->user()->profile->full_name]]);
                }
                if ($payload['discharge_date'] != null) {
                    if ($item->discharge_date != null && $item_discharge_date !== $p_discharge_date) {
                        $item->histories()->attach([1 => ['patient_id' => $item->id, 'bed_list_id' => null, 'category' => 'CHANGES', 'type' => 'Discharge', 'time' => Carbon::now(), 'description' => 'The Discharge Date is changed from ' . $item_discharge_date . ' to ' . $p_discharge_date . ' .', 'updated_by' => auth()->user()->profile->full_name]]);
                    } else {
                        $item->histories()->attach([1 => ['patient_id' => $item->id, 'bed_list_id' => null, 'category' => 'CHANGES', 'type' => 'Discharge', 'time' => $payload['discharge_date'], 'description' => 'The Discharge Date is : ' . $p_discharge_date . ' .', 'updated_by' => auth()->user()->profile->full_name]]);
                    }
                }


                $item->first_name = $payload['first_name'];
                $item->last_name = $payload['last_name'];
                $item->phone_no = $payload['phone_no'];
                $item->blood_group = $payload['blood_group'];
                $item->age = $payload['age'];
                $item->gender = $payload['gender'];
                $item->religion = $payload['religion'];
                $item->address = $payload['address'];
                $item->dob = $payload['dob'];
                $item->attendee_name = $payload['attendee_name'];
                $item->attendee_relation = $payload['attendee_relation'];
                $item->attendee_phone_no = $payload['attendee_phone_no'];
                $item->admit_date = $payload['admit_date'];
                $item->discharge_date = $payload['discharge_date'];
                if ($payload['doctor_id'] != null) {
                    $item->doctor_id = $payload['doctor_id'];
                    $item->assign_date = $payload['assign_date'];
                    $item->release_date = $payload['release_date'];
                }
                $item->package_id = $payload['package_id'];
                $item->status = $payload['status'];
                return $item->save();

            } else {
                throw new \Exception('Patient is not found');
            }
        } catch
        (\Exception $e) {
            return $e->getMessage();
        }
    }

}
