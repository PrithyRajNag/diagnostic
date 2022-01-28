<?php

namespace App\Http\Controllers\DoctorPercentage;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorPercentageRequest;
use App\Models\Department;
use App\Models\DoctorEarningFromTest;
use App\Models\DoctorPercentage;
use App\Models\Profile;
use App\Repository\DoctorPercentageRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class DoctorPercentageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    private $repository;
    public function __construct(DoctorPercentageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(DoctorPercentageRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = DoctorPercentage::latest()->get();
                return DataTables::of($data)->editColumn('doctor_id', function (DoctorPercentage $doctorPercentage){
                    return $doctorPercentage->doctors->full_name . ' (' . $doctorPercentage->doctors->departments->title .')' ?? 'N/A' ;
                })
                    ->addColumn('status', function ($row) {
                        if($row->status == 1) {
                            return '<span class="badge bg-success mb-1">' . ($row->status == 0 ? "Inactive" : "Active") . '</span>';
                        }else {
                            return '<span class="badge bg-danger mb-1">' . ($row->status == 0 ? "Inactive" : "Active") . '</span>';
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('doctor-percentage.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('doctor-percentage.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('doctor-percentage.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
            }
            return view('doctorPercentage.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $departments = Department::all();
        $doctors = Profile::where('user_type', 'INDOOR')->orWhere('user_type', 'OUTDOOR')->get();
        return view('doctorPercentage.create', ['doctors' => $doctors, 'departments' => $departments]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DoctorPercentageRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated)
            {
                $data = $request->all();
                $this->repository->create($data);
                return redirect()->route('doctor-percentage.index')->with('success', 'Doctor Percentage Created Successfully');
            }
        }catch (Exception $exception) {
            return redirect()->route('doctor-percentage.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($uuid)
    {

        $doctorPercentage = $this->repository->findByUuid($uuid);
        $today = Carbon::now()->toDateString();
        $earning = DoctorEarningFromTest::where('doctor_percentage_id', $doctorPercentage->id)->whereDate('created_at', $today)->sum('amount');

        return view('doctorPercentage.info', ['doctorPercentage' => $doctorPercentage, 'earning' => $earning]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($uuid)
    {
        $doctorPercentage = $this->repository->findByUuid($uuid);
        $departments = Department::all();
        $doctors = Profile::where('user_type', 'INDOOR')->orWhere('user_type', 'OUTDOOR')->get();
        return view('doctorPercentage.edit', ['doctorPercentage' => $doctorPercentage, 'departments' => $departments, 'doctors' => $doctors]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DoctorPercentageRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid, $data);
            return redirect()->route('doctor-percentage.index')->with('success', 'Doctor Percentage Updated Successfully');

        }catch (Exception $exception) {
            return redirect()->route('doctor-percentage.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($uuid)
    {
        try {
           $this->repository->deleteByUuid($uuid);
            return redirect()->route('doctor-percentage.index')->with('success', 'Doctor Percentage Deleted Successfully');
        }catch (Exception $exception) {
            return redirect()->route('doctor-percentage.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function getDoctorPercentage($id)
    {
        $percentage = DoctorPercentage::where('id', $id)->select('percentage')->first();
        return $percentage;
    }

}
