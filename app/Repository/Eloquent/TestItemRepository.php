<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\TestItem;
use App\Repository\TestItemRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TestItemRepository extends BaseRepository implements TestItemRepositoryInterface
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
    public function __construct(TestItem $model)
    {
        $this->model = $model;
    }
}
