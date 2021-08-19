<?php

namespace App\Services\Users\Repositories;

use App\Services\Base\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * User Lists
     * 
     * @return mixed 
     */
    public function getUsers();

    /**
     * User Create
     * 
     * @param $data to be create
     * @return mixed 
     */
    public function createUser($data);

    /**
     * User Update
     * 
     * @param $data to be updated
     * @return mixed 
     */
    public function updateUser($data);

    /**
     * User Delete
     * 
     * @param $id to be deleted
     * @return mixed 
     */
    public function deleteUser($id);
}
