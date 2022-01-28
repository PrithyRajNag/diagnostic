<?php


namespace App\Repository;

namespace App\Repository\Eloquent;
use App\Models\Role;
use App\Repository\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
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
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function roleByUuid($id)
    {
        return $this->model->where('uuid', $id)->with('permissions')->first();
    }

    public function createRole($payload)
    {
        try {
            $this->model->title = $payload['title'];
            $this->model->description = $payload['description'];
            $this->model->status = $payload['status'];
            $role=$this->model->save();
            if($role){
                $this->model->permissions()->attach($payload['permission_id']);
            }else{
                throw new \Exception('Role cannot added successfully');
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function updateRole($uuid,$payload)
    {
        try {
            $item = $this->model->where('uuid',$uuid)->first();

            $item->title = $payload['title'];
            $item->status = $payload['status'];
            $item->description = $payload['description'];
            $role = $item->save();
            if($role){
                $item->permissions()->sync($payload['permission_id']);
            }else{
                throw new \Exception('Role cannot Updated successfully');
            }
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

}
