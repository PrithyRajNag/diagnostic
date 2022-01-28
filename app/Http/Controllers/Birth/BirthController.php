<?php

namespace App\Http\Controllers\Birth;

use App\Http\Controllers\Controller;
use App\Models\Birth;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BirthController extends Controller
{

    public function index()
    {
        try {
            return view('birth.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        return view('birth.create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $birth = Birth::find($id);
        return view('birth.info', ['birth' => $birth]);
    }


    public function edit($id)
    {
        $birth = Birth::find($id);
        return view('birth.edit', ['birth' => $birth]);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
