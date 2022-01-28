<?php

namespace App\Http\Controllers\Blood;

use App\Http\Controllers\Controller;
use App\Http\Requests\BloodOutputRequest;
use App\Models\BloodOutput;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BloodOutputController extends Controller
{

    public function index(BloodOutputRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = BloodOutput::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('blood-output.edit', $row->id) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('blood-output.destroy', $row->id) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('blood.output.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        return view('blood.output.create');
    }


    public function store(BloodOutputRequest $request)
    {

    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = BloodOutput::find($id);
        return view('blood.output.edit', ['data' => $data]);
    }


    public function update(BloodOutputRequest $request, $id)
    {
        try {
            $data = $request->all();
            $this->repository->update($id,$data);
            return redirect()->route('blood-output.index')->with('success', 'Blood Output Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('blood-output.index')->withErrors(['error'=> $exception->getMessage()]);
        }
    }


    public function destroy($id)
    {
        $data = $this->repository->deleteById($id);
        if (!$data)
        {
            return back()->withErrors([
                'message' => 'Blood Output cannot be deleted'
            ]);
        }
        else
        {
            return redirect()->route('blood-output.index')->with('success', 'Blood Output Deleted Successfully');
        }
    }
}
