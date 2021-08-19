<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

use App\Services\Users\Repositories\UserRepositoryInterface;
use App\Services\Users\Requests\CreateUserRequest;
use App\Services\Users\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => $this->userRepository->getUsers()
        ]);
    }

    public function getUsers()
    {
        return $this->userRepository->getUsers();
    }

    public function createUser(CreateUserRequest $request)
    {
        $data = $request->validated();
        $this->userRepository->createUser($data);
        return Redirect::route('user');
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $data = $request->validated();
        $this->userRepository->updateUser($data);
        return redirect()->route('user');
    }

    public function deleteUser(Request $request)
    {
        $this->userRepository->deleteUser($request->id);
        return redirect()->route('user');
    }
}
