<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Models\Department;
use App\Models\DoctorCategory;
use App\Models\Education;
use App\Models\Profile;
use App\Models\Qualification;
use App\Models\Role;
use App\Models\User;
use App\Repository\ProfileRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Exception;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class  DoctorController extends Controller
{
    private $repository;
    private $userRepository;

    public function __construct(ProfileRepositoryInterface $repository, UserRepositoryInterface $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function index(DoctorRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = User::whereHas('roles', function($q) {
                    $getRole = Role::where('slug', 'doctor')->first();
                    $q->where('role_assign_to_user.role_id', $getRole->id);
                })->with(['profile', 'profile.departments'])->get();

                return DataTables::of($data)
                    ->addColumn('name', function (User $user) {
                        if($user->profile != null) {
                            return $user->profile->first_name . ' ' . $user->profile->last_name;
                        }
                        else{
                            return 'N/A';
                        }
                    })
                    ->addColumn('phone_number', function (User $user) {
                        return $user->profile->phone_number ?? 'N/A';
                    })
                    ->addColumn('department_id', function (User $user) {
                        return $user->profile->departments->title ?? 'N/A';
                    })
                    ->addColumn('status', function (User $user) {
                        if($user->profile != null) {
                            if ($user->profile->status == 1) {
                                return '<span class="badge bg-success mb-1">' . ($user->profile->status == 0 ? "Inactive" : "Active") . '</span>';
                            } else {
                                return '<span class="badge bg-danger mb-1">' . ($user->profile->status == 0 ? "Inactive" : "Active") . '</span>';
                            }
                        }else{
                                return 'N/A';
                            }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('doctor.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="edit"></i></a>
                                <a href="' . route('doctor.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('doctor.destroy', $row->uuid) . '" name="delBtn"
                                                                class="btn btn-sm btn-danger icon icon-left mt-1"><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
            }
            return view('doctor.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public
    function create()
    {
        $departments = Department::all();
        return view('doctor.create', ['departments' => $departments]);
    }


    public
    function store(DoctorRequest $request)
    {
        try {

            $validated = $request->validated();
            if ($validated) {
                $checkPhoneDuplication = $this->repository->findByPhoneNumber($request->phone_number);
                $checkEmailDuplication = $this->userRepository->findByEmail($request->email);
                if ($checkEmailDuplication) {
                    throw new Exception('Email Should Be Unique ');
                }
                elseif ($checkPhoneDuplication) {
                    throw new Exception('Phone Number Should Be Unique ');
                }
                else {
                    $this->repository->createDoctor($request);
                    return redirect()->route('doctor.index')->with('success', 'Doctor Created Successfully');
                }
            }
        } catch (Exception $exception) {
            return redirect()->route('doctor.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public
    function show($uuid)
    {
        $doctor = $this->userRepository->findByUuid($uuid);
        $educations= Education::with(['profiles'])->where('profile_id', $doctor->profile->id )->first();
        $qualifications= Qualification::with(['profiles'])->where('profile_id', $doctor->profile->id)->first();
        return view('doctor.info', ['doctor' => $doctor, 'educations' => $educations, 'qualifications' =>$qualifications]);
    }

    public function edit($uuid)
    {
        $doctor = $this->userRepository->findByUuid($uuid);

        $educations= Education::with(['profiles'])->where('profile_id', $doctor->profile->id)->first();
        $qualifications= Qualification::with(['profiles'])->where('profile_id', $doctor->profile->id)->first();
        $departments = Department::all();
        return view('doctor.edit', ['doctor' => $doctor, 'departments' => $departments , 'educations' => $educations, 'qualifications' => $qualifications]);
    }


    public function update(DoctorRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateDoctor($uuid, $request);
            return redirect()->route('doctor.index')->with('success', 'Doctor Updated Successfully');

        } catch (Exception $exception) {
            return redirect()->route('doctor.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $user = User::where('uuid',$uuid)->first();
            $user_id = $user->id;
            $this->userRepository->deleteByUuid($uuid);
            Profile::where('user_id',$user_id)->delete();
            return redirect()->route('doctor.index')->with('success', 'Doctor Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('doctor.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
