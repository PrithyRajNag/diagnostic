<?php

namespace App\Http\Controllers\Blood;

use App\Http\Controllers\Controller;
use App\Http\Requests\BloodDonorRequest;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BloodDonorController extends Controller
{
    public function index(BloodDonorRequest $request)
    {
        try {
            return view('blood.donor.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function create()
    {
        return view('blood.donor.create');
    }

}
