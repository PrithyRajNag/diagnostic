<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Http\Requests\LabRequest;
use App\Models\Lab;
use App\Repository\LabRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use function GuzzleHttp\Promise\all;

class LabController extends Controller
{
    private $repository;
    public function __construct(LabRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(LabRequest $request)
    {
        try {
           if ($request->ajax()) {
               $data = Lab::latest()->get();
               return DataTables::of($data)->editColumn('address',  function(Lab $lab) {
                   return  $lab->address ?? 'N/A';
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
                       $btn = '<a href="' . route('lab.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                               <a href="' . route('lab.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                               <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('lab.destroy', $row->uuid) . '" name="delBtn"
                                                                   class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                       return $btn;
                   })
                   ->rawColumns(['action', 'status'])
                   ->make(true);
           }
            return view('lab.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        return view('lab.create');
    }

    public function store(LabRequest $request)
    {
        try {
            $validated = $request->validated();
            if($validated)
            {
                $data = $request->all();
                $this->repository->create($data);
                return redirect()->route('lab.index')->with('success', 'Lab Created Successfully');
            }
        }catch(Exception $exception){
            return redirect()->route('lab.index')->withErrors(['errors' => $exception->getMessage()]);
        }

    }


    public function show($uuid)
    {
        $lab = $this->repository->findByUuid($uuid);
        return view('lab.info', ['lab' => $lab]);
    }


    public function edit($uuid)
    {
        $lab= $this->repository->findByUuid($uuid);
        return view('lab.edit', ['lab'=> $lab]);
    }


    public function update(LabRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid, $data);
            return redirect()->route('lab.index')->with('success', 'Lab Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('lab.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('lab.index')->with('success', 'Lab Deleted Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('lab.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
