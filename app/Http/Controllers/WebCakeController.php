<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WebCakeController extends Controller
{
    public function index()
    {
        $data = Cake::all();
        return view('admin.cake.index', compact('data'));
    }

    public function viewCakes()
    {
        return view('admin.cake.index');
    }

    public function viewCreate()
    {
        $category = Category::all();
        return view('admin.cake.create', compact('category'));
    }

    public function viewEdit($id)
    {
        $cake = Cake::find($id);
        $category = Category::all();
        return view('admin.cake.edit', compact('category', 'cake'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'desc' => 'required',
                'stock' => 'required'
            ]
        );


        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi'). '.' . $file->getClientOriginalExtension();
            $file->move('uploads', $filename);
            $data['image'] = $filename;
        }

        Cake::create($data);
        return redirect()->route('cake.view');
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'desc' => 'required',
                'stock' => 'required'
            ]
        );

        $cake = Cake::findOrFail($id);

        if ($request->hasFile('image')) {
            $path = "uploads/". $cake->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $filename = date('YmdHi') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads', $filename);
            $input['image'] = $filename;
        }

        $cake->update($input);
        return redirect()->route('cake.view');
    }

    public function destroy($id)
    {
        $cake = Cake::findOrFail($id);
        $path = "uploads/". $cake->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        $cake->delete();
        return redirect()->route('cake.view')->with('success', 'Berhasil menghapus Kue');
    }
}
