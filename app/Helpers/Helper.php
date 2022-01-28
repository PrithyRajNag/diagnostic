<?php

namespace App\Helpers;

use App\Models\Permission;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class Helper
{


    static function date_format($date = null, $type = 'HUMAN', $format = 'Y-m-d')
    {
        switch ($type) {
            case 'HUMAN':
                return date("F jS, Y", strtotime($date ? $date : date('m/d/Y h:i:s a', time())));
            case "CURRENT_YEAR":
                return date("Y");
            default:

        }

    }


    static public function checkedTitle($array, $value)
    {
        if (!$array) return '';
        foreach ($array as $item) {
            echo $item['title'] === $value ? 'checked' : '';

        }

    }


    static public function profile()
    {
        $profile = Profile::where('user_id', auth()->user()->id ?? '')->first();
        if ($profile != null) {
            return[
            'name' => $profile->full_name,
            'image' => $profile->image,
            ];
        }
    }

    static public function showProfile()
    {
        $user = User::where('id', auth()->user()->id ?? '')->first();
        $data = Profile::where('user_id', $user->id ?? '')->first();
        return [
            'uuid' => $data->uuid ?? ''
        ];
    }

    static public function logo(){
        $settings = Setting::where('id',1)->first();
        if ($settings != null){
        return[
          'logo' => $settings->logo,
        ];
        }
    }
    static public function favicon(){
        $settings = Setting::where('id',1)->first();
        if ($settings != null){
        return[
          'favicon' => $settings->favicon,
        ];
        }
    }
    static public function userRolePermission()
    {
        $user = \auth()->user()->id ?? '';
        $data = DB::select("SELECT pr.role_id, pr.permission_id,ru.user_id, ru.role_id AS role_id FROM permission_assign_to_roles AS pr
                                    INNER JOIN role_assign_to_user AS ru
                                    ON pr.role_id = ru.role_id
                                    WHERE ru.user_id = '{$user}'" );

        return [
            'userPermission' => $data ?? ''
        ];
    }
//    static public function permission()
//    {
//        $permission = Permission::all();
//        return [
//            'permission' => $permission ?? ''
//        ];
//    }


    static public function createUppers()
    {
        if (url()->previous() == route('human-resource.accountant')) {
            return [
                'title' => 'Create New Accountant',
                'link' => route('human-resource.accountant'),
            ];
        } elseif (url()->previous() == route('human-resource.nurse')) {
            return [
                'title' => 'Create New Nurse',
                'link' => route('human-resource.nurse'),
            ];
        } elseif (url()->previous() == route('human-resource.laboratorist')) {
            return [
                'title' => 'Create New Laboratorist',
                'link' => route('human-resource.laboratorist'),
            ];
        } elseif (url()->previous() == route('human-resource.pharmacist')) {
            return [
                'title' => 'Create New Pharmacist',
                'link' => route('human-resource.pharmacist'),
            ];
        } elseif (url()->previous() == route('human-resource.receptionist')) {
            return [
                'title' => 'Create New Receptionist',
                'link' => route('human-resource.receptionist'),
            ];
        } else {
            return [
                'title' => 'Create New Staff',
                'link' => route('human-resource.index'),
            ];
        }

    }

    static public function editUppers()
    {

        if (url()->previous() == route('human-resource.accountant')) {
            return [
                'title' => 'Edit Accountant Information',
                'link' => route('human-resource.accountant'),
            ];
        } elseif (url()->previous() == route('human-resource.nurse')) {
            return [
                'title' => 'Edit Nurse Information',
                'link' => route('human-resource.nurse'),
            ];
        } elseif (url()->previous() == route('human-resource.laboratorist')) {
            return [
                'title' => 'Edit Laboratorist Information',
                'link' => route('human-resource.laboratorist'),
            ];
        } elseif (url()->previous() == route('human-resource.pharmacist')) {
            return [
                'title' => 'Edit Pharmacist Information',
                'link' => route('human-resource.pharmacist'),
            ];
        } elseif (url()->previous() == route('human-resource.receptionist')) {
            return [
                'title' => 'Edit Receptionist Information',
                'link' => route('human-resource.receptionist'),
            ];
        } else {
            return [
                'title' => 'Edit Staff Information',
                'link' => route('human-resource.index'),
            ];
        }
    }

    static public function infoUppers()
    {

        if (url()->previous() == route('human-resource.accountant')) {
            return [
                'title' => 'Accountant Information',
                'link' => route('human-resource.accountant'),
            ];
        } elseif (url()->previous() == route('human-resource.nurse')) {
            return [
                'title' => 'Nurse Information',
                'link' => route('human-resource.nurse'),
            ];
        } elseif (url()->previous() == route('human-resource.laboratorist')) {
            return [
                'title' => 'Laboratorist Information',
                'link' => route('human-resource.laboratorist'),
            ];
        } elseif (url()->previous() == route('human-resource.pharmacist')) {
            return [
                'title' => 'Pharmacist Information',
                'link' => route('human-resource.pharmacist'),
            ];
        } elseif (url()->previous() == route('human-resource.receptionist')) {
            return [
                'title' => 'Receptionist Information',
                'link' => route('human-resource.receptionist'),
            ];
        } else {
            return [
                'title' => 'Staff Information',
                'link' => route('human-resource.index'),
            ];
        }
    }

    static public function menuList()
    {
        return [
            [
                'sideIcon' => 'grid',
                'title' => 'Dashboard',
                'link' => route('dashboard'),
                'hasSub' => false,
                'subMenu' => [],
                'permission' => 'dashboard.index',

            ],

            [
                'sideIcon' => 'briefcase',
                'title' => 'Department',
                'link' => route('department.index'),
                'hasSub' => true,
                'permission' => 'department.index',
                'subMenu' => [
                    [
                        'sideIcon' => '',
                        'title' => 'Department List',
                        'link' => route('department.index'),
                        'permission' => 'department.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Department Create',
                        'link' => route('department.create'),
                        'permission' => 'department.create',
                    ],
                ]
            ],
            [
                'sideIcon' => 'user-plus',
                'title' => 'Doctor',
                'link' => route('doctor.index'),
                'hasSub' => true,
                'permission' => 'doctor.index',
                'subMenu' => [
                    [
                        'sideIcon' => '',
                        'title' => 'Doctor List',
                        'link' => route('doctor.index'),
                        'permission' => 'doctor.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Doctor Percentage',
                        'link' => route('doctor-percentage.index'),
                        'permission' => 'doctor-percentage.index',
                    ],
                ],
            ],
            [
                'sideIcon' => 'user',
                'title' => 'Patient',
                'link' => route('patient.index'),
                'hasSub' => true,
                'permission' => 'patient.index',
                'subMenu' => [
                    [
                        'sideIcon' => '',
                        'title' => 'Add Patient',
                        'link' => route('patient.create'),
                        'permission' => 'patient.create',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Patient List ',
                        'link' => route('patient.index'),
                        'permission' => 'patient.index',
                    ],
                ]

            ],
            [
                'sideIcon' => 'server',
                'title' => 'Lab',
                'link' => '',
                'hasSub' => true,
                'permission' => 'lab.index',
                'subMenu' => [
                    [
                        'sideIcon' => '',
                        'title' => 'Lab List ',
                        'link' => route('lab.index'),
                        'permission' => 'lab.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Test Category',
                        'link' => route('test-category.index'),
                        'permission' => 'test-category.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Test Item',
                        'link' => route('test-item.index'),
                        'permission' => 'test-item.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Test Result Category',
                        'link' => route('test-result-category.index'),
                        'permission' => 'test-result-category.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Test Result Item',
                        'link' => route('test-result-item.index'),
                        'permission' => 'test-result-item.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Test Result Unit',
                        'link' => route('test-result-unit.index'),
                        'permission' => 'test-result-unit.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Test Report',
                        'link' => route('test-report.index'),
                        'permission' => 'test-report.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Test Report Template',
                        'link' => route('test-report-template.index'),
                        'permission' => 'test-report-template.index',
                    ],
                ]

            ],

            [
                'sideIcon' => 'calendar',
                'title' => 'Schedule',
                'link' => route('schedule.index'),
                'hasSub' => false,
                'permission' => 'schedule.index',
                'subMenu' => []
            ],
            [
                'sideIcon' => 'clock',
                'title' => 'Appointment',
                'link' => route('appointment.index'),
                'hasSub' => false,
                'subMenu' => [],
                'permission' => 'appointment.index',

            ],

            [
                'sideIcon' => 'user',
                'title' => 'Account Manager',
                'link' => '',
                'hasSub' => true,
                'permission' => 'account.index',
                'subMenu' => [
                    [
                        'sideIcon' => '',
                        'title' => 'Add Organization Bill',
                        'link' => route('account.create'),
                        'permission' => 'account.create',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Account List',
                        'link' => route('account.index'),
                        'permission' => 'account.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Payment List',
                        'link' => route('payment.index'),
                        'permission' => 'payment.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Test Invoice',
                        'link' => route('test-invoice.create'),
                        'permission' => 'test-invoice.create',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Test Invoice List',
                        'link' => route('test-invoice.index'),
                        'permission' => 'test-invoice.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Salary Invoice',
                        'link' => route('salary-invoice.create'),
                        'permission' => 'salary-invoice.create',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Salary Invoice List',
                        'link' => route('salary-invoice.index'),
                        'permission' => 'salary-invoice.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Debit Report',
                        'link' => route('report.debit'),
                        'permission' => 'report.debit',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Credit Report',
                        'link' => route('report.credit'),
                        'permission' => 'report.credit',
                    ],

                ]
            ],

            [
                'sideIcon' => 'briefcase',
                'title' => 'Human Resource',
                'link' => '',
                'hasSub' => true,
                'permission' => 'human-resource.index',
                'subMenu' => [
                    [
                        'sideIcon' => '',
                        'title' => 'Add Employee',
                        'link' => route('human-resource.create'),
                        'permission' => 'human-resource.create',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'All Staff List',
                        'link' => route('human-resource.index'),
                        'permission' => 'human-resource.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Accountant List',
                        'link' => route('human-resource.accountant'),
                        'permission' => 'human-resource.accountant',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Laboratorist  List ',
                        'link' => route('human-resource.laboratorist'),
                        'permission' => 'human-resource.laboratorist',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Nurse List',
                        'link' => route('human-resource.nurse'),
                        'permission' => 'human-resource.nurse',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Pharmacist List',
                        'link' => route('human-resource.pharmacist'),
                        'permission' => 'human-resource.pharmacist',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Receptionist List',
                        'link' => route('human-resource.receptionist'),
                        'permission' => 'human-resource.receptionist',
                    ],
                ]
            ],
            [
                'sideIcon' => 'bell',
                'title' => 'Noticeboard',
                'link' => route('notice.index'),
                'hasSub' => false,
                'permission' => 'notice.index',
                'subMenu' => []
            ],

            [
                'sideIcon' => 'message-square',
                'title' => 'SMS',
                'link' => route('sms.index'),
                'hasSub' => false,
                'permission' => 'sms.index',
                'subMenu' => [],
            ],
            [
                'sideIcon' => 'user-check',
                'title' => 'System User',
                'link' => '',
                'hasSub' => true,
                'permission' => 'user.index',
                'subMenu' => [
                    [
                        'sideIcon' => '',
                        'title' => 'Users',
                        'link' => route('user.index'),
                        'permission' => 'user.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Roles',
                        'link' => route('role.index'),
                        'permission' => 'role.index',
                    ],
                    [
                        'sideIcon' => '',
                        'title' => 'Permissions',
                        'link' => route('permission.index'),
                        'permission' => 'permission.index',
                    ],
                ]
            ],

        ];
    }
}
