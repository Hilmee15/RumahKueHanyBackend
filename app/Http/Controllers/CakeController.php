<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class CakeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:admin', 'auth:sanctum'])->only('store');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cake::all();
        return response()->json([
            'status' => true,
            'message' => 'Get all cake datas Successfully',
            'data' => $data
        ]);
    }

    public function getCakeByCategoryId($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'category not found',
                'data' => null
            ], 404);
        }

        $products = $category->cakes->map(function ($cake) {
            $cake->image = url('uploads') .'/' . $cake->image;
            return $cake;
        });
        return response()->json(
            [
                'status' => true,
                'message' => 'products',
                'data' => $products
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = validator($data, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'desc' => 'required',
            'stock' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 400);
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = now() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/'), $filename);
            $data['image'] = $filename;
        }
return dd($data);




        // $cake = Cake::create($data);
        return response()->json([
            'status' => true,
            'message' => 'Create data Successfully',
            // 'data' => $cake
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cake = Cake::find($id);
        if (!$cake) {
            return response()->json([
                'status' => false,
                'message' => '$cake not found',
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'Get $cake details Successfully',
            'data' => $cake
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'stock' => 'required'
        ], [
                'stock.required' => 'Stok wajib diperbarui!!'
            ]);
        if ($validator->passes()) {
            Role::findById($id)->update($request->all());

            return response()->json(['message' => 'Data berhasil diupdate!!']);
        }

        $cake = Cake::find($id);
        if (!$cake) {
            return response()->json([
                'status' => false,
                'message' => 'Cake not Found',
                'data' => null
            ], 404);
        }

        $cake->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Update Cake Successfully',
            'data' => $cake
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cake = Cake::find($id);
        if (!$cake) {
            return response()->json([
                'status' => false,
                'message' => '$cake not found',
                'data' => null
            ]);
        }
        $cake->delete();
        return response()->json([
            'status' => true,
            'message' => 'Delete $cake Successfully',
            'data' => $cake
        ]);
    }
}
