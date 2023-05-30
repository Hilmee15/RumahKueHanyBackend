<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CakeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\WebCakeController;
use App\Http\Controllers\WebCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth Routes
Route::get('/', function () {
    return redirect()->route('login.view');
})->middleware('guest'); // Navigation into the login page
Route::get('/login', [WebAuthController::class, 'viewLogin'])->name('login.view')->middleware('guest'); // Navigation into the login page
Route::post('/login', [WebAuthController::class, 'login'])->name('login.post'); // Login
Route::post('/register', [AuthController::class, 'register'])->name('register.post'); // Register
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth'); // Logout

// Pages Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // Dashboard
Route::get('/category', [WebCategoryController::class, 'index'])->name('category'); // Roles

// Cakes Routes
Route::get('/cake', [WebCakeController::class, 'index'])->name('cake.view'); // Cake View
Route::get('/cake/create', [WebCakeController::class, 'viewCreate'])->name('cake.create'); // Create Cake
Route::post('/cake/create', [WebCakeController::class, 'store'])->name('cake.store'); // Create Cake
Route::get('/cake/edit/{id}', [WebCakeController::class, 'viewEdit'])->name('cake.edit'); // Edit Cake
Route::post('/cake/{id}', [WebCakeController::class, 'update'])->name('cake.update'); // Update Cake
Route::get('/cake/delete/{id}', [WebCakeController::class, 'destroy'])->name('cake.delete'); // Delete Cake

// Category Routes
Route::get('/category', [WebCategoryController::class, 'index'])->name('category.view'); // Category View
Route::get('/category/create', [WebCategoryController::class, 'viewCreate'])->name('category.create'); // Create Category
Route::post('/category/create', [WebCategoryController::class, 'store'])->name('category.store'); // Create Category
Route::get('/category/edit/{id}', [WebCategoryController::class, 'viewEdit'])->name('category.edit'); // Edit Category
Route::post('/category/{id}', [WebCategoryController::class, 'update'])->name('category.update'); // Update Category
Route::get('/category/delete/{id}', [WebCategoryController::class, 'destroy'])->name('category.delete'); // Delete Category


// Test Route
Route::get('test', function(Request $request){
    $permissions = [
        'create-role',
        'read-role',
        'update-role',
        'delete-role',
        'create-permission',
        'read-permission',
        'update-permission',
        'delete-permission',
        'create-category',
        'read-category',
        'update-category',
        'delete-category',
        'create-cake',
        'read-cake',
        'update-cake',
        'delete-cake'
    ];
    $role = Role::where('name', '=', 'admin')->first();
    $role->syncPermissions($permissions);
    echo 'sukses';
});
