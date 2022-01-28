<?php

namespace App\Providers;

use App\Repository\AccountRepositoryInterface;
use App\Repository\AmbulanceRepositoryInterface;
use App\Repository\AppointmentRepositoryInterface;
use App\Repository\BedAssignRepositoryInterface;
use App\Repository\BedListRepositoryInterface;
use App\Repository\BedTypeRepositoryInterface;
use App\Repository\DepartmentRepositoryInterface;
use App\Repository\DoctorCategoryRepositoryInterface;
use App\Repository\DoctorPercentageRepositoryInterface;
use App\Repository\Eloquent\AccountRepository;
use App\Repository\Eloquent\AmbulanceRepository;
use App\Repository\Eloquent\AppointmentRepository;
use App\Repository\Eloquent\BedAssignRepository;
use App\Repository\Eloquent\BedListRepository;
use App\Repository\Eloquent\BedTypeRepository;
use App\Repository\Eloquent\DepartmentRepository;
use App\Repository\Eloquent\DoctorCategoryRepository;
use App\Repository\Eloquent\DoctorPercentageRepository;
use App\Repository\Eloquent\HumanResourceRepository;
use App\Repository\Eloquent\InvoiceRepository;
use App\Repository\Eloquent\LabRepository;
use App\Repository\Eloquent\OrganizationRepository;

use App\Repository\Eloquent\PackageRepository;
use App\Repository\Eloquent\PatientBillingInvoiceRepository;
use App\Repository\Eloquent\PatientRepository;
use App\Repository\Eloquent\PermissionRepository;
use App\Repository\Eloquent\ProfileRepository;
use App\Repository\Eloquent\RoleRepository;
use App\Repository\Eloquent\SalaryInvoiceRepository;
use App\Repository\Eloquent\ScheduleRepository;
use App\Repository\Eloquent\ServiceRepository;
use App\Repository\Eloquent\SettingRepository;
use App\Repository\Eloquent\PaymentRepository;
use App\Repository\Eloquent\SmsRepository;
use App\Repository\Eloquent\TestCategoryRepository;
use App\Repository\Eloquent\TestInvoiceRepository;
use App\Repository\Eloquent\TestItemRepository;
use App\Repository\Eloquent\TestReportRepository;
use App\Repository\Eloquent\TestReportTemplateRepository;
use App\Repository\Eloquent\TestResultCategoryRepository;
use App\Repository\Eloquent\TestResultItemRepository;
use App\Repository\Eloquent\TestResultUnitRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\NoticeRepository;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\HumanResourceRepositoryInterface;
use App\Repository\InvoiceRepositoryInterface;
use App\Repository\NoticeRepositoryInterface;
use App\Repository\OrganizationRepositoryInterface;
use App\Repository\PackageRepositoryInterface;
use App\Repository\PatientBillingInvoiceRepositoryInterface;
use App\Repository\PatientRepositoryInterface;
use App\Repository\PermissionRepositoryInterface;
use App\Repository\ProfileRepositoryInterface;
use App\Repository\RoleRepositoryInterface;
use App\Repository\SalaryInvoiceRepositoryInterface;
use App\Repository\ScheduleRepositoryInterface;
use App\Repository\ServiceRepositoryInterface;
use App\Repository\SettingRepositoryInterface;
use App\Repository\LabRepositoryInterface;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\SmsRepositoryInterface;
use App\Repository\TestCategoryRepositoryInterface;
use App\Repository\TestInvoiceRepositoryInterface;
use App\Repository\TestItemRepositoryInterface;
use App\Repository\TestReportRepositoryInterface;
use App\Repository\TestReportTemplateRepositoryInterface;
use App\Repository\TestResultCategoryRepositoryInterface;
use App\Repository\TestResultItemRepositoryInterface;
use App\Repository\TestResultUnitRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->bind(OrganizationRepositoryInterface::class, OrganizationRepository::class);
        $this->app->bind(AmbulanceRepositoryInterface::class, AmbulanceRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);

        $this->app->bind(NoticeRepositoryInterface::class, NoticeRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);

        $this->app->bind(LabRepositoryInterface::class, LabRepository::class);
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(TestInvoiceRepositoryInterface::class, TestInvoiceRepository::class);
        $this->app->bind(TestCategoryRepositoryInterface::class, TestCategoryRepository::class);
        $this->app->bind(TestItemRepositoryInterface::class, TestItemRepository::class);
        $this->app->bind(ScheduleRepositoryInterface::class, ScheduleRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(PackageRepositoryInterface::class, PackageRepository::class);
        $this->app->bind(BedTypeRepositoryInterface::class, BedTypeRepository::class);
        $this->app->bind(BedListRepositoryInterface::class, BedListRepository::class);
        $this->app->bind(AppointmentRepositoryInterface::class, AppointmentRepository::class);
        $this->app->bind(HumanResourceRepositoryInterface::class, HumanResourceRepository::class);
        $this->app->bind(BedAssignRepositoryInterface::class, BedAssignRepository::class);
        $this->app->bind(SalaryInvoiceRepositoryInterface::class, SalaryInvoiceRepository::class);
        $this->app->bind(PatientBillingInvoiceRepositoryInterface::class, PatientBillingInvoiceRepository::class);

        $this->app->bind(DoctorPercentageRepositoryInterface::class, DoctorPercentageRepository::class);

        $this->app->bind(TestResultCategoryRepositoryInterface::class, TestResultCategoryRepository::class);
        $this->app->bind(TestResultItemRepositoryInterface::class, TestResultItemRepository::class);
        $this->app->bind(TestResultUnitRepositoryInterface::class, TestResultUnitRepository::class);
        $this->app->bind(TestReportRepositoryInterface::class, TestReportRepository::class);
        $this->app->bind(TestReportTemplateRepositoryInterface::class, TestReportTemplateRepository::class);
        $this->app->bind(SmsRepositoryInterface::class, SmsRepository::class);


    }
}
