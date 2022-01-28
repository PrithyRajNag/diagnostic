<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\TestResultUnit;
use App\Repository\TestResultUnitRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TestResultUnitRepository extends BaseRepository implements TestResultUnitRepositoryInterface
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
    public function __construct(TestResultUnit $model)
    {
        $this->model = $model;
    }
}
