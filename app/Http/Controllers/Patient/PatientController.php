<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Models\Department;
use App\Models\DoctorType;
use App\Models\Package;
use App\Models\Patient;
use App\Models\Profile;
use App\Repository\PatientRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller
{
    private $repository;

    public function __construct(PatientRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Patient::latest()->get();
                return DataTables::of($data)
                    ->addColumn('name', function ($row) {
                        return $row->first_name . ' ' . $row->last_name ?? 'N/A';
                    })
                    ->addColumn('gender', function ($row) {
                        return $row->gender ?? 'N/A';
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('patient.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('patient.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('patient.destroy', $row->id) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>
                                <a href="' . route('patient-billing-invoice.edit', $row->uuid) . '" class="btn btn-sm btn-warning icon icon-left"><i data-feather="dollar-sign"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('patient.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        $departments = Department::all();
        $packages = Package::where('status', 1)->get();
        return view('patient.create', ['departments' => $departments, 'packages' => $packages]);
    }


    public function store(PatientRequest $request)
    {
        try {
            $validated = $request->validated();
            $data = $request->all();
            $checkDuplication = $this->repository->findByPhoneNo($data['phone_no']);
            if ($checkDuplication) {
                throw new \Exception('Phone Number should be unique');
            } else {
                $this->repository->createPatient($data);
                return redirect()->route('patient.index')->with('success', 'Patient Created Successfully');
            }
        } catch (\Exception $e) {
            return redirect()->route('patient.index')->withErrors(['errors' => $e->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $patient = Patient::where('uuid', $uuid)->first();
        $histories = DB::table('patient_histories')->where('patient_id', $patient->id)->get();
        return view('patient.info', ['patient' => $patient, 'histories' => $histories]);
    }


    public function edit($uuid)
    {
        $patient = $this->repository->findByUuid($uuid);
        $departments = Department::all();
        $packages = Package::where('status', 1)->get();
        return view('patient.edit', ['patient' => $patient, 'departments' => $departments, 'packages' => $packages]);
    }


    public function update(PatientRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            if (auth()->user()->profile != null) {
                $this->repository->updatePatient($uuid, $data);
                return redirect()->route('patient.index')->with('success', 'Patient Updated Successfully');
            } else {
                throw new Exception('User does not have a name in system');
            }
        } catch (Exception $exception) {
            return redirect()->route('patient.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public
    function destroy($id)
    {
        try {
            $this->repository->deleteById($id);
            return redirect()->route('patient.index')->with('success', 'Patient Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('patient.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function getDoctor($type, $id)
    {
        $doctor = Profile::where('status', 1)->where('user_type', $type)->where('department_id', $id)->with(['users'])->get();
        return $doctor;
    }

    public function history($uuid)
    {
        $patient = Patient::where('uuid', $uuid)->first();
        $histories = DB::table('patient_histories')->where('patient_id', $patient->id)->get();
        return view('patient.history', ['patient' => $patient, 'histories' => $histories]);
    }
}
