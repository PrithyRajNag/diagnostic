<?php

namespace App\Http\Controllers\HumanResource;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\HumanResourceRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Education;
use App\Models\Profile;
use App\Models\Qualification;
use App\Models\Role;
use App\Models\User;
use App\Repository\HumanResourceRepositoryInterface;
use App\Repository\ProfileRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class HumanResourceController extends Controller
{
    private $repository;
    private $userRepository;

    public function __construct(ProfileRepositoryInterface $repository, UserRepositoryInterface $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }
    public function index(ProfileRequest $request)
    {
        try {
            if ($request->ajax()) {
                $getRole = Role::where('slug', 'doctor')->first();
                $data = User::whereDoesntHave('roles', function ($query) use($getRole) {
                    $query->where('role_assign_to_user.role_id', $getRole->id);
                })->with(['profile'])->get();
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
                    ->addColumn('roles', function ($row) {
                        return '<div class="badges p-1">' . $row->roles->map(function ($role) {
                                return '
                                   <a href="' . route('role.show', $role->uuid) . '" class="badge bg-warning mb-1">' . $role->title . '</a>
                                ' ?? 'N/A';
                            })->implode('') . '</div>';

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
                        $btn = '<a href="' . route('human-resource.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="edit"></i></a>
                                <a href="' . route('human-resource.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('human-resource.destroy', $row->uuid) . '" name="delBtn"
                                                                class="btn btn-sm btn-danger icon icon-left mt-1"><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','roles','status'])
                    ->make(true);
            }
            return view('human_resource.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        $roles = Role::all()->filter(function ($item){
            return $item->slug != 'doctor';
        });
        return view('human_resource.create',['roles' => $roles]);
    }

    public function store(ProfileRequest $request)
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
                    $this->repository->createStaff($request);
                    return redirect()->route('human-resource.index')->with('success', 'Staff Created Successfully');
                }
            }
        } catch (Exception $exception) {
            return redirect()->route('human-resource.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $staff = $this->userRepository->findByUuid($uuid);
        $educations= Education::with(['profiles'])->where('profile_id', $staff->profile->id ?? '')->first();
        $qualifications= Qualification::with(['profiles'])->where('profile_id', $staff->profile->id ?? '')->first();
        return view('human_resource.info', ['staff' => $staff, 'educations' =>$educations, 'qualifications' => $qualifications ] );
    }


    public function edit($uuid)
    {
        $roles = Role::all()->filter(function ($item){
            return $item->slug != 'doctor';
        });
        $staff = $this->userRepository->findByUuid($uuid);
        $educations= Education::with(['profiles'])->where('profile_id', $staff->profile->id ?? '')->first();
        $qualifications= Qualification::with(['profiles'])->where('profile_id', $staff->profile->id ?? '')->first();

        return view('human_resource.edit',['roles' => $roles,'staff'=>$staff, 'educations'=>$educations, 'qualifications' => $qualifications ]);
    }


    public function update(ProfileRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateStaff($uuid, $request);
            return redirect()->route('human-resource.index')->with('success', 'Staff Updated Successfully');

        } catch (Exception $exception) {
            return redirect()->route('human-resource.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $user = User::where('uuid',$uuid)->first();
            $user_id = $user->id;
            $this->userRepository->deleteByUuid($uuid);
            Profile::where('user_id',$user_id)->delete();
            return redirect()->route('human-resource.index')->with('success', 'Staff Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('human-resource.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function accountant(ProfileRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = User::whereHas('roles', function($q) {
                    $getRole = Role::where('slug', 'accountant')->first();
                    $q->where('role_assign_to_user.role_id', $getRole->id);
                })->with(['profile'])->get();
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
                    ->addColumn('designation', function (User $user) {
                        return $user->profile->designation ?? 'N/A';
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
                        $btn = '<a href="' . route('human-resource.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="edit"></i></a>
                                <a href="' . route('human-resource.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('human-resource.destroy', $row->uuid) . '" name="delBtn"
                                                                class="btn btn-sm btn-danger icon icon-left mt-1"><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
            }
            return view('human_resource.accountant');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function nurse(ProfileRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = User::whereHas('roles', function($q) {
                    $getRole = Role::where('slug', 'nurse')->first();
                    $q->where('role_assign_to_user.role_id', $getRole->id);
                })->with(['profile'])->get();
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
                    ->addColumn('designation', function (User $user) {
                        return $user->profile->designation ?? 'N/A';
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
                        $btn = '<a href="' . route('human-resource.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="edit"></i></a>
                                <a href="' . route('human-resource.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('human-resource.destroy', $row->uuid) . '" name="delBtn"
                                                                class="btn btn-sm btn-danger icon icon-left mt-1"><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
            }
            return view('human_resource.nurse');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function laboratorist(ProfileRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = User::whereHas('roles', function($q) {
                    $getRole = Role::where('slug', 'laboratorist')->first();
                    $q->where('role_assign_to_user.role_id', $getRole->id);
                })->with(['profile'])->get();
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
                    ->addColumn('designation', function (User $user) {
                        return $user->profile->designation ?? 'N/A';
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
                        $btn = '<a href="' . route('human-resource.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="edit"></i></a>
                                <a href="' . route('human-resource.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('human-resource.destroy', $row->uuid) . '" name="delBtn"
                                                                class="btn btn-sm btn-danger icon icon-left mt-1"><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
            }
            return view('human_resource.laboratorist');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function pharmacist(ProfileRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = User::whereHas('roles', function($q) {
                    $getRole = Role::where('slug', 'pharmacist')->first();
                    $q->where('role_assign_to_user.role_id', $getRole->id);
                })->with(['profile'])->get();
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
                    ->addColumn('designation', function (User $user) {
                        return $user->profile->designation ?? 'N/A';
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
                        $btn = '<a href="' . route('human-resource.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="edit"></i></a>
                                <a href="' . route('human-resource.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('human-resource.destroy', $row->uuid) . '" name="delBtn"
                                                                class="btn btn-sm btn-danger icon icon-left mt-1"><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
            }
            return view('human_resource.pharmacist');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function receptionist(ProfileRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = User::whereHas('roles', function($q) {
                    $getRole = Role::where('slug', 'receptionist')->first();
                    $q->where('role_assign_to_user.role_id', $getRole->id);
                })->with(['profile'])->get();
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
                    ->addColumn('designation', function (User $user) {
                        return $user->profile->designation ?? 'N/A';
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
                        $btn = '<a href="' . route('human-resource.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="edit"></i></a>
                                <a href="' . route('human-resource.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mt-1"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('human-resource.destroy', $row->uuid) . '" name="delBtn"
                                                                class="btn btn-sm btn-danger icon icon-left mt-1"><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
            }
            return view('human_resource.receptionist');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }
}
