<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\BedList;
use App\Repository\BedListRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BedListRepository extends BaseRepository implements BedListRepositoryInterface
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
    public function __construct(BedList $model)
    {
        $this->model = $model;
    }
}
