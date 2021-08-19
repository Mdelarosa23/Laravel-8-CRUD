<?php

namespace App\Services\Roles\Repositories;

use App\Services\Base\RepositoryInterface;

interface RoleRepositoryInterface extends RepositoryInterface
{
    /**
     * Role Lists
     * 
     * @return mixed 
     */
    public function getRoles();

    /**
     * Role Create
     * 
     * @param $data to be create
     * @return mixed 
     */
    public function createRole($data);

    /**
     * Role Update
     * 
     * @param $data to be updated
     * @return mixed 
     */
    public function updateRole($data);

    /**
     * Role Delete
     * 
     * @param $id to be deleted
     * @return mixed 
     */
    public function deleteRole($id);
}
