<?php

namespace App\Repository;

namespace App\Repository\Eloquent;

use App\Models\BedAssign;
use App\Models\BedList;
use App\Models\Patient;
use App\Repository\BedAssignRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BedAssignRepository extends BaseRepository implements BedAssignRepositoryInterface
{
    /**
     * @var Model
     */
    protected $bedListModel;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(BedList $bedListModel, Patient $patientModel)
    {
        $this->bedListModel = $bedListModel;
        $this->patientModel = $patientModel;
    }

    public function bedByUuid($uuid)
    {
        return $this->bedListModel->where('uuid', $uuid)->with('patients')->first();
    }

    public function createAssign($payload)
    {
        try {
            $bed = $this->bedListModel->find($payload->bed_list_id)->update(['availability' => false]);
            $updatedBed = $this->bedListModel->find($payload->bed_list_id);
            $patient = $this->patientModel->find($payload->patient_id);

            if ($bed) {
                $updatedBed->patients()->attach(['patient_id' => $payload->patient_id]);
                return $patient->histories()->attach([1 => ['patient_id' => $patient->id, 'bed_list_id' => $payload->bed_list_id, 'category' => 'BED', 'type' => 'Assigned', 'time' => Carbon::now(), 'description' => 'The bed number ' . $updatedBed->bed_number . ' is assigned .', 'updated_by' => auth()->user()->profile->full_name]]);
 } else {
                throw new \Exception('Bed is not assigned successfully');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateAssign($uuid, $payload)
    {
        try {
            $item = $this->bedListModel->where('uuid', $uuid)->with('patients')->first();
            $bed = $item->id;
            $patient = $this->patientModel->find($payload['patient_id']);
            $old_patient = $this->patientModel->find($item->patients[0]->id);
            if ($payload['bed_list_id'] != $bed && $payload['patient_id'] != $old_patient->id) {
                $this->bedListModel->find($bed)->update(['availability' => true]);
                $this->bedListModel->find($payload['bed_list_id'])->update(['availability' => false]);
                $updatedBed = $this->bedListModel->find($payload['bed_list_id']);

                $item->patients()->detach();
                $updatedBed->patients()->attach(['patient_id' => $payload['patient_id']]);
                $old_patient->histories()->attach([1 => ['patient_id' => $old_patient->id, 'bed_list_id' => $bed, 'category' => 'BED', 'type' => 'Unassigned', 'time' => Carbon::now(), 'description' => 'The bed number ' . $item->bed_number . ' is unassigned .', 'updated_by' => auth()->user()->profile->full_name]]);
                $patient->histories()->attach([1 => ['patient_id' => $patient->id, 'bed_list_id' => $payload['bed_list_id'], 'category' => 'BED', 'type' => 'Assigned', 'time' => Carbon::now(), 'description' => 'The bed number ' . $updatedBed->bed_number . ' is assigned .', 'updated_by' => auth()->user()->profile->full_name]]);
            }
            else{
                if ($payload['bed_list_id'] == $bed) {
                    $item->patients()->sync($payload['patient_id']);
                    $old_patient->histories()->attach([1 => ['patient_id' => $old_patient->id, 'bed_list_id' => $bed, 'category' => 'BED', 'type' => 'Unassigned', 'time' => Carbon::now(), 'description' => 'The bed number ' . $item->bed_number . ' is unassigned .', 'updated_by' => auth()->user()->profile->full_name]]);
                    $patient->histories()->attach([1 => ['patient_id' => $patient->id, 'bed_list_id' => $bed, 'category' => 'BED', 'type' => 'Assigned', 'time' => Carbon::now(), 'description' => 'The bed number ' . $item->bed_number . ' is assigned .', 'updated_by' => auth()->user()->profile->full_name]]);

                } elseif ($payload['bed_list_id'] != $bed) {
                    $previousBed = $this->bedListModel->find($bed)->update(['availability' => true]);
                    $newBed = $this->bedListModel->find($payload['bed_list_id'])->update(['availability' => false]);
                    $updatedBed = $this->bedListModel->find($payload['bed_list_id']);
                    if ($previousBed && $newBed) {
                        $item->patients()->detach();

                        $old_patient->histories()->attach([1 => ['patient_id' => $old_patient->id, 'bed_list_id' => $payload['bed_list_id'], 'category' => 'BED', 'type' => 'Assigned', 'time' => Carbon::now(), 'description' => 'The bed number ' . $updatedBed->bed_number . ' is assigned .', 'updated_by' => auth()->user()->profile->full_name]]);
                        $old_patient->histories()->attach([1 => ['patient_id' => $old_patient->id, 'bed_list_id' => $bed, 'category' => 'BED', 'type' => 'Unassigned', 'time' => Carbon::now(), 'description' => 'The bed number ' . $item->bed_number . ' is unassigned .', 'updated_by' => auth()->user()->profile->full_name]]);

                        return $updatedBed->patients()->sync($payload['patient_id']);
                    } else {
                        throw new \Exception('Bed assign is not updated successfully');
                    }
                }
                else {
                    throw new \Exception('Bed assign is not updated successfully');
                }
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteAssign($uuid)
    {
        $item = $this->bedListModel->where('uuid', $uuid)->with('patients')->first();
        $bed = $item->id;
        $this->bedListModel->find($bed)->update(['availability' => true]);
        $item->patients()->detach();
    }
}
