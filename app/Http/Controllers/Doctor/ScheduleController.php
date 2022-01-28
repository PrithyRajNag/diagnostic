<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;

use App\Http\Requests\ScheduleRequest;
use App\Models\Profile;

use App\Models\Schedule;
use App\Repository\ScheduleRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use function Symfony\Component\String\s;

class ScheduleController extends Controller
{
    private $repository;

    public function __construct(ScheduleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(ScheduleRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Schedule::with('profiles')->get();
                return DataTables::of($data)
                    ->addColumn('doctor_id', function (Schedule $schedule) {
                        return $schedule->profiles->full_name ?? 'N/A';
                    })
                    ->addColumn('status', function (Schedule $schedule) {
                        return $schedule->status == 0 ? "Inactive" : "Active";
                    })
                    ->addColumn('start_time', function (Schedule $schedule) {
                        return date("h:i:s a", strtotime($schedule->start_time ?? 'N/A'));
                    })
                    ->addColumn('end_time', function (Schedule $schedule) {
                        return date("h:i:s a", strtotime($schedule->end_time ?? 'N/A'));
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->status == 1) {
                            return '<span class="badge bg-success mb-1">' . ($row->status == 0 ? "Inactive" : "Active") . '</span>';
                        } else {
                            return '<span class="badge bg-danger mb-1">' . ($row->status == 0 ? "Inactive" : "Active") . '</span>';
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('schedule.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('schedule.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('schedule.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            return view('doctor.schedule.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        $doctors = Profile::where('status', 1)->where('user_type', "INDOOR")->orWhere('user_type', "OUTDOOR")->get();
        return view('doctor.schedule.create', ['doctors' => $doctors]);
    }


    public function store(ScheduleRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated) {
                $schedules = $this->getSchedules($request);
                if (count($schedules) === 0) {
                    $this->repository->createSchedule($request);
                    return redirect()->route('schedule.index')->with('success', 'Schedule Created Successfully');
                } else {
                    $message = "Schedule already exists between selected time !
                       Existing Schedules are : " . $schedules->map(function ($schedule) {
                            return date('h:i a', strtotime($schedule->start_time)) . " to " . date('h:i a', strtotime($schedule->end_time));
                        })->implode(',');
                    throw new Exception($message);
                }
            }
        } catch (Exception $exception) {
            return redirect()->route('schedule.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $schedule = $this->repository->findByUuid($uuid);
        return view('doctor.schedule.info', ['schedule' => $schedule]);
    }

    public function edit($uuid)
    {
        $doctors = Profile::where('user_type', "INDOOR")->orWhere('user_type', "OUTDOOR")->get();
        $schedule = $this->repository->findByUuid($uuid);

        return view('doctor.schedule.edit', ['schedule' => $schedule, 'doctors' => $doctors]);
    }


    public function update(ScheduleRequest $request, $uuid)
    {
        try {
            $item = Schedule::where('uuid', $uuid)->first();
            $schedules = $this->getSchedules($request);

            if ($request->start_time == $item->start_time && $request->end_time == $item->end_time) {
                $this->repository->updateSchedule($request, $uuid);
                return redirect()->route('schedule.index')->with('success', 'Schedule Updated Successfully');
            } else {
                if (count($schedules) === 0) {
                    $this->repository->updateSchedule($request, $uuid);
                    return redirect()->route('schedule.index')->with('success', 'Schedule Updated Successfully');
                } else {

                    $message = "Schedule already exists between selected time !
                   Existing Schedules are : " . $schedules->map(function ($schedule) {
                            return date('h:i a', strtotime($schedule->start_time)) . " To " . date('h:i a', strtotime($schedule->end_time));
                        })->implode(',');
                    throw new Exception($message);
                }
            }
        } catch (Exception $exception) {
            return redirect()->route('schedule.index')->withErrors(['errors' => $exception->getMessage()]);
        }

    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('schedule.index')->with('success', 'Schedule Deleted Successfully');

        } catch (Exception $exception) {
            return redirect()->route('schedule.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    /**
     * @param ScheduleRequest $request
     * @return mixed
     */
    public function getSchedules(ScheduleRequest $request)
    {
        $schedules = Schedule::where('doctor_id', $request->doctor_id)->where('day', $request->day)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])->orWhere(function ($q) use ($request) {
                    $q->where('start_time', '<=', $request->start_time);
                    $q->where('end_time', '>=', $request->end_time);
                });
                $query->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })->get();
        return $schedules;
    }
}
