<?php

namespace App\Http\Controllers;

use App\Http\Requests\SmsRequest;
use Exception;
use Illuminate\Http\Request;

class SmsController extends Controller
{

    public function index(SmsRequest $request)
    {
        try {
            return view('sms.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function create()
    {
        return view('sms.create');
    }

    public function store(SmsRequest $request)
    {
        try {
            $validated = $request->validated();
            $data = $request->all();
            if ($validated) {
                $this->repository->create($data);
                return redirect()->route('sms.index')->with('success', 'Sms Send Successfully');
            }
        } catch (\Exception $e) {
            return redirect()->route('sms.index')->withErrors(['errors' => $e->getMessage()]);
        }
    }
}
