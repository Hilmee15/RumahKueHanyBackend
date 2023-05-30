<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\Category;
use Illuminate\Http\Request;

class WebCategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return view('admin.category.index', compact('data'));
    }

    public function viewCategories()
    {
        return view('admin.category.index');
    }

    public function viewCreate()
    {
        return view('admin.category.create');
    }

    public function viewEdit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate(
            [
                'name' => 'required'
            ]
        );

        Category::create($data);
        return redirect()->route('category.view');
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $request->validate(
            [
                'name' => 'required'
            ]
        );

        $category = Category::findOrFail($id);

        $category->update($input);
        return redirect()->route('category.view');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.view')->with('success', 'Berhasil menghapus Kategori');
    }
}
