<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Permission::all();
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

        $permission = Permission::create($data);
        return response()->json([
            'status' => true,
            'message' => 'Create Data Successfully',
            'data' => $permission
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::find($id);
        if (!$permission) {
            return response()->json([
                'status' => false,
                'message' => '$permission not found',
                'data' => $permission
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Get detail data successfully',
            'data' => $permission
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

        $permission = Permission::find($id);
        if (!$permission) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        $permission->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Update data Successfully',
            'data' => $permission
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        if (!$permission) {
            return response()->json([
                'status' => false,
                'message' => '$permission not found',
                'data' => null
            ], 404);
        }
        $permission->delete();
        return response()->json([
            'status' => true,
            'message' => 'Delete data Successfully',
            'data' => null
        ]);
    }
}
