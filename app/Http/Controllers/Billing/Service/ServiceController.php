<?php

namespace App\Http\Controllers\Billing\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Repository\ServiceRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    private $repository;
    public function __construct(ServiceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(ServiceRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Service::latest()->get();
                return DataTables::of($data)->editColumn('description',  function(Service $service) {
                        return ucwords($service->description ?? 'N/A');
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
                        $btn = '<a href="' . route('service.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('service.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('service.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
            }
            return  view('billing.service.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function create()
    {
        return  view('billing.service.create');
    }


    public function store(ServiceRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated)
            {
                $data = $request->all();
                $this->repository->create($data);
                return redirect()->route('service.index')->with('success', 'Service Created Successfully');
            }
        }catch (Exception $exception)
        {
            return redirect()->route('service.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $service = $this->repository->findByUuid($uuid);
        return view('billing.service.info', ['service' => $service]);
    }

    public function edit($uuid)
    {
        $service = $this->repository->findByUuid($uuid);

        return view('billing.service.edit', ['service' => $service]);
    }


    public function update(ServiceRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid, $data);
            return redirect()->route('service.index')->with('success', 'Service Updated Successfully');
        }catch (Exception $exception)
        {
            return redirect()->route('service.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('service.index')->with('success', 'Service Deleted Successfully');
        }catch (Exception $exception)
        {
            return redirect()->route('service.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
