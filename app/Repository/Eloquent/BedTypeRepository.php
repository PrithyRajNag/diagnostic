<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\BedType;
use App\Repository\BedTypeRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BedTypeRepository extends BaseRepository implements BedTypeRepositoryInterface
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
    public function __construct(BedType $model)
    {
        $this->model = $model;
    }
}
