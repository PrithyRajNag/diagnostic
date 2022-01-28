<?php

namespace App\Repository\Eloquent;

use App\Models\Patient;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Helpers\MailHelper;
use Illuminate\Auth\Events\Registered;

class UserRepository extends BaseRepository implements UserRepositoryInterface
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
    public function __construct(User $model, Patient $patientModel)
    {
        $this->model = $model;
        $this->patientModel = $patientModel;

    }

    public function register($request)
    {

        try {
        $password = Str::random(10);
        $details = [
            'subject' => 'HMS||Welcome to our system',
            'body' => 'Your account is created successfully.Your auto generated password is ' . $password . ' Please reset your password after login.  Please click on the given link to login',
            'to' => $request['email'],
        ];
        $mail = new MailHelper($details);
        $mail->sendMail();
            $newUser = User::create([
                'email' => $request['email'],
                'password' => $password
            ]);


            if($newUser){
                $newUser->roles()->attach($request['role_id']);

            }else{
                throw new \Exception('User is not created successfully');
            }
            event(new Registered($newUser));

        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function login($request): bool|string
    {
        try {
            $user = $this->model->where('email', $request['email'])->first();
            if (!$user) {
                throw new \Exception("Please enter a valid email");
            } else {
                if (!Hash::check($request['password'], $user->password)) {
                    throw new \Exception("Please enter a valid password");
                } else {
                    $loggedIn = Auth::attempt($request);
                    return $loggedIn;
                }
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


}
