<?php

namespace App\Services\Users\Repositories;

use App\Services\Base\Repository;
use App\Services\Users\User;
use App\Services\Users\Repositories\UserRepositoryInterface;

class UserRepository extends Repository implements UserRepositoryInterface
{
    /** @var UserRepositoryInterface */
    protected $userRepository;

    public function __construct(
        User $model
    ) {
        $this->model = $model;
    }

    public function getUsers()
    {
        return $this->model->all();
    }

    public function createUser($data)
    {
        return $this->model->create($data);
    }

    public function updateUser($data)
    {
        return $this->model->where('id', $data['id'])->update($data);
    }

    public function deleteUser($id)
    {
        $user = $this->model->find($id);
        $user->delete();

        return $this->model->all();
    }
}
