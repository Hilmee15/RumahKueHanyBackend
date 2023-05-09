<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use Illuminate\Http\Request;

class CakeController extends Controller
{

    public function __construct()
    {
       $this->middleware(['permission:create-cake', 'auth:sanctum'])->only('store');
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = validator($data, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
            'desc' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 400);
        }
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['image'] = $filename;
        }



        $cake = Cake::create($data);

        $responseData = [
            ''
        ];
        return response()->json([
            'status' => true,
            'message' => 'Create data Successfully',
            'data' => $cake
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
