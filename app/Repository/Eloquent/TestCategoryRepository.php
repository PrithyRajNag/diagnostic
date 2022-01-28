<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\TestCategory;
use App\Repository\TestCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TestCategoryRepository extends BaseRepository implements TestCategoryRepositoryInterface
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
    public function __construct(TestCategory $model)
    {
        $this->model = $model;
    }
}
