<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::middleware(['auth:sanctum', 'verified'])->group(
    function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');


        Route::prefix('role')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('role');
            Route::get('/getRoles', [RoleController::class, 'getRoles'])->name('role.getRoles');
            Route::post('/createRole', [RoleController::class, 'createRole'])->name('role.createRole');
            Route::post('/updateRole', [RoleController::class, 'updateRole'])->name('role.updateRole');
            Route::post('/deleteRole', [RoleController::class, 'deleteRole'])->name('role.deleteRole');
        });

        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('user');
            Route::get('/getRoles', [UserController::class, 'getUsers'])->name('user.getUsers');
            Route::post('/createUser', [UserController::class, 'createUser'])->name('user.createUser');
            Route::post('/updateUser', [UserController::class, 'updateUser'])->name('user.updateUser');
            Route::post('/deleteUser', [UserController::class, 'deleteUser'])->name('user.deleteUser');
        });
    }
);
