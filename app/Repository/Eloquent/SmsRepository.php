<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\Sms;
use App\Repository\SmsRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SmsRepository extends BaseRepository implements SmsRepositoryInterface
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
    public function __construct(Sms $model)
    {
        $this->model = $model;
    }
}
