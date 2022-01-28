<?php

namespace App\Http\Controllers\Billing\Admit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdmitController extends Controller
{

    public function index()
    {
        return  view('billing.admit.index');
    }


    public function create()
    {
        return  view('billing.admit.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        return view('invoice.admin.edit');
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
