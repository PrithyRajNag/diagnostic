<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\DoctorPercentage;
use App\Repository\DoctorPercentageRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class DoctorPercentageRepository extends BaseRepository implements DoctorPercentageRepositoryInterface
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
    public function __construct(DoctorPercentage $model)
    {
        $this->model = $model;
    }
}
