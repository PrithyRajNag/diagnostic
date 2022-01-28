<?php

namespace App\Http\Controllers\Billing\Advance;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class AdvancePaymentController extends Controller
{
    public function index()
    {
        try {
            return view('billing.advance.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        return view('billing.advance.create');
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
