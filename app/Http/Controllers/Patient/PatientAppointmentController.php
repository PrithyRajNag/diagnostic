<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Patient;
use App\Models\Profile;
use App\Models\Schedule;
use App\Repository\AppointmentRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;
use Yajra\DataTables\Facades\DataTables;

class PatientAppointmentController extends Controller
{
    private $repository;
    public function __construct(AppointmentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(AppointmentRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Appointment::latest()->get();
                return DataTables::of($data)
                    ->addColumn('patient_id',  function(Appointment $appointment) {
                        return  $appointment->patients->full_name ?? 'N/A';
                    })
                    ->addColumn('doctor_id',  function(Appointment $appointment) {
                        return  $appointment->doctors->full_name ?? 'N/A';
                    })
                    ->addColumn('schedule_id',  function(Appointment $appointment) {
                        return  date('h:i a', strtotime($appointment->schedules->start_time)). ' - '. date('h:i a', strtotime($appointment->schedules->end_time)) ?? 'N/A';
                    })
                    ->addColumn('status', function ($row) {
                        if($row->status == 1) {
                            return '<span class="badge bg-success mb-1">' . ($row->status == 0 ? "Inactive" : "Active") . '</span>';
                        }else {
                            return '<span class="badge bg-danger mb-1">' . ($row->status == 0 ? "Inactive" : "Active") . '</span>';
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('appointment.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mb-1"><i data-feather="edit"></i></a>
                                <a href="' . route('appointment.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mb-1"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('appointment.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left mb-1 "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            return view('patientAppointment.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {

        $patients = Patient::all();
        $departments = Department::all();
        return view('patientAppointment.create' , ['patients' => $patients ,'departments' => $departments]);

    }


    public function store(AppointmentRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated)
            {
                $totalPatients =$this->getAppointments($request);
                $maxCapacity = 0;
                foreach ($totalPatients as $totalPatient) {
                    $startTime = Carbon::parse($totalPatient->schedules->start_time)->timestamp;
                    $endTime= Carbon::parse($totalPatient->schedules->end_time)->timestamp;
                    $diff = abs($endTime - $startTime)/60;
                    $maxCapacity = round($diff / $totalPatient->schedules->per_patient_time);
                }
                if (count($totalPatients) == 0) {
                    $savedAppointment = $this->repository->createAppointment($request);
                    if ($savedAppointment == ''){
                        return redirect()->route('appointment.index')->with('success', 'Appointment Created Successfully.');
                    }else{
                        throw new Exception($savedAppointment);
                    }
                }else{
                    if (count($totalPatients) >= $maxCapacity ){
                        throw new Exception('Slot limit full ! The selected doctor has been reached to his Patient limit for selected date');
                    }else{
                        $savedAppointment = $this->repository->createAppointment($request);
                        if ($savedAppointment == ''){
                            return redirect()->route('appointment.index')->with('success', 'Appointment Created Successfully.');
                        }else{
                            throw new Exception($savedAppointment);
                        }
                    }
                }

            }
        }
        catch (Exception $exception)
        {
            return redirect()->route('appointment.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $appointment = $this->repository->findByUuid($uuid);
        return view('patientAppointment.info', ['appointment' => $appointment]);
    }


    public function edit($uuid)
    {
        $patients = Patient::all();
        $departments = Department::all();
        $appointment = $this->repository->findByUuid($uuid);
        return view('patientAppointment.edit', ['appointment' => $appointment, 'patients' => $patients, 'departments' => $departments]);
    }


    public function update(AppointmentRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $appointments = Appointment::where('uuid', $uuid)->first();
            $totalPatients = $this->getAppointments($request);
            $maxCapacity = 0;
            foreach ($totalPatients as $totalPatient) {
                $startTime = Carbon::parse($totalPatient->schedules->start_time)->timestamp;
                $endTime= Carbon::parse($totalPatient->schedules->end_time)->timestamp;
                $diff = abs($endTime - $startTime)/60;
                $maxCapacity = round($diff / $totalPatient->schedules->per_patient_time);
            }
            if ($request->schedule_id == $appointments->schedule_id && $request->appointment_date == $appointments->appointment_date){
                $this->repository->updateAppointment($uuid, $data);
                return redirect()->route('appointment.index')->with('success', 'Appointment Updated Successfully');

            }else{
                if (count($totalPatients) == 0){
                    $this->repository->updateAppointment($uuid, $data);
                    return redirect()->route('appointment.index')->with('success', 'Appointment Updated Successfully');
                }else{
                    if (count($totalPatients) >= $maxCapacity ){
                        throw new Exception('Slot limit full ! The selected doctor has been reached to his Patient limit for selected date');
                    }else{
                        $this->repository->updateAppointment($uuid, $data);
                        return redirect()->route('appointment.index')->with('success', 'Appointment Updated Successfully');
                    }
                }
            }
        }catch (Exception $exception){
            return redirect()->route('appointment.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('appointment.index')->with('success', 'Appointment Deleted Successfully');
        }catch (Exception $exception){
            return redirect()->route('appointment.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function getDoctor($type,$id)
    {
        $doctor = Profile::where('status', 1)->where('user_type', $type)->where('department_id', $id)->with(['users'])->get();
        return $doctor;
    }


    public function getSlot($uuid, $day)
    {
        $schedule =  Schedule::select('id','start_time', 'end_time')->where('doctor_id',$uuid)->where('day', $day)->where('status',1)->get();
        return $schedule;
    }

    public function findPatient($id)
    {
        $patient = Patient::where('id', $id)->first();
        return $patient;
    }

    public function getAppointments(AppointmentRequest $request)
    {
        $totalPatients = Appointment::with(['schedules'])->where('appointment_date', $request->appointment_date)
            ->where(function ($query) use ($request){
                $query->where('schedule_id', $request->schedule_id);
                $query->where('doctor_id', $request->doctor_id);
            })->get();
        return $totalPatients;
    }
    public function appointments(AppointmentRequest $request)
    {
//        $today = Carbon::now()->toDateString();
//        $data = Appointment::with(['patients', 'schedules'])->where('appointment_date', $today)->get();
//        return $data;
        try {
            if ($request->ajax()) {
                $today = Carbon::now()->toDateString();
                $data = Appointment::with(['patients', 'schedules'])->where('appointment_date', $today)->get();

                return DataTables::of($data)
                    ->addColumn('name', function (Appointment $today_appointment) {
                        return $today_appointment->patients->first_name . ' ' . $today_appointment->patients->last_name ?? 'N/A';
//                        return $today_appointment->patients->full_name ?? 'N/A';
                    })
                    ->addColumn('phone_no', function (Appointment $today_appointment) {
                        return $today_appointment->patients->phone_no ?? 'N/A';
                    })
                    ->addColumn('time',  function(Appointment $appointment) {
                        return  date('h:i a', strtotime($appointment->schedules->start_time)). ' - '. date('h:i a', strtotime($appointment->schedules->end_time)) ?? 'N/A';
                    })
//                    ->addColumn('designation', function (User $user) {
//                        return $user->profile->designation ?? 'N/A';
//                    })
                    ->addColumn('status', function ($row) {
                        if($row->status == 1) {
                            return '<span class="badge bg-success mb-1">' . ($row->status == 0 ? "Inactive" : "Active") . '</span>';
                        }else {
                            return '<span class="badge bg-danger mb-1">' . ($row->status == 0 ? "Inactive" : "Active") . '</span>';
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('appointment.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="edit"></i></a>
                                <a href="' . route('appointment.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('appointment.destroy', $row->uuid) . '" name="delBtn"
                                                                class="btn btn-sm btn-danger icon icon-left mt-1"><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
            }
            return view('patientAppointment.todaysAppointment');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }
}
