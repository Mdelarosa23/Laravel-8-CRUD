<?php

namespace App\Services\Roles\Repositories;

use App\Services\Base\Repository;
use App\Services\Roles\Role;
use App\Services\Roles\Repositories\RoleRepositoryInterface;

class RoleRepository extends Repository implements RoleRepositoryInterface
{
    /** @var SellerRepositoryInterface */
    protected $sellerRepository;

    public function __construct(
        Role $model
    ) {
        $this->model = $model;
    }

    public function getRoles()
    {
        return $this->model->all();
    }

    public function createRole($data)
    {
        return $this->model->create($data);
    }

    public function updateRole($data)
    {
        return $this->model->where('id', $data['id'])->update($data);
    }

    public function deleteRole($id)
    {
        $role = $this->model->find($id);
        $role->delete();

        return $this->model->all();
    }
}
