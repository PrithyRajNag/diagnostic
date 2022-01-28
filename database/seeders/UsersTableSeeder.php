<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function run()
    {
        Model::unguard();
        $users = [
            [
                "email" => 'admin@gmail.com',
                "password" => '123456789',
                "email_verified_at" => Carbon::createFromFormat('Y-m-d','2022-01-11'),
            ],
        ];

        foreach ($users as $user) {
            $this->model->create($user);
            if($user){
                DB::table('role_assign_to_user')->insert(array(
                    array(
                        'user_id' => 1,
                        'role_id' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    )
                ));
            }
        }
    }

}
