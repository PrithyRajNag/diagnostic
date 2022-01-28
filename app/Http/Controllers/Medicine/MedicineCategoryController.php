<?php

namespace App\Http\Controllers\Medicine;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class MedicineCategoryController extends Controller
{
    public function index()
    {
        try {
//            if ($request->ajax()) {
//                $data = Patient::latest()->get();
//                return DataTables::of($data)->editColumn('description',  function(Patient $patient) {
////                    return  $department->description ? $department->description : 'N/A';
//                })
//                    ->addIndexColumn()
//                    ->addColumn('action', function ($row) {
//                        $btn = '<a href="' . route('patient.edit', $row->id) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
//                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('patient.destroy', $row->id) . '" name="delBtn"
//                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
//                        return $btn;
//                    })
//                    ->rawColumns(['action'])
//                    ->make(true);
//            }
            return view('medicineCategory.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function create()
    {
        return view('medicineCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
