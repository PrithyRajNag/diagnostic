<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\HumanResource;
use App\Repository\HumanResourceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class HumanResourceRepository extends BaseRepository implements HumanResourceRepositoryInterface
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
    public function __construct(HumanResource $model)
    {
        $this->model = $model;
    }
}
