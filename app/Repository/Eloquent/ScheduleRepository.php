<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\Schedule;
use App\Repository\ScheduleRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ScheduleRepository extends BaseRepository implements ScheduleRepositoryInterface
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
    public function __construct(Schedule $model)
    {
        $this->model = $model;
    }

    public function createSchedule($payload)
    {

        $schedule = new Schedule();
        $schedule->day = $payload->day;
        $schedule->doctor_id = $payload->doctor_id;
        $schedule->start_time = Carbon::parse($payload->start_time);
        $schedule->end_time =Carbon::parse($payload->end_time);
        $schedule->per_patient_time = $payload->per_patient_time;
        $schedule->status = $payload->status;
        $schedule->save();
    }

    public function updateSchedule($payload, $uuid)
    {
        $item = $this->model->where('uuid',$uuid)->first();
        $item->day = $payload->day;
        $item->doctor_id = $payload->doctor_id;
        $item->start_time = Carbon::parse($payload->start_time);
        $item->end_time = Carbon::parse($payload->end_time);
        $item->per_patient_time = $payload->per_patient_time;
        $item->status = $payload->status;
        $item->save();
    }
}
