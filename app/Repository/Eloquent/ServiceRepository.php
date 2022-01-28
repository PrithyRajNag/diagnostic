<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\Service;
use App\Repository\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
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
    public function __construct(Service $model)
    {
        $this->model = $model;
    }
}
