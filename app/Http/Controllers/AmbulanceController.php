<?php

namespace App\Http\Controllers;

use App\Http\Requests\AmbulanceRequest;
use App\Models\Ambulance;
use App\Repository\AmbulanceRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AmbulanceController extends Controller
{
    private $repository;

    public function __construct(AmbulanceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(AmbulanceRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Ambulance::latest()->get();
                return DataTables::of($data)
                    ->addColumn('status', function ($row) {
                        if($row->status == 1) {
                            return '<span class="badge bg-success mb-1">' . ($row->status == 0 ? "Inactive" : "Active") . '</span>';
                        }else {
                            return '<span class="badge bg-danger mb-1">' . ($row->status == 0 ? "Inactive" : "Active") . '</span>';
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('ambulance.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('ambulance.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('ambulance.destroy', $row->id) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
            }
            return view('ambulance.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        return view('ambulance.create');
    }


    public function store(AmbulanceRequest $request)
    {
        try {
            $validated = $request->validated();
            $data = $request->all();

            $this->repository->create($data);
            return redirect()->route('ambulance.index')->with('success', 'Ambulance Created Successfully');
        } catch (\Exception $exception) {
            return redirect()->route('ambulance.index')->withErrors(['errors' => $exception->getMessage()]);
        }

    }


    public function show($uuid)
    {
        $data = $this->repository->findByUuid($uuid);
        return view('ambulance.info', ['data' => $data]);
    }


    public function edit($uuid)
    {
        $ambulance = $this->repository->findByUuid($uuid);
        return view('ambulance.edit', ['ambulance' => $ambulance]);
    }


    public function update(AmbulanceRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid, $data);
            return redirect()->route('ambulance.index')->with('success', 'Ambulance Updated Successfully');
        } catch (Exception $exception) {
            return redirect()->route('ambulance.index')->withErrors(['errors' => $exception->getMessage()]);
        }

    }


    public function destroy($id)
    {
        try {
            $data = $this->repository->deleteById($id);
            if (!$data) {
                return back()->withErrors([
                    'message' => "Role cannot be deleted",
                ]);
            } else {
                return back()->with('success', 'Ambulance deleted successfully');
            }
        } catch (Exception $exception) {
            return redirect()->route('ambulance.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
