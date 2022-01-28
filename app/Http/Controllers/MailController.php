<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MailController extends Controller
{
//    private $repository;
//    public function __construct(OrganizationRepositoryInterface $repository)
//    {
//        $this->repository = $repository;
//    }
    public function index(MailRequest $request)
    {
        try {
//            if ($request->ajax()) {
//                $data = Mail::latest()->get();
//                return DataTables::of($data)
//                    ->addIndexColumn()
//                    ->addColumn('action', function ($row) {
//                        $btn = '<a href="' . route('mail.edit', $row->id) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
//                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('organization.destroy', $row->id) . '" name="delBtn"
//                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
//                        return $btn;
//                    })
//                    ->rawColumns(['action'])
//                    ->make(true);
//            }
            return view('mail.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function create()
    {
        return view('mail.create');
    }

    public function store(MailRequest $request)
    {
//        dd($request->all());
        try {
            $validated = $request->validated();
            $data = $request->all();
            if ($validated) {
                $this->repository->create($data);
                return redirect()->route('mail.index')->with('success', 'Mail Send Successfully');
            }
        } catch (\Exception $e) {
            return redirect()->route('mail.index')->withErrors(['errors' => $e->getMessage()]);
        }
    }
}
