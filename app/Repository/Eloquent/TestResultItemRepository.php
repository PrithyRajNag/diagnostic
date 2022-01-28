<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\TestResultItem;
use App\Repository\TestResultItemRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TestResultItemRepository extends BaseRepository implements TestResultItemRepositoryInterface
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
    public function __construct(TestResultItem $model)
    {
        $this->model = $model;
    }
}
