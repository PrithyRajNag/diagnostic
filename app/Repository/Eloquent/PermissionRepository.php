<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\Permission;
use App\Repository\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
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
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

}
