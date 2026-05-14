<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('customer.category.index', compact('categories'));
    }

    public function create()
    {
        return view('customer.category.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'cat_name' => 'required|string',
            'description' => 'required|string'
        ]);

        // Jika berhasil

        Category::create($validate);

        return redirect()->route('categories.index')->with('success', 'Category : ' . $validate['cat_name'] . ', created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validate = $request->validate([
            'cat_name' => 'required|string',
            'description' => 'required|string'
        ]);

        // Jika berhasil validasi, maka update data

        $category->update($validate);

        return redirect()->route('categories.index')->with('success', 'Category : ' . $validate['cat_name'] . ', updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category : ' . $category->cat_name . ', Deleted successfully.');
    }
}
