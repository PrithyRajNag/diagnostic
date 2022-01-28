<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\Organization;
use App\Repository\OrganizationRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class OrganizationRepository extends BaseRepository implements OrganizationRepositoryInterface
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
    public function __construct(Organization $model)
    {
        $this->model = $model;
    }
}
