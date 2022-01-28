<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\Controller;
use App\Http\Requests\BedAssignRequest;
use App\Models\BedAssign;
use App\Models\BedList;
use App\Models\Patient;
use App\Repository\BedAssignRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BedAssignController extends Controller
{
    private $repository;

    public function __construct(BedAssignRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(BedAssignRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = BedList::whereHas('patients')->orderBy('created_at', 'desc')->get();
                return DataTables::of($data)
                    ->addColumn('patients', function ($row) {
                        return '<div class="badges p-1">' . $row->patients->map(function ($assign) {
                                return '
                                   <a href="' . route('patient.show', $assign->uuid) . '" class="badge bg-success mb-1">' . $assign->first_name . ' ' . $assign->last_name . '</a>
                                ';
                            })->implode('') . '</div>';
                    })
                    ->addColumn('bed_number', function (BedList $bedList) {
                        return '<a href="' . route('bed-list.show', $bedList->uuid) . ' " class="badge bg-warning mb-1">' . ($bedList->bed_number) . '</span>' ?? 'N/A';

                    })
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('bed-assign.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mb-1"><i data-feather="edit"></i></a>
                                <a href="' . route('bed-assign.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mb-1"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('bed-assign.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left mb-1"><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'patients', 'bed_number'])
                    ->make(true);
            }
            return view('bed.bedAssign.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        $patients = Patient::all();
        $bedLists = BedList::where('status', 1)->where('availability', true)->get();
        return view('bed.bedAssign.create', ['patients' => $patients, 'bedLists' => $bedLists]);
    }


    public function store(BedAssignRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated) {
                if (auth()->user()->profile != null) {
                    $this->repository->createAssign($request);
                    return redirect()->route('bed-assign.index')->with('success', 'Bed is assigned Successfully');

                } else {
                    throw new Exception('User does not have a name in system');
                }
            }
        } catch (Exception $exception) {
            return redirect()->route('bed-assign.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function show($uuid)
    {
        $bedAssign = $this->repository->bedByUuid($uuid);
        return view('bed.bedAssign.info', ['bedAssign' => $bedAssign]);
    }

    public function edit($uuid)
    {
        $bedAssign = $this->repository->bedByUuid($uuid);
        $patients = Patient::all();
        $bedLists = BedList::where('status', 1)->where('availability', true)->get();

        return view('bed.bedAssign.edit', ['patients' => $patients, 'bedLists' => $bedLists, 'bedAssign' => $bedAssign]);
    }

    public function update(BedAssignRequest $request, $uuid)
    {
        try {
            if (auth()->user()->profile != null) {
                $data = $request->all();
                $this->repository->updateAssign($uuid, $data);
                return redirect()->route('bed-assign.index')->with('success', 'Bed assign updated successfully');
            } else {
                throw new Exception('User does not have a name in system');
            }
        } catch (Exception $exception) {
            return redirect()->route('bed-assign.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function destroy($uuid)
    {
        try {
            $this->repository->deleteAssign($uuid);
            return redirect()->route('bed-assign.index')->with('success', 'Bed Assign deleted successfully');
        } catch (Exception $exception) {
            return redirect()->route('bed-assign.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
