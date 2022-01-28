<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeRequest;
use App\Models\Notice;
use App\Repository\NoticeRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NoticeController extends Controller
{
    private $repository;
    public function __construct(NoticeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function index(NoticeRequest $request)
    {
        try {
           if ($request->ajax()) {
               $data = Notice::latest()->get();
               return DataTables::of($data)
                   ->editColumn('description',  function(Notice $notice) {
                   return ucwords($notice->description ?? 'N/A');
               })
                   ->addIndexColumn()
                   ->addColumn('action', function ($row) {
                       $btn = '<a href="' . route('notice.edit', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <a href="' . route('notice.show', $row->uuid) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
                               <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('notice.destroy', $row->id) . '" name="delBtn"
                                                                   class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                       return $btn;
                   })
                   ->rawColumns(['action'])
                   ->make(true);
           }
            return view('notice.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        return view('notice.create');
    }


    public function store(NoticeRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated) {
                $this->repository->createNotice($request);
                return redirect()->route('notice.index')->with('success', 'Notice Created Successfully');
            }
        }
        catch (\Exception $exception)
        {
            return redirect()->route('notice.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $notice = $this->repository->findByUuid($uuid);
        return view('notice.info',['notice' => $notice]);
    }

    public function edit($uuid)
    {
        $notice = $this->repository->findByUuid($uuid);
        return view('notice.edit', ['notice'=> $notice]);
    }


    public function update(NoticeRequest $request, $uuid)
    {
        try {
            $this->repository->updateNotice($uuid,$request);
            return redirect()->route('notice.index')->with('success', 'Notice Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('notice.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            $data = $this->repository->deleteById($id);
            if (!$data) {
                return back()->withErrors([
                    'message'=>"Notice cannot be deleted",
                ]);
            } else {
                return back()->with('success', 'Notice deleted successfully');
            }
        }catch (Exception $exception)
        {
            return redirect()->route('notice.index')->withErrors(['errors'=> $exception->getMessage()]);
        }


    }
    public function download($uuid)
    {
        $document = Notice::where('uuid', $uuid)->firstOrFail();
        $pathToFile = storage_path('app/public/documents/' . $document->document);
        return response()->download($pathToFile);
    }
}
