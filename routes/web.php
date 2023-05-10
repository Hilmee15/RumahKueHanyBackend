<?php

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

Route::get('/', function () {
    return view('layouts.master');
});
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
