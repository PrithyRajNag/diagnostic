<?php

namespace App\Http\Controllers\Billing\Bill;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class BillController extends Controller
{

    public function index()
    {
        try {
            return view('billing.bil.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function create()
    {
        return view('billing.bill.create');
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
