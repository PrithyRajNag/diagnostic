<?php

namespace App\Repository;

namespace App\Repository\Eloquent;

use App\Models\Setting;
use App\Repository\SettingRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    public function updateSettings($payload)
    {

        $item = Setting::find(1);
        if (!$item) {
            $this->model->title = $payload->title;
            $this->model->email = $payload->email;
            $this->model->phone_number = $payload->phone_number;
            $this->model->address = $payload->address;
            $this->model->footer_text = $payload->footer_text;

            if ($payload->hasFile('logo')) {
                $logoName = "logo" . '.' . $payload->file('logo')->extension();
                $payload->file('logo')->storeAs('public/logos', $logoName, 'local');
                $this->model->logo = $logoName;
            }
            if ($payload->hasFile('favicon')) {
                $faviconName = "favicon" . '.' . $payload->file('favicon')->extension();
                $payload->file('favicon')->storeAs('public/favicons', $faviconName, 'local');
                $this->model->favicon = $faviconName;
            }

            $this->model->save();
        } else {

            if ($payload->hasFile('logo')) {
                $logo = $item->logo;
                Storage::delete('public/logos/' . $logo);
                $logoName = "logo" . '.' . $payload->file('logo')->extension();
                $payload->file('logo')->storeAs('public/logos', $logoName, 'local');
                $item->logo = $logoName;
            }

            if ($payload->hasFile('favicon')) {
                $favicon = $item->favicon;
                Storage::delete('public/favicons/' . $favicon);
                $faviconName = "favicon" . '.' . $payload->file('favicon')->extension();
                $payload->file('favicon')->storeAs('public/favicons', $faviconName, 'local');
                $item->favicon = $faviconName;
            }

            $item->title = $payload->title;
            $item->email = $payload->email;
            $item->phone_number = $payload->phone_number;
            $item->address = $payload->address;
            $item->footer_text = $payload->footer_text;

            $item->save();
        }


        return $item;

    }
}
