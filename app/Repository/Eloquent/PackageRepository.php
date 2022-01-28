<?php

namespace App\Repository;

namespace App\Repository\Eloquent;

use App\Models\Package;
use App\Repository\PackageRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PackageRepository extends BaseRepository implements PackageRepositoryInterface
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
    public function __construct(Package $model)
    {
        $this->model = $model;
    }

    public function packageById($id)
    {
        return $this->model->where('uuid', $id)->with('services')->first();
    }

    public function createPackage($payload)
    {

        try {
            $this->model->package_name = $payload->package_name;
            $this->model->discount = $payload->discount;
            $this->model->status = $payload->status;
            $this->model->description = $payload->description;
            $this->model->amount = $payload->amount;
            $package=$this->model->save();
            if($package){
                $this->model->services()->attach($payload->service_id);
            }else{
                throw new \Exception('Package cannot added successfully');
            }
        }catch (\Exception $e){
             return $e->getMessage();
        }

    }

    public function updatePackage($uuid, $payload)
    {
        try {
            $item = $this->model->where('uuid',$uuid)->first();

            $item->package_name = $payload['package_name'];
            $item->discount = $payload['discount'];
            $item->status = $payload['status'];
            $item->description = $payload['description'];
            $item->amount = $payload['amount'];
            $package = $item->save();
            if($package){
                $item->services()->sync($payload['service_id']);
            }else{
                throw new \Exception('Package cannot Updated successfully');
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }




}
