<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\Lab;
use App\Repository\LabRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class LabRepository extends BaseRepository implements LabRepositoryInterface
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
    public function __construct(Lab $model)
    {
        $this->model = $model;
    }
}
