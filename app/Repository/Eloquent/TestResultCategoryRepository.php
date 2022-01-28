<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\TestResultCategory;
use App\Repository\TestResultCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TestResultCategoryRepository extends BaseRepository implements TestResultCategoryRepositoryInterface
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
    public function __construct(TestResultCategory $model)
    {
        $this->model = $model;
    }
}
