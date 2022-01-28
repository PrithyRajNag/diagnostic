<?php

namespace App\Http\Controllers\Billing\Package;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Models\Package;
use App\Models\Service;
use App\Repository\PackageRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Utils;
use Yajra\DataTables\Facades\DataTables;

class PackageController extends Controller
{
    private $repository;

    public function __construct(PackageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function index(PackageRequest $request)
    {

        try {
            if ($request->ajax()) {
                $data = Package::with('services')->orderBy('created_at', 'desc')->get();
                return DataTables::of($data)->editColumn('description', function ($row) {
                    return ucwords($row->description ?? 'N/A');
                })
                    ->editColumn('status', function ($row) {
                        if ($row->status == 1){
                            return '<span class="badge bg-success mb-1">'.($row->status == 0 ? "Inactive" : "Active") .'</span>';
                        }
                        else{
                            return '<span class="badge bg-danger mb-1">'.($row->status == 0 ? "Inactive" : "Active") .'</span>';
                        }
                    })
                    ->addColumn('services', function ($row){
                        return '<div class="badges p-1">'.$row->services->map(function($service){
                                return '
                                   <a href="'.route('service.show',$service->uuid).'" class="badge bg-success mb-1">'. $service->service_name . '</a>
                                ';
                            })->implode('') . '</div>';

                      })

                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('package.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mb-1"><i data-feather="edit"></i></a>
                                <a href="' . route('package.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left mb-1"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('package.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left mb-1"><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'services','status'])
                    ->make(true);
            }
            return view('billing.package.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function create()
    {
        $services = Service::all();
        return view('billing.package.create', ['services' => $services]);
    }

    public function store(PackageRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated) {
                $this->repository->createPackage($request);
               return redirect()->route('package.index')->with('success', 'Package Created Successfully');
            }
        } catch (Exception $exception) {
            return redirect()->route('package.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function show($uuid)
    {
        $package = $this->repository->findByUuid($uuid);
        return view('billing.package.info', ['package' => $package]);
    }

    public function edit($uuid)
    {
        $services = Service::all();
        $package = $this->repository->packageById($uuid);
        return view('billing.package.edit', ['package' => $package, 'services' => $services]);
    }

    public function update(PackageRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updatePackage($uuid, $data);
            return redirect()->route('package.index')->with('success', 'Package Updated Successfully');
        } catch (Exception $exception) {
            return redirect()->route('package.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function destroy($uuid)
    {
        try {
            $package = $this->repository->deleteByUuid($uuid);
            return redirect()->route('package.index')->with('success', 'Package Deleted Successfully');
        } catch (Exception $exception) {
            return redirect()->route('package.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
