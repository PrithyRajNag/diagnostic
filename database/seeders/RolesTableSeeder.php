<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $roles = [
            [
                "title" => 'Owner',
            ],
            [
                "title" => 'Admin',
            ],
            [
                "title" => 'Doctor',
            ],
            [
                "title" => 'Receptionist',
            ],

            [
                "title" => 'Accountant',
            ],
            [
                "title" => 'Laboratorist',
            ],
            [
                "title" => 'Nurse',
            ],
            [
                "title" => 'Pharmacist',
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
