<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::with([
            'cakes'
        ])->get()->toArray();

        $categories = array_map(function ($category) {
            $cakes = $category['cakes'];
            if (count($cakes) > 0) {
                $category['image'] = url('uploads') . '/' . $cakes[0]['image'];
            } else {
                $category['image'] = null;
            }
            unset($category['cakes']);
            return $category;
        }, $data);

        return response()->json([
            'status' => true,
            'message' => 'Success get all datas!!',
            'data' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = validator($data, [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 400);
        }

        $category = Category::create($data);
        return response()->json([
            'status' => true,
            'message' => 'Create Data Successfully',
            'data' => $category
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => '$category not found',
                'data' => $category
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Get detail data successfully',
            'data' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = validator($data, [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 400);
        }

        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        $category->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Update data Successfully',
            'data' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => '$category not found',
                'data' => null
            ], 404);
        }
        $category->delete();
        return response()->json([
            'status' => true,
            'message' => 'Delete data Successfully',
            'data' => null
        ]);
    }
}