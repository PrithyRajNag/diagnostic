<?php

namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\TestReportTemplate;
use App\Repository\TestReportTemplateRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TestReportTemplateRepository extends BaseRepository implements TestReportTemplateRepositoryInterface
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
    public function __construct(TestReportTemplate $model)
    {
        $this->model = $model;
    }
}
