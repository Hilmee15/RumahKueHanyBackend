<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Role::all();
        return response()->json([
            'status' => true,
            'message' => 'Success get all datas!!',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = validator($data, [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 400);
        }

        $role = Role::create($data);
        return response()->json([
            'status' => true,
            'message' => 'Create Data Successfully',
            'data' => $role
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json([
                'status' => false,
                'message' => '$role not found',
                'data' => $role
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Get detail data successfully',
            'data' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = validator($data, [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 400);
        }

        $role = Role::find($id);
        if (!$role) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        $role->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Update data Successfully',
            'data' => $role
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json([
                'status' => false,
                'message' => '$role not found',
                'data' => null
            ], 404);
        }
        $role->delete();
        return response()->json([
            'status' => true,
            'message' => 'Delete data Successfully',
            'data' => null
        ]);
    }
}
