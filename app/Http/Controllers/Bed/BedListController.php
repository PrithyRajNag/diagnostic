<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\Controller;
use App\Http\Requests\BedListRequest;
use App\Models\BedList;
use App\Models\BedType;
use App\Repository\BedListRepositoryInterface;

use Yajra\DataTables\Exceptions\Exception;
use Yajra\DataTables\Facades\DataTables;


class BedListController extends Controller
{
    private $repository;
    public function __construct(BedListRepositoryInterface $repository)
    {
        $this->repository = $repository;

    }
    public function index(BedListRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = BedList::latest()->get();
                return DataTables::of($data)->editColumn('description',  function(BedList $bedList) {
                    return ucwords($bedList->description ?? 'N/A');
                })
                    ->addColumn('bed_type_id',  function(BedList $bedList) {
                        return  ucwords($bedList->bedTypes->title ?? 'N/A');
                    })
                    ->addColumn('bed_number',  function(BedList $bedList) {
                        return  ucwords($bedList->bed_number ?? 'N/A');
                    })
                    ->addColumn('status',  function(BedList $bedList) {
                        if($bedList->status == 1){
                            return '<span class="badge bg-success mb-1">'.($bedList->status == 0 ? "Inactive" : "Active").'</span>' ?? 'N/A';
                        }
                        else{
                            return '<span class="badge bg-danger mb-1">'.($bedList->status == 0 ? "Inactive" : "Active").'</span>' ?? 'N/A';
                        }
                    })
                    ->addColumn('availability',  function(BedList $bedList) {
                        if($bedList->availability == 1){
                            return '<span class="badge bg-success mb-1">'.($bedList->availability == 0 ? "Not Available" : "Available").'</span>' ?? 'N/A';
                        }
                        else{
                            return '<span class="badge bg-danger mb-1">'.($bedList->availability == 0 ? "Not Available" : "Available").'</span>' ?? 'N/A';
                        }
                    })

                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('bed-list.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('bed-list.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('bed-list.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status','availability'])
                    ->make(true);
            }
            return view('bed.bedList.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }


    public function create()
    {
        $bedtypes = BedType::where('status',1)->get();
        return view('bed.bedList.create', ['bedTypes' => $bedtypes]);
    }


    public function store(BedListRequest $request)
    {
        try {
            $validation = $request->validated();
            if ($validation)
            {
                $data = $request->all();
                $this->repository->create($data);
                return redirect()->route('bed-list.index')->with('success', 'Bed List Created Successfully');
            }
        }catch (\Exception $exception)
        {
            return redirect()->route('bed-list.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $bedList = $this->repository->findByUuid($uuid);
        return view('bed.bedList.info', ['bedList' => $bedList]);
    }


    public function edit($uuid)
    {

        $bedList = $this->repository->findByUuid($uuid) ;
        $bedTypes = BedType::all();
        return view('bed.bedList.edit', ['bedList' => $bedList, 'bedTypes' => $bedTypes]);
    }

    public function update(BedListRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateByUuid($uuid, $data);
            return redirect()->route('bed-list.index')->with('success', 'Bed List Updated Successfully');
        }
        catch (\Exception $exception)
        {
            return redirect()->route('bed-list.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('bed-list.index')->with('success', 'Bed List Deleted Successfully');
        }
        catch (\Exception $exception)
        {
            return redirect()->route('bed-list.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
