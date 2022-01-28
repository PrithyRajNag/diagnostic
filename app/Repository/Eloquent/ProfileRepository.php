<?php

namespace App\Repository;

namespace App\Repository\Eloquent;

use App\Helpers\MailHelper;
use App\Models\Education;
use App\Models\Profile;
use App\Models\Qualification;
use App\Models\Role;
use App\Models\User;
use App\Repository\ProfileRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileRepository extends BaseRepository implements ProfileRepositoryInterface
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
    public function __construct(Profile $model)
    {
        $this->model = $model;
    }

    public function createDoctor($payload)
    {

        try {
            $getRole = Role::where('slug', 'doctor')->first();
            $user = new User();
            $user->email = $payload->email;
            $password = Str::random(10);
            $user->password = $password;
            $details = [
                'subject' => 'HMS||Welcome to our system',
                'body' => 'Your account is created successfully.Your auto generated password is ' . $password . ' Please reset your password after login.  Please click on the given link to login',
                'to' => $payload['email'],
            ];
            $mail = new MailHelper($details);
            $mail->sendMail();
            $user->save();
            if ($user) {
                $user->roles()->attach($getRole->id);
                $doctor = new Profile();
                $doctor->user_id = $user->id;
                $doctor->first_name = $payload->first_name;
                $doctor->last_name = $payload->last_name;
                $doctor->designation = $payload->designation;
                $doctor->department_id = $payload->department_id;
                $doctor->phone_number = $payload->phone_number;
                $doctor->dob = $payload->dob;
                $doctor->gender = $payload->gender;
                $doctor->blood_group = $payload->blood_group;
                $doctor->nid = $payload->nid;
                $doctor->salary = $payload->salary;
                $doctor->joining_date = $payload->joining_date;
                $doctor->biography = $payload->biography;
                $doctor->present_address = $payload->present_address;
                $doctor->permanent_address = $payload->permanent_address;
                $doctor->status = $payload->status;
                $doctor->user_type = $payload->user_type;
                if ($payload->hasFile('image')) {
                    $imageName = time() . '.' . $payload->file('image')->extension();
                    $path = $payload->file('image')->storeAs('public/images', $imageName, 'local');
                    $doctor->image = $imageName;
                }
                $doctor->save();
                $education = new Education();
                $education->degree_level = $payload->degree_level;
                $education->degree = $payload->degree;
                $education->passing_year = $payload->passing_year;
                $education->result = $payload->result;
                $education->board_university = $payload->board_university;
                $education->major = $payload->major;
                $education->profile_id = $doctor->id;
                $education->save();

                $qualification = new Qualification();
                $qualification->org_name = $payload->org_name;
                $qualification->position = $payload->position;
                $qualification->start_date = $payload->start_date;
                $qualification->end_date = $payload->end_date;
                $qualification->duration = $payload->duration;
                $qualification->responsibilities = $payload->responsibilities;
                $qualification->profile_id = $doctor->id;
                $qualification->save();

            } else {
                throw new \Exception('User is not created successfully');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $doctor;
    }

    public function updateDoctor($uuid, $payload)
    {
        try {
            $user = User::where('uuid', $uuid)->first();
            $email = $user->email;
            if ($email != $payload->email) {
                $user->email = $payload->email;
                $password = Str::random(10);
                $user->password = $password;
                $details = [
                    'subject' => 'HMS||Welcome to our system',
                    'body' => 'Your account is created successfully.Your auto generated password is ' . $password . ' Please reset your password after login.  Please click on the given link to login',
                    'to' => $payload['email'],
                ];
                $mail = new MailHelper($details);
                $mail->sendMail();
                $user->save();
            }


            $item = Profile::where('user_id', $user->id)->first();
            if ($item != null) {
                $image = $item->image;
                if ($payload->hasFile('image')) {
                    Storage::delete('public/images/' . $image);
                    $imageName = time() . '.' . $payload->file('image')->extension();
                    $payload->file('image')->storeAs('public/images', $imageName, 'local');
                    $item->image = $imageName;
                }

                $item->first_name = $payload->first_name;
                $item->last_name = $payload->last_name;
                $item->designation = $payload->designation;
                $item->department_id = $payload->department_id;
                $item->phone_number = $payload->phone_number;
                $item->dob = $payload->dob;
                $item->gender = $payload->gender;
                $item->blood_group = $payload->blood_group;
                $item->nid = $payload->nid;
                $item->salary = $payload->salary;
                $item->joining_date = $payload->joining_date;
                $item->biography = $payload->biography;
                $item->status = $payload->status;
                $item->present_address = $payload->present_address;
                $item->permanent_address = $payload->permanent_address;
                $item->user_type = $payload->user_type;
                $item->save();

                $education = Education::where('profile_id', $item->id)->first();
                $education->degree_level = $payload->degree_level;
                $education->degree = $payload->degree;
                $education->passing_year = $payload->passing_year;
                $education->result = $payload->result;
                $education->board_university = $payload->board_university;
                $education->major = $payload->major;
                $education->profile_id = $item->id;
                $education->save();


                $qualification = Qualification::where('profile_id', $item->id)->first();
                $qualification->org_name = $payload->org_name;
                $qualification->position = $payload->position;
                $qualification->start_date = $payload->start_date;
                $qualification->end_date = $payload->end_date;
                $qualification->duration = $payload->duration;
                $qualification->responsibilities = $payload->responsibilities;
                $qualification->profile_id = $item->id;
                $qualification->save();

            } else {
                $doctor = new Profile();
                $doctor->user_id = $user->id;
                $doctor->first_name = $payload->first_name;
                $doctor->last_name = $payload->last_name;
                $doctor->designation = $payload->designation;
                $doctor->department_id = $payload->department_id;
                $doctor->phone_number = $payload->phone_number;
                $doctor->dob = $payload->dob;
                $doctor->gender = $payload->gender;
                $doctor->blood_group = $payload->blood_group;
                $doctor->nid = $payload->nid;
                $doctor->salary = $payload->salary;
                $doctor->joining_date = $payload->joining_date;
                $doctor->biography = $payload->biography;
                $doctor->present_address = $payload->present_address;
                $doctor->permanent_address = $payload->permanent_address;
                $doctor->status = $payload->status;
                $doctor->user_type = $payload->user_type;
                if ($payload->hasFile('image')) {
                    $imageName = time() . '.' . $payload->file('image')->extension();
                    $path = $payload->file('image')->storeAs('public/images', $imageName, 'local');
                    $doctor->image = $imageName;
                }
                $doctor->save();

                $education = new Education();
                $education->degree_level = $payload->degree_level;
                $education->degree = $payload->degree;
                $education->passing_year = $payload->passing_year;
                $education->result = $payload->result;
                $education->board_university = $payload->board_university;
                $education->major = $payload->major;
                $education->profile_id = $doctor->id;
                $education->save();

                $qualification = new Qualification();
                $qualification->org_name = $payload->org_name;
                $qualification->position = $payload->position;
                $qualification->start_date = $payload->start_date;
                $qualification->end_date = $payload->end_date;
                $qualification->duration = $payload->duration;
                $qualification->responsibilities = $payload->responsibilities;
                $qualification->profile_id = $doctor->id;
                $qualification->save();
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $user;

    }

    public function createStaff($payload)
    {
        try {
            $user = new User();
            $user->email = $payload->email;
            $password = Str::random(10);
            $user->password = $password;
            $details = [
                'subject' => 'HMS||Welcome to our system',
                'body' => 'Your account is created successfully.Your auto generated password is ' . $password . ' Please reset your password after login.  Please click on the given link to login',
                'to' => $payload['email'],
            ];
            $mail = new MailHelper($details);
            $mail->sendMail();
            $user->save();
            if ($user) {
                if ($payload->has('roles')) {
                    $user->roles()->attach($payload->roles);
                } else {
                    $user->roles()->attach($payload->role_id);
                }
                $staff = new Profile();
                $staff->user_id = $user->id;
                $staff->first_name = $payload->first_name;
                $staff->last_name = $payload->last_name;
                $staff->phone_number = $payload->phone_number;
                $staff->dob = $payload->dob;
                $staff->gender = $payload->gender;
                $staff->designation = $payload->designation;
                $staff->blood_group = $payload->blood_group;
                $staff->nid = $payload->nid;
                $staff->salary = $payload->salary;
                $staff->joining_date = $payload->joining_date;
                $staff->present_address = $payload->present_address;
                $staff->permanent_address = $payload->permanent_address;
                $staff->status = $payload->status;
                $staff->user_type = $payload->user_type;
                if ($payload->hasFile('image')) {
                    $imageName = time() . '.' . $payload->file('image')->extension();
                    $path = $payload->file('image')->storeAs('public/images', $imageName, 'local');
                    $staff->image = $imageName;
                }
                $staff->save();
                $education = new Education();
                $education->degree_level = $payload->degree_level;
                $education->degree = $payload->degree;
                $education->passing_year = $payload->passing_year;
                $education->result = $payload->result;
                $education->board_university = $payload->board_university;
                $education->major = $payload->major;
                $education->profile_id = $staff->id;
                $education->save();

                $qualification = new Qualification();
                $qualification->org_name = $payload->org_name;
                $qualification->position = $payload->position;
                $qualification->start_date = $payload->start_date;
                $qualification->end_date = $payload->end_date;
                $qualification->duration = $payload->duration;
                $qualification->responsibilities = $payload->responsibilities;
                $qualification->profile_id = $staff->id;
                $qualification->save();
            } else {
                throw new \Exception('User is not created successfully');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $staff;
    }

    public function updateStaff($uuid, $payload)
    {
        try {
            $user = User::where('uuid', $uuid)->first();
            $email = $user->email;
            if ($email != $payload->email) {
                $user->email = $payload->email;
                $password = Str::random(10);
                $user->password = $password;
                $details = [
                    'subject' => 'HMS||Welcome to our system',
                    'body' => 'Your account is created successfully.Your auto generated password is ' . $password . ' Please reset your password after login.  Please click on the given link to login',
                    'to' => $payload['email'],
                ];
                $mail = new MailHelper($details);
                $mail->sendMail();
                $user->save();
            }
            if ($payload->has('role_id')) {
                $user->roles()->sync($payload->role_id);
            }
            $item = Profile::where('user_id', $user->id)->first();
            if ($item != null) {
                $image = $item->image;
                if ($payload->hasFile('image')) {
                    Storage::delete('public/images/' . $image);
                    $imageName = time() . '.' . $payload->file('image')->extension();
                    $payload->file('image')->storeAs('public/images', $imageName, 'local');
                    $item->image = $imageName;
                }

                $item->first_name = $payload->first_name;
                $item->last_name = $payload->last_name;
                $item->designation = $payload->designation;
                $item->phone_number = $payload->phone_number;
                $item->dob = $payload->dob;
                $item->gender = $payload->gender;
                $item->blood_group = $payload->blood_group;
                $item->nid = $payload->nid;
                $item->salary = $payload->salary;
                $item->joining_date = $payload->joining_date;
                $item->status = $payload->status;
                $item->present_address = $payload->present_address;
                $item->permanent_address = $payload->permanent_address;
                $item->save();

                $education = Education::where('profile_id', $item->id)->first();
                $education->degree_level = $payload->degree_level;
                $education->degree = $payload->degree;
                $education->passing_year = $payload->passing_year;
                $education->result = $payload->result;
                $education->board_university = $payload->board_university;
                $education->major = $payload->major;
                $education->profile_id = $item->id;
                $education->save();


                $qualification = Qualification::where('profile_id', $item->id)->first();
                $qualification->org_name = $payload->org_name;
                $qualification->position = $payload->position;
                $qualification->start_date = $payload->start_date;
                $qualification->end_date = $payload->end_date;
                $qualification->duration = $payload->duration;
                $qualification->responsibilities = $payload->responsibilities;
                $qualification->profile_id = $item->id;
                $qualification->save();

            } else {
                $staff = new Profile();
                $staff->user_id = $user->id;
                $staff->first_name = $payload->first_name;
                $staff->last_name = $payload->last_name;
                $staff->phone_number = $payload->phone_number;
                $staff->dob = $payload->dob;
                $staff->gender = $payload->gender;
                $staff->designation = $payload->designation;
                $staff->blood_group = $payload->blood_group;
                $staff->nid = $payload->nid;
                $staff->salary = $payload->salary;
                $staff->joining_date = $payload->joining_date;
                $staff->present_address = $payload->present_address;
                $staff->permanent_address = $payload->permanent_address;
                $staff->status = $payload->status;
                $staff->user_type = $payload->user_type;
                if ($payload->hasFile('image')) {
                    $imageName = time() . '.' . $payload->file('image')->extension();
                    $path = $payload->file('image')->storeAs('public/images', $imageName, 'local');
                    $staff->image = $imageName;
                }
                $staff->save();

                $education = new Education();
                $education->degree_level = $payload->degree_level;
                $education->degree = $payload->degree;
                $education->passing_year = $payload->passing_year;
                $education->result = $payload->result;
                $education->board_university = $payload->board_university;
                $education->major = $payload->major;
                $education->profile_id = $staff->id;
                $education->save();

                $qualification = new Qualification();
                $qualification->org_name = $payload->org_name;
                $qualification->position = $payload->position;
                $qualification->start_date = $payload->start_date;
                $qualification->end_date = $payload->end_date;
                $qualification->duration = $payload->duration;
                $qualification->responsibilities = $payload->responsibilities;
                $qualification->profile_id = $staff->id;
                $qualification->save();
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $user;
    }


    public function createProfile($payload)
    {
        try {
            $profile = new Profile();
            $profile->user_id = auth()->user()->id;
            $profile->first_name = $payload->first_name;
            $profile->last_name = $payload->last_name;
            $profile->phone_number = $payload->phone_number;
            $profile->department_id = $payload->department_id;
            $profile->designation = $payload->designation;
            $profile->gender = $payload->gender;
            $profile->dob = $payload->dob;
            $profile->blood_group = $payload->blood_group;
            $profile->nid = $payload->nid;
            $profile->salary = $payload->salary;
            $profile->joining_date = $payload->joining_date;
            $profile->present_address = $payload->present_address;
            $profile->permanent_address = $payload->permanent_address;
            $profile->user_type = $payload->user_type;
            if ($payload->hasFile('image')) {
                $imageName = time() . '.' . $payload->file('image')->extension();
                $payload->file('image')->storeAs('public/images', $imageName, 'local');
                $profile->image = $imageName;
            }
            $profile->save();
            $education = new Education();
            $education->degree_level = $payload->degree_level;
            $education->degree = $payload->degree;
            $education->passing_year = $payload->passing_year;
            $education->result = $payload->result;
            $education->board_university = $payload->board_university;
            $education->major = $payload->major;
            $education->profile_id = $profile->id;
            $education->save();

            $qualification = new Qualification();
            $qualification->org_name = $payload->org_name;
            $qualification->position = $payload->position;
            $qualification->start_date = $payload->start_date;
            $qualification->end_date = $payload->end_date;
            $qualification->duration = $payload->duration;
            $qualification->responsibilities = $payload->responsibilities;
            $qualification->profile_id = $profile->id;
            $qualification->save();


        }catch (\Exception $exception){
            return $exception->getMessage();
        }
        return $profile;
    }

    public function updateProfile($uuid, $payload)
    {
        try {
            $item = $this->findByUuid($uuid);
            $image = $item->image;
            if ($payload->hasFile('image')) {
                if ($image != null) {
                    Storage::delete('public/images/' . $image);
                }
                $imageName = time() . '.' . $payload->file('image')->extension();
                $payload->file('image')->storeAs('public/images', $imageName, 'local');
                $item->image = $imageName;
            }
            $item->first_name = $payload->first_name;
            $item->last_name = $payload->last_name;
            $item->designation = $payload->designation;
            $item->department_id = $payload->department_id;
            $item->phone_number = $payload->phone_number;
            $item->dob = $payload->dob;
            $item->gender = $payload->gender;
            $item->nid = $payload->nid;
            $item->salary = $payload->salary;
            $item->blood_group = $payload->blood_group;
            $item->joining_date = $payload->joining_date;
            $item->present_address = $payload->present_address;
            $item->permanent_address = $payload->permanent_address;
            $item->user_type = $payload->user_type;

            $item->save();

            $education = Education::where('profile_id', $item->id)->first();
            $education->degree_level = $payload->degree_level;
            $education->degree = $payload->degree;
            $education->passing_year = $payload->passing_year;
            $education->result = $payload->result;
            $education->board_university = $payload->board_university;
            $education->major = $payload->major;
            $education->profile_id = $item->id;
            $education->save();


            $qualification = Qualification::where('profile_id', $item->id)->first();
            $qualification->org_name = $payload->org_name;
            $qualification->position = $payload->position;
            $qualification->start_date = $payload->start_date;
            $qualification->end_date = $payload->end_date;
            $qualification->duration = $payload->duration;
            $qualification->responsibilities = $payload->responsibilities;
            $qualification->profile_id = $item->id;
            $qualification->save();
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
        return $item;
    }
}

