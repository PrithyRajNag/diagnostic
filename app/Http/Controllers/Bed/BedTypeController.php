<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\Controller;
use App\Http\Requests\BedTypeRequest;
use App\Models\BedType;
use App\Repository\BedTypeRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\InvalidTag;
use Yajra\DataTables\Facades\DataTables;

class BedTypeController extends Controller
{
    private $repository;
    public function __construct(BedTypeRepositoryInterface $repository)
    {
        $this->repository = $repository;

    }

    public function index(BedTypeRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = BedType::latest()->get();
                return DataTables::of($data)->editColumn('description',  function(BedType $bedType) {
                    return ucwords($bedType->description ?? 'N/A');
                })
                    ->addColumn('title',  function(BedType $bedType) {
                        return ucwords($bedType->title ?? 'N/A');
                    })
                    ->addColumn('status',  function(BedType $bedType) {
                        if($bedType->status == 1){
                            return '<span class="badge bg-success mb-1">'.($bedType->status == 0 ? "Inactive" : "Active").'</span>' ?? 'N/A';
                        }
                        else{
                            return '<span class="badge bg-danger mb-1">'.($bedType->status == 0 ? "Inactive" : "Active").'</span>' ?? 'N/A';
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('bed-type.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('bed-type.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('bed-type.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
            }
            return view('bed.bedType.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }


    public function create()
    {
        return view('bed.bedType.create');
    }


    public function store(BedTypeRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated)
            {
                $data = $request->all();
                $checkDuplication = $this->repository->findByTitle($data['title']);
                if ($checkDuplication)
                {
                    throw new \Exception('Title should be unique');
                }
                else{
                    $this->repository->create($data);
                    return redirect()->route('bed-type.index')->with('success', 'Bed Type Created Successfully');
                }
            }
        }
        catch (Exception $exception)
        {
            return redirect()->route('bed-type.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $bedType = $this->repository->findByUuid($uuid);
        return view('bed.bedType.info', ['bedType' => $bedType]);
    }


    public function edit($uuid)
    {
        $bedType = $this->repository->findByUuid($uuid);
        return view('bed.bedType.edit', ['bedType' => $bedType]);
    }


    public function update(BedTypeRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid, $data);
            return redirect()->route('bed-type.index')->with('success', 'Bed Type Updated Successfully');

        }
        catch (Exception $exception)
        {
            return redirect()->route('bed-type.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('bed-type.index')->with('success', 'Bed Type Deleted Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('bed-type.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
