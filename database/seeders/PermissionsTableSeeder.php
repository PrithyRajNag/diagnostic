<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $permissions = [
            //Dashboard
            [
                "title" => 'Dashboard',
                "slug" => 'dashboard.index',
            ],
            //profile
            [
                "title" => 'Create Profile',
                "slug" => 'profile.store',
            ],
            [
                "title" => 'Profile Edit View',
                "slug" => 'profile.edit',
            ],
            [
                "title" => 'Profile Update',
                "slug" => 'profile.update',
            ],
            [
                "title" => 'Profile Info',
                "slug" => 'profile.show',
            ],

            //department
            [
                "title" => 'Department List',
                "slug" => 'department.index',
            ],
            [
                "title" => 'Department Create View',
                "slug" => 'department.create',
            ],
            [
                "title" => 'Create Department',
                "slug" => 'department.store',
            ],
            [
                "title" => 'Department Edit View',
                "slug" => 'department.edit',
            ],
            [
                "title" => 'Update Department',
                "slug" => 'department.update',
            ],
            [
                "title" => 'Delete Department',
                "slug" => 'department.destroy',
            ],
            [
                "title" => 'Department Info',
                "slug" => 'department.show',
            ],
            //doctor
            [
                "title" => 'Doctor List',
                "slug" => 'doctor.index',
            ],
            [
                "title" => 'Doctor Create View',
                "slug" => 'doctor.create',
            ],
            [
                "title" => 'Create Doctor',
                "slug" => 'doctor.store',
            ],
            [
                "title" => 'Doctor Edit View',
                "slug" => 'doctor.edit',
            ],
            [
                "title" => 'Update Doctor',
                "slug" => 'doctor.update',
            ],
            [
                "title" => 'Delete Doctor',
                "slug" => 'doctor.destroy',
            ],
            [
                "title" => 'Doctor Info',
                "slug" => 'doctor.show',
            ],
            //patient
            [
                "title" => 'Patient List',
                "slug" => 'patient.index',
            ],
            [
                "title" => 'Patient Create View',
                "slug" => 'patient.create',
            ],
            [
                "title" => 'Create Patient ',
                "slug" => 'patient.store',
            ],
            [
                "title" => 'Patient Edit View',
                "slug" => 'patient.edit',
            ],
            [
                "title" => 'Update Patient',
                "slug" => 'patient.update',
            ],
            [
                "title" => 'Delete Patient',
                "slug" => 'patient.destroy',
            ],
            [
                "title" => 'Patient Info',
                "slug" => 'patient.show',
            ],
            //lab
            [
                "title" => 'Lab List',
                "slug" => 'lab.index',
            ],
            [
                "title" => 'Lab Create View',
                "slug" => 'lab.create',
            ],
            [
                "title" => 'Create Lab',
                "slug" => 'lab.store',
            ],
            [
                "title" => 'Lab Edit View ',
                "slug" => 'lab.edit',
            ],
            [
                "title" => 'Update Lab',
                "slug" => 'lab.update',
            ],
            [
                "title" => 'Delete Lab',
                "slug" => 'lab.destroy',
            ],
            [
                "title" => 'Lab Info',
                "slug" => 'lab.show',
            ],
            //testCategory
            [
                "title" => 'Test Category List',
                "slug" => 'test-category.index',
            ],
            [
                "title" => 'Test Category Create View',
                "slug" => 'test-category.create',
            ],
            [
                "title" => 'Create Test Category',
                "slug" => 'test-category.store',
            ],
            [
                "title" => 'Test Category Edit View',
                "slug" => 'test-category.edit',
            ],
            [
                "title" => 'Update Test Category',
                "slug" => 'test-category.update',
            ],
            [
                "title" => 'Delete Test Category',
                "slug" => 'test-category.destroy',
            ],
            [
                "title" => 'Test Category Info',
                "slug" => 'test-category.show',
            ],
            //testItem
            [
                "title" => 'Test Item List',
                "slug" => 'test-item.index',
            ],
            [
                "title" => 'Test Item Create View',
                "slug" => 'test-item.create',
            ],
            [
                "title" => 'Create Test Item',
                "slug" => 'test-item.store',
            ],
            [
                "title" => 'Test Item Edit View ',
                "slug" => 'test-item.edit',
            ],
            [
                "title" => 'Update Test Item',
                "slug" => 'test-item.update',
            ],
            [
                "title" => 'Delete Test Item',
                "slug" => 'test-item.destroy',
            ],
            [
                "title" => 'Test Item Info',
                "slug" => 'test-item.show',
            ],
            //testResultCategory
            [
                "title" => 'Test Result Category List',
                "slug" => 'test-result-category.index',
            ],
            [
                "title" => 'Test Result Category Create View',
                "slug" => 'test-result-category.create',
            ],
            [
                "title" => 'Create Test Result Category',
                "slug" => 'test-result-category.store',
            ],
            [
                "title" => 'Test Item Result Category View ',
                "slug" => 'test-result-category.edit',
            ],
            [
                "title" => 'Update Test Result Category',
                "slug" => 'test-result-category.update',
            ],
            [
                "title" => 'Delete Test Result Category',
                "slug" => 'test-result-category.destroy',
            ],
            [
                "title" => 'Test Result Category Info',
                "slug" => 'test-result-category.show',
            ],
            //testResultItem
            [
                "title" => 'Test Result Item List',
                "slug" => 'test-result-item.index',
            ],
            [
                "title" => 'Test Result Item Create View',
                "slug" => 'test-result-item.create',
            ],
            [
                "title" => 'Create Test Result Item',
                "slug" => 'test-result-item.store',
            ],
            [
                "title" => 'Test Result Item Edit View ',
                "slug" => 'test-result-item.edit',
            ],
            [
                "title" => 'Update Test Result Item',
                "slug" => 'test-result-item.update',
            ],
            [
                "title" => 'Delete Test Result Item',
                "slug" => 'test-result-item.destroy',
            ],
            [
                "title" => 'Test Result Item Info',
                "slug" => 'test-result-item.show',
            ],
            //testResultUnit
            [
                "title" => 'Test Result Unit List',
                "slug" => 'test-result-unit.index',
            ],
            [
                "title" => 'Test Result Unit Create View',
                "slug" => 'test-result-unit.create',
            ],
            [
                "title" => 'Create Test Result Unit',
                "slug" => 'test-result-unit.store',
            ],
            [
                "title" => 'Test Result Unit Edit View ',
                "slug" => 'test-result-unit.edit',
            ],
            [
                "title" => 'Update Test Result Unit',
                "slug" => 'test-result-unit.update',
            ],
            [
                "title" => 'Delete Test Result Unit',
                "slug" => 'test-result-unit.destroy',
            ],
            [
                "title" => 'Test Result Unit Info',
                "slug" => 'test-result-unit.show',
            ],
            //testReport
            [
                "title" => 'Test Report List',
                "slug" => 'test-report.index',
            ],
            [
                "title" => 'Test Report Create View',
                "slug" => 'test-report.create',
            ],
            [
                "title" => 'Create Test Report',
                "slug" => 'test-report.store',
            ],
            [
                "title" => 'Test Report Edit View ',
                "slug" => 'test-report.edit',
            ],
            [
                "title" => 'Update Test Report',
                "slug" => 'test-report.update',
            ],
            [
                "title" => 'Delete Test Report',
                "slug" => 'test-report.destroy',
            ],
            [
                "title" => 'Test Report Info',
                "slug" => 'test-report.show',
            ],
            //testReportTemplate
            [
                "title" => 'Test Report Template List',
                "slug" => 'test-report-template.index',
            ],
            [
                "title" => 'Test Report Template Create View',
                "slug" => 'test-report-template.create',
            ],
            [
                "title" => 'Create Test Report Template',
                "slug" => 'test-report-template.store',
            ],
            [
                "title" => 'Test Report Template Edit View ',
                "slug" => 'test-report-template.edit',
            ],
            [
                "title" => 'Update Test Report Template',
                "slug" => 'test-report-template.update',
            ],
            [
                "title" => 'Delete Test Report Template',
                "slug" => 'test-report-template.destroy',
            ],
            [
                "title" => 'Test Report Template Info',
                "slug" => 'test-report-template.show',
            ],
            //schedule
            [
                "title" => 'Schedule List',
                "slug" => 'schedule.index',
            ],
            [
                "title" => 'Schedule Create View',
                "slug" => 'schedule.create',
            ],
            [
                "title" => 'Create Schedule',
                "slug" => 'schedule.store',
            ],
            [
                "title" => 'Schedule Edit View',
                "slug" => 'schedule.edit',
            ],
            [
                "title" => 'Update Schedule',
                "slug" => 'schedule.update',
            ],
            [
                "title" => 'Delete Schedule',
                "slug" => 'schedule.destroy',
            ],
            [
                "title" => 'Schedule Info',
                "slug" => 'schedule.show',
            ],
            //appointment
            [
                "title" => 'Appointment List',
                "slug" => 'appointment.index',
            ],
            [
                "title" => 'Appointment Create View',
                "slug" => 'appointment.create',
            ],
            [
                "title" => 'Create Appointment',
                "slug" => 'appointment.store',
            ],
            [
                "title" => 'Appointment Edit View',
                "slug" => 'appointment.edit',
            ],
            [
                "title" => 'Update Appointment',
                "slug" => 'appointment.update',
            ],
            [
                "title" => 'Delete Appointment',
                "slug" => 'appointment.destroy',
            ],
            [
                "title" => 'Appointment Info',
                "slug" => 'appointment.show',
            ],
            [
                "title" => "Today's Appointments List",
                "slug" => 'appointment-for-today.appointments',
            ],
            //account
            [
                "title" => 'Account List',
                "slug" => 'account.index',
            ],
            [
                "title" => 'Account Create View',
                "slug" => 'account.create',
            ],
            [
                "title" => 'Create Account',
                "slug" => 'account.store',
            ],
            [
                "title" => 'Account Edit View ',
                "slug" => 'account.edit',
            ],
            [
                "title" => 'Update Account',
                "slug" => 'account.update',
            ],
            [
                "title" => 'Delete Account',
                "slug" => 'account.destroy',
            ],
            [
                "title" => 'Account Info',
                "slug" => 'account.show',
            ],
            //payment
            [
                "title" => 'Payment List',
                "slug" => 'payment.index',
            ],
            [
                "title" => 'Payment Create View',
                "slug" => 'payment.create',
            ],
            [
                "title" => 'Create Payment',
                "slug" => 'payment.store',
            ],
            [
                "title" => 'Payment Edit View',
                "slug" => 'payment.edit',
            ],
            [
                "title" => 'Update Payment',
                "slug" => 'payment.update',
            ],
            [
                "title" => 'Delete Payment',
                "slug" => 'payment.destroy',
            ],
            [
                "title" => 'Payment Info',
                "slug" => 'payment.show',
            ],
            //testInvoice
            [
                "title" => 'Test Invoice List',
                "slug" => 'test-invoice.index',
            ],
            [
                "title" => 'Test Invoice Create View',
                "slug" => 'test-invoice.create',
            ],
            [
                "title" => 'Create Test Invoice',
                "slug" => 'test-invoice.store',
            ],
            [
                "title" => 'Test Invoice Edit View',
                "slug" => 'test-invoice.edit',
            ],
            [
                "title" => 'Update Test Invoice',
                "slug" => 'test-invoice.update',
            ],
            [
                "title" => 'Delete Test Invoice',
                "slug" => 'test-invoice.destroy',
            ],
            [
                "title" => 'Test Invoice Info',
                "slug" => 'test-invoice.show',
            ],
            [
                "title" => 'Test Invoice PDF',
                "slug" => 'test-invoice.pdf',
            ],
            //salaryInvoice
            [
                "title" => 'Salary Invoice List',
                "slug" => 'salary-invoice.index',
            ],
            [
                "title" => 'Salary Invoice Create View',
                "slug" => 'salary-invoice.create',
            ],
            [
                "title" => 'Create Salary Invoice',
                "slug" => 'salary-invoice.store',
            ],
            [
                "title" => 'Salary Invoice Edit View',
                "slug" => 'salary-invoice.edit',
            ],
            [
                "title" => 'Update Salary Invoice',
                "slug" => 'salary-invoice.update',
            ],
            [
                "title" => 'Delete Salary Invoice',
                "slug" => 'salary-invoice.destroy',
            ],
            [
                "title" => 'Salary Invoice Info',
                "slug" => 'salary-invoice.show',
            ],
            //debitReport
            [
                "title" => 'Debit Report List',
                "slug" => 'report.debit',
            ],
            //creditReport
            [
                "title" => 'Credit Report List',
                "slug" => 'report.credit',
            ],
            //staff
            [
                "title" => 'Human Resource List',
                "slug" => 'human-resource.index',
            ],
            [
                "title" => 'Staff Create View',
                "slug" => 'human-resource.create',
            ],
            [
                "title" => 'Create Staff',
                "slug" => 'human-resource.store',
            ],
            [
                "title" => 'Staff Edit View',
                "slug" => 'human-resource.edit',
            ],
            [
                "title" => 'Update Staff',
                "slug" => 'human-resource.update',
            ],
            [
                "title" => 'Delete Staff',
                "slug" => 'human-resource.destroy',
            ],
            [
                "title" => 'Staff Info',
                "slug" => 'human-resource.show',
            ],
            //accountant
            [
                "title" => 'Human Resource(Accountant)',
                "slug" => 'human-resource.accountant',
            ],
            //laboratorist
            [
                "title" => 'Human Resource(Laboratorist)',
                "slug" => 'human-resource.laboratorist',
            ],
            //nurse
            [
                "title" => 'Human Resource(Nurse)',
                "slug" => 'human-resource.nurse',
            ],
            //pharmacist
            [
                "title" => 'Human Resource(Pharmacist)',
                "slug" => 'human-resource.pharmacist',
            ],
            //receptionist
            [
                "title" => 'Human Resource(Receptionist)',
                "slug" => 'human-resource.receptionist',
            ],
            //noticeBoard
            [
                "title" => 'Notice List',
                "slug" => 'noticeboard.index',
            ],
            [
                "title" => 'Notice Create View',
                "slug" => 'noticeboard.create',
            ],
            [
                "title" => 'Create Notice',
                "slug" => 'noticeboard.store',
            ],
            [
                "title" => 'Notice Edit View',
                "slug" => 'noticeboard.edit',
            ],
            [
                "title" => 'Update Notice',
                "slug" => 'noticeboard.update',
            ],
            [
                "title" => 'Delete Notice',
                "slug" => 'noticeboard.destroy',
            ],
            [
                "title" => 'Notice Info',
                "slug" => 'noticeboard.show',
            ],
            //user
            [
                "title" => 'User List',
                "slug" => 'user.index',
            ],
            [
                "title" => 'User Create View',
                "slug" => 'user.create',
            ],
            [
                "title" => 'Create User',
                "slug" => 'user.store',
            ],
            [
                "title" => 'User Edit View',
                "slug" => 'user.edit',
            ],
            [
                "title" => 'Update User',
                "slug" => 'user.update',
            ],
            [
                "title" => 'Delete User',
                "slug" => 'user.destroy',
            ],
            [
                "title" => 'User Info',
                "slug" => 'user.show',
            ],
            //role
            [
                "title" => 'Role List',
                "slug" => 'role.index',
            ],
            [
                "title" => 'Role Create View',
                "slug" => 'role.create',
            ],
            [
                "title" => 'Create Role',
                "slug" => 'role.store',
            ],
            [
                "title" => 'Role Edit View',
                "slug" => 'role.edit',
            ],
            [
                "title" => 'Update Role',
                "slug" => 'role.update',
            ],
            [
                "title" => 'Delete Role',
                "slug" => 'role.destroy',
            ],
            [
                "title" => 'Role Info',
                "slug" => 'role.show',
            ],
            //permission
            [
                "title" => 'Permission List',
                "slug" => 'permission.index',
            ],
            [
                "title" => 'Permission Create View',
                "slug" => 'permission.create',
            ],
            [
                "title" => 'Create Permission',
                "slug" => 'permission.store',
            ],
            [
                "title" => 'Permission Edit View',
                "slug" => 'permission.edit',
            ],
            [
                "title" => 'Update Permission',
                "slug" => 'permission.update',
            ],
            [
                "title" => 'Delete Permission',
                "slug" => 'permission.destroy',
            ],
            [
                "title" => 'Permission Info',
                "slug" => 'permission.show',
            ],
            //Doctor Percentage
            [
                "title" => 'Doctor Percentage List',
                "slug" => 'doctor-percentage.index',
            ],
            [
                "title" => 'Doctor Percentage Create View',
                "slug" => 'doctor-percentage.create',
            ],
            [
                "title" => 'Create Doctor Percentage',
                "slug" => 'doctor-percentage.store',
            ],
            [
                "title" => 'Doctor Percentage Edit View',
                "slug" => 'doctor-percentage.edit',
            ],
            [
                "title" => 'Update Doctor Percentage',
                "slug" => 'doctor-percentage.update',
            ],
            [
                "title" => 'Delete Doctor Percentage',
                "slug" => 'doctor-percentage.destroy',
            ],
            [
                "title" => 'Doctor Percentage Info',
                "slug" => 'doctor-percentage.show',
            ],
            //setting
            [
                "title" => 'Setting Create View',
                "slug" => 'setting.create',
            ],
            [
                "title" => 'Create Setting',
                "slug" => 'setting.store',
            ],
            [
                "title" => 'Setting Edit View',
                "slug" => 'setting.edit',
            ],
            [
                "title" => 'Update Setting',
                "slug" => 'setting.update',
            ],
            //SMS
            [
                "title" => 'Sms List',
                "slug" => 'sms.index',
            ],
            [
                "title" => 'Sms Create View',
                "slug" => 'sms.create',
            ],
            [
                "title" => 'Create Sms',
                "slug" => 'sms.store',
            ],
            [
                "title" => 'Delete Sms',
                "slug" => 'sms.destroy',
            ],
            [
                "title" => 'Sms Info',
                "slug" => 'sms.show',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
