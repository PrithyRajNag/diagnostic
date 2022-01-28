<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\Ambulance;
use App\Repository\AmbulanceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class AmbulanceRepository extends BaseRepository implements AmbulanceRepositoryInterface
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
    public function __construct(Ambulance $model)
    {
        $this->model = $model;
    }


}
