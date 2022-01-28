<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use App\Repository\PermissionRepositoryInterface;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    private $repository;
    public function __construct(PermissionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(PermissionRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Permission::latest()->get();
                return DataTables::of($data)->editColumn('description',  function(Permission $permission) {
                    return  $permission->description ?? 'N/A';
                })
                    ->editColumn('status', function ($row) {
                        if ($row->status == 1){
                            return '<span class="badge bg-success mb-1">'.($row->status == 0 ? "Inactive" : "Active") .'</span>';
                        }
                        else{
                            return '<span class="badge bg-danger mb-1">'.($row->status == 0 ? "Inactive" : "Active") .'</span>';
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('permission.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('permission.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
            }
            return view('permission.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        return view('permission.create');
    }


    public function store(PermissionRequest $request)
    {
        try {

            $validated = $request->validated();
            if ($validated) {
            $data = $request->all();
            $checkDuplication = $this->repository->findByTitle($data['title']);
            if ($checkDuplication)
            {
                throw new Exception('Title should be unique');
            }
            else{
                $this->repository->create($data);
                return redirect()->route('permission.index')->with('success', 'Permission created successfully');
            }
            }
        }
        catch (Exception $exception){
            return redirect()->route('permission.index')->withErrors(['error'=>$exception->getMessage()]);
        }

    }

    public function show($uuid)
    {
        $permission = $this->repository->findByUuid($uuid);
        return view('permission.info', ['permission' => $permission]);
    }


    public function edit($uuid)
    {
        $data = $this->repository->findByUuid($uuid);
        return view('permission.edit', ['data' => $data]);
    }


    public function update(PermissionRequest $request, $uuid)
    {
        try {
                $data = $request->all();
                $this->repository->updateByUuid($uuid,$data);
                return redirect()->route('permission.index')->with('success', 'Permission Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('permission.index')->withErrors(['error'=> $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('permission.index')->with('success', 'Permission Deleted Successfully');
        }catch (Exception $exception)
        {
            return redirect()->route('permission.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
