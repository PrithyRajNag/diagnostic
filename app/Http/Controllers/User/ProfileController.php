<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Department;
use App\Models\DoctorCategory;
use App\Models\Education;
use App\Models\Profile;
use App\Models\Qualification;
use App\Models\User;
use App\Repository\ProfileRepositoryInterface;
use Exception;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    private $repository;

    public function __construct(ProfileRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function edit($uuid)
    {
        $departments = Department::all();
        $user = User::where('id', auth()->user()->id)->first();
        $data = Profile::where('user_id', $user->id)->first();

        $educations= Education::with(['profiles'])->where('profile_id', $data->id ?? '')->first();
        $qualifications= Qualification::with(['profiles'])->where('profile_id', $data->id ?? '')->first();

        return view('profile.edit', ['data' => $data, 'departments' => $departments, 'educations' => $educations, 'qualifications' =>$qualifications ]);
    }


    public function store(ProfileRequest $request)
    {
        try {
            $validated = $request->validated();

            if ($validated) {
                $checkPhoneDuplication = $this->repository->findByPhoneNumber($request->phone_number);
                if ($checkPhoneDuplication) {
                    throw new Exception('Phone Number Should Be Unique ');
                }
                else {
                    $profile = $this->repository->createProfile($request);

                    return redirect()->route('profile.show', $profile->uuid)->with('success', 'Profile Updated Successfully');
                }
            }

        } catch (Exception $exception) {
            return redirect()->route('profile.edit')->withErrors(['errors'=>$exception->getMessage()]);
        }
    }


    public function update(ProfileRequest $request, $uuid)
    {
        try {
            $profile = $this->repository->updateProfile($uuid, $request);
            return redirect()->route('profile.show', $profile->uuid)->with('success', 'Profile Updated Successfully');
        } catch (Exception $exception) {
            return view('profile.edit')->withErrors(['error'=> $exception->getMessage()]);
        }
    }

    public function show($uuid)
    {
        $data = $this->repository->findByUuid($uuid);
        $educations= Education::with(['profiles'])->where('profile_id', $data->id)->first();
        $qualifications= Qualification::with(['profiles'])->where('profile_id', $data->id)->first();
        return view('profile.info', ['data' => $data, 'educations' =>$educations, 'qualifications' => $qualifications ]);
    }

    public function editUser($uuid)
    {
        $departments = Department::all();
        $user = User::where('id', auth()->user()->id)->first();
        $data = Profile::where('user_id', $user->id)->first();
        return view('profile.edit', ['data' => $data, 'departments' => $departments]);
    }
}
