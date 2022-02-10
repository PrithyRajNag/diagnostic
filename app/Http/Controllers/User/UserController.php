<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\Account;
use App\Models\Ambulance;
use App\Models\Appointment;
use App\Models\BedList;
use App\Models\Department;
use App\Models\DoctorEarningFromTest;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Permission;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Setting;
use App\Models\TestInvoice;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\AuthenticationException;

use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\This;
use PhpParser\Lexer\TokenEmulator\ReadonlyTokenEmulator;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function index(UserRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = User::with('roles')->orderBy('created_at', 'desc')->get();
                return DataTables::of($data)
                    ->addColumn('name', function (User $user) {
                        if ($user->profile != null) {
                            return $user->profile->first_name . ' ' . $user->profile->last_name;
                        } else {
                            return 'N/A';
                        }
                    })
                    ->addColumn('roles', function ($row) {
                        return '<div class="badges p-1">' . $row->roles->map(function ($role) {
                                return '
                                   <a href="' . route('role.show', $role->uuid) . '" class="badge bg-warning mb-1">' . $role->title . '</a>
                                ' ?? 'N/A';
                            })->implode('') . '</div>';

                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = ' <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('user.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'roles'])
                    ->make(true);
            }
            return view('user.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function loginPage()
    {
        $setting = Setting::first();
        return view('user.login', ['setting' => $setting]);
    }

    public function dashboard()
    {

        try {

            $totalDoctors = Profile::where('status', 1)->where('user_type', 'INDOOR')->orWhere('user_type', 'OUTDOOR')->get()->count();
            $totalStaffs = Profile::where('user_type', 'STAFF')->where('status', 1)->get()->count();

            $totalNurses = User::whereHas('roles', function ($q) {
                $getRole = Role::where('slug', 'nurse')->first();
                $q->where('role_assign_to_user.role_id', $getRole->id);
            })->with('profile', function ($query) {
                $query->where('status', 1);
            })->get()->count();
            $totalAdmins =  User::whereHas('roles', function ($q) {
                $getRole = Role::where('slug', 'admin')->first();
                $q->where('role_assign_to_user.role_id', $getRole->id);
            })->with('profile', function ($query) {
                $query->where('status', 1);
            })->get()->count();
            $totalReceptionists = User::whereHas('roles', function ($q) {
                $getRole = Role::where('slug', 'receptionist')->first();
                $q->where('role_assign_to_user.role_id', $getRole->id);
            })->with('profile', function ($query) {
                $query->where('status', 1);
            })->get()->count();
            $totalLaboratorists = User::whereHas('roles', function ($q) {
                $getRole = Role::where('slug', 'laboratorist')->first();
                $q->where('role_assign_to_user.role_id', $getRole->id);
            })->with('profile', function ($query) {
                $query->where('status', 1);
            })->get()->count();

            $totalAccountants = User::whereHas('roles', function ($q) {
                $getRole = Role::where('slug', 'accountant')->first();
                $q->where('role_assign_to_user.role_id', $getRole->id);
            })->with(['profile'])->get()->count();
            $totalPatients = Patient::where('status', 1)->get()->count();
            $dailyPatients = Patient::whereDate('created_at', Carbon::now())->get()->count();
            $admittedlPatients = Patient::where('status', 1)->where('discharge_date', null)->get()->count();
            $totalTests = TestInvoice::all()->count();
            $totalAmbulances = Ambulance::all()->count();
            $totalDue = Payment::where('bonus', 0)->sum('due');
            $totalPatientEarning = TestInvoice::sum('net_total');
            $totalAvailableBed = BedList::where('availability', 1)->where('status', 1)->get()->count();


            $today = Carbon::now()->toDateString();
            $week = Carbon::now()->subDays(6)->toDateString();
            $month = Carbon::now()->subDays(\Carbon\Carbon::now()->subDays(1)->day)->toDateString();
            $year = Carbon::now()->subMonth(\Carbon\Carbon::now()->subMonth(1)->month)->toDateString();

            $todaysAppointments = Appointment::where('appointment_date', $today)->get()->count();
            $earnings = DoctorEarningFromTest::whereDate('created_at', $today)->sum('amount');


            $query = "SELECT t.account_id, t.payment_id , t.amount , t.payment_date, a.id as account_id,
                        a.type , a.account_name, p.id  as payment_id,p.reference_number, p.total
                        FROM transactions AS t
                        INNER JOIN accounts AS a
                        ON t.account_id = a.id AND a.type = 'DEBIT'
                        INNER JOIN payments AS p
                        ON t.payment_id = p.id ";

            $todays = DB::select($query . "  AND t.payment_date BETWEEN '{$today}' AND '{$today}'");
            $weekly = DB::select($query . "  AND t.payment_date BETWEEN '{$week}' AND '{$today}'");
            $monthly = DB::select($query . "  AND t.payment_date BETWEEN '{$month}' AND '{$today}'");
            $yearly = DB::select($query . "  AND t.payment_date BETWEEN '{$year}' AND '{$today}'");
            $dailyEarning = $weeklyEarning = $monthlyEarning = $yearlyEarning = 0;
            foreach ($todays as $item) {
                $dailyEarning += $item->amount;
            }
            foreach ($weekly as $item) {
                $weeklyEarning += $item->amount;
            }
            foreach ($monthly as $item) {
                $monthlyEarning += $item->amount;
            }
            foreach ($yearly as $item) {
                $yearlyEarning += $item->amount;
            }
        } catch (Exception $exception) {

            return $exception->getMessage();
        }

        return view('dashboard.index', [
            'totalAdmins' => $totalAdmins,
            'totalDoctors' => $totalDoctors,
            'totalStaffs' => $totalStaffs,
            'totalNurses' => $totalNurses,
            'totalReceptionists' => $totalReceptionists,
            'totalLaboratorists' => $totalLaboratorists,
            'totalPatients' => $totalPatients,
            'admittedlPatients' => $admittedlPatients,
            'dailyPatients' => $dailyPatients,
            'totalTests' => $totalTests,
            'totalAmbulances' => $totalAmbulances,
            'totalAccountants' => $totalAccountants,
            'totalAvailableBed' => $totalAvailableBed,
            'todaysAppointments' => $todaysAppointments,
            'totalDue' => $totalDue,
            'totalPatientEarning' => $totalPatientEarning,
            'dailyEarning' => $dailyEarning,
            'weeklyEarning' => $weeklyEarning,
            'monthlyEarning' => $monthlyEarning,
            'yearlyEarning' => $yearlyEarning,
            'earnings' => $earnings,
        ]);
    }

    public function logIn(LoginRequest $request, Route $route)
    {

        if ($route->methods()[0] == "POST") {
            try {
                $validated = $request->validated();
                $loggedIn = $this->userRepository->login($validated);

                if ($loggedIn === true) {
                    $request->session()->push('user.info', auth()->user());
                    //store permission in session
                    $user = \auth()->user()->id;
                    $data = User::with(['roles', 'roles.permissions'])->where('id', $user)->first();
                    $role = Arr::get($data, 'roles.0.slug');
                    $permission = Arr::get($data, 'roles');
                    $permissions =[];
                    foreach ($permission as $item){
                        $x = $item['permissions'];
                        array_push($permissions, $x);
                    }
                    $slugs = [];
                    foreach ($permissions as $item){
                        foreach ($item as $i){
                            $permissionsSlug = $i->slug;
                            array_push($slugs,$permissionsSlug);
                        }

                    }
                    $permissionTitle = [];
                    if ($role != 'owner'){
                        array_push($permissionTitle, 'profile.store', 'profile.edit', 'profile.update', 'profile.show');
                    }
                    if ($role == 'owner') {
                        $all_permission = Permission::pluck('slug');
                        foreach ($all_permission as $p) {
                            array_push($permissionTitle, $p);
                        }
                    } else {
                        foreach ($slugs as $item) {
                            array_push($permissionTitle, $item);
                            if ($item == 'human-resource.nurse') {
                                array_push($permissionTitle, 'human-resource.index');
                            } elseif ($item == 'human-resource.laboratorist') {
                                array_push($permissionTitle, 'human-resource.index');
                            } elseif ($item == 'human-resource.pharmacist') {
                                array_push($permissionTitle, 'human-resource.index');
                            }
                            elseif ($item == 'human-resource.accountant') {
                                array_push($permissionTitle, 'human-resource.index');
                            }
                        }
                    }
                    $request->session()->put('permissionTitle', $permissionTitle);
//                    return $request->session()->all();
                    return redirect()->route('dashboard')->with('success', 'Welcome');
                } else {
                    throw new AuthenticationException($loggedIn);
                }
            } catch (\Exception $exception) {
                return back()->withErrors([
                    'error' => $exception->getMessage()
                ]);
            }
        } else {
            return back();
        }

    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', ['roles' => $roles]);
    }

    public function store(UserRequest $request)
    {
        try {
            $data = $request->all();
            $checkDuplication = $this->userRepository->findByEmail($data['email']);
            if ($checkDuplication) {
                throw new Exception('This user is already exist');
            } else {
                $request->validated();
                $user = $this->userRepository->register($request->all());
                return redirect()->route('user.index')->with('success', 'User Created Successfully');

            }
        } catch (\Exception $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage()
            ]);

        }
    }

    public function logout(UserRequest $request)
    {
        try {
            Auth::logout();
            if ($request->session()->has(auth()->user())) {
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login-page');
            } else {
                return 'Logout Failed';
            }
        } catch (\Exception $exception) {
            return back()->withErrors([
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function destroy($uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->first();
            $user_id = $user->id;
            $this->userRepository->deleteByUuid($uuid);
            Profile::where('user_id', $user_id)->delete();
            return redirect()->route('user.index')->with('success', 'User Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('user.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

}
