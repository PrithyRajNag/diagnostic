<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Death;
use App\Models\Patient;
use Exception;
use Illuminate\Http\Request;

class DeathController extends Controller
{

    public function index()
    {
        try {
            return view('death.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        $patients = Patient::all();
        return view('death.create', ['patients' => $patients]);
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $death = Death::find($id);
        return view('death.info', ['death' => $death]);
    }


    public function edit($id)
    {
        $death = Death::find($id);
        $patients = Patient::all();
        return view('death.edit', ['death' => $death, 'patients' => $patients]);
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
