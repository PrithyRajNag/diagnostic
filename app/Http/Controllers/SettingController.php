<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Repository\SettingRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $repository;
    public function __construct(SettingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function create()
    {
        $settings = Setting::find(1);
        return view('setting.edit', ['settings' => $settings]);
    }

    public function store(SettingRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated) {
                $this->repository->updateSettings($request);
                return redirect()->route('setting.create')->with('success', 'Settings Updated Successfully');
            }
        } catch (\Exception $exception) {
            return redirect()->route('setting.create')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

}
