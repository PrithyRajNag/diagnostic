<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class OperationReportController extends Controller
{

    public function index()
    {
        try {
            return view('operationReport.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function create()
    {
        return view('operationReport.create');
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
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
