<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class CaseStudyController extends Controller
{

    public function index()
    {
        try {
            return view('patient.caseStudy.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        return view('patient.caseStudy.create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('patient.caseStudy.info');
    }

    public function edit($id)
    {
        return view('patient.caseStudy.edit');
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
