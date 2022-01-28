<?php

namespace App\Http\Controllers\Blood;

use App\Http\Controllers\Controller;
use App\Http\Requests\BloodInputRequest;
use App\Models\BloodInput;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BloodInputController extends Controller
{

    public function index(BloodInputRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = BloodInput::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('blood-input.edit', $row->id) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('blood-input.destroy', $row->id) . '" name="delBtn"
                                                                    class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('blood.input.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        return view('blood.input.create');
    }


    public function store(BloodInputRequest $request)
    {


    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = BloodInput::find($id);
        return view('blood.input.edit', ['data' => $data]);
    }


    public function update(BloodInputRequest $request, $id)
    {
        try {
            $data = $request->all();
            $this->repository->update($id,$data);
            return redirect()->route('blood-input.index')->with('success', 'Blood Input Updated Successfully');
        }
        catch (Exception $exception)
        {
            return redirect()->route('blood-input.index')->withErrors(['error'=> $exception->getMessage()]);
        }
    }


    public function destroy($id)
    {
        $data = $this->repository->deleteById($id);
        if (!$data)
        {
            return back()->withErrors([
                'message' => 'Blood Input cannot be deleted'
            ]);
        }
        else
        {
            return redirect()->route('blood-input.index')->with('success', 'Blood Input Deleted Successfully');
        }
    }
}
