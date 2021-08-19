<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Services\Roles\Repositories\RoleRepositoryInterface;
use App\Services\Roles\Requests\CreateRoleRequest;
use App\Services\Roles\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(
        RoleRepositoryInterface $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }


    public function index()
    {
        return Inertia::render('Roles/Index', [
            'roles' => $this->roleRepository->getRoles()
        ]);
    }

    public function getRoles()
    {
        return $this->roleRepository->getRoles();
    }

    public function createRole(CreateRoleRequest $request)
    {
        $data = $request->validated();
        $this->roleRepository->createRole($data);
        return Redirect::route('role');
    }

    public function updateRole(UpdateRoleRequest $request)
    {
        $data = $request->validated();
        $this->roleRepository->updateRole($data);
        return redirect()->route('role');
    }

    public function deleteRole(Request $request)
    {
        $this->roleRepository->deleteRole($request->id);
        return redirect()->route('role');
    }
}
