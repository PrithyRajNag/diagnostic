<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Repository\DepartmentRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\InvalidTag;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    private $repository;
    public function __construct(DepartmentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(DepartmentRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Department::latest()->get();
                return DataTables::of($data)->editColumn('description',  function(Department $department) {
                    return  $department->description ?? 'N/A';
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
                        $btn = '<a href="' . route('department.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('department.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('department.destroy', $row->id) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
            }
            return view('department.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        return view('department.create');
    }


    public function store(DepartmentRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated){
                $data = $request->all();
                $checkDuplication = $this->repository->findByTitle($data['title']);
                if ($checkDuplication) {
                    throw new \Exception('Title should be unique');
                } else {
                    $this->repository->create($data);
                    return redirect()->route('department.index')->with('success', 'Department Created Successfully');
                }
            }
        }catch (Exception $exception){
            return  redirect()->route('department.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $department = $this->repository->findByUuid($uuid);
        return view('department.info', ['department' => $department]);
    }


    public function edit($uuid)
    {
        $department = $this->repository->findByUuid($uuid);
        return view('department.edit', ['department'=>$department]);
    }


    public function update(DepartmentRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid, $data);
            return redirect()->route('department.index')->with('success', 'Department Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('department.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            $this->repository->findById($id)->delete();
            return redirect()->route('department.index')->with('success', 'Department Deleted Successfully');
        }catch (Exception $exception)
        {
            return redirect()->route('department.index')->withErrors(['errors' => $exception->getMessage()] );
        }
    }
}
