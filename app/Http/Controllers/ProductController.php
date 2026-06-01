<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->sortBy('name');
        return view('customer.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('cat_name', 'asc')->get();
        return view('customer.product.create', compact('categories'));
    }

     public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'img' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required|boolean'
        ],
        [
            'name.required' => 'The Item Name is required',
            'description.string' => 'The Description must be a String',
            'cost_price.required' => 'The Price is required',
            'selling_price.required' => 'The Price is required',
            'stock.required' => 'The Stoct is required',
            'category_id.required' => 'The Category is required',
            'img.image' => 'The Image must be an image file',
            'img.max' => 'The Image size must not exceed 2MB',
            'is_active.required' => 'The Active Status is required',
            'is_active.boolean' => 'The Active Status must be true or false.'
        ]);

        // Handle Image
        if ($request->hasFile('img'))
            {
                $image = $request->file('img');
                $imageNames = time().'.'. $image->getClientOriginalExtension();
                $image->move(public_path('img_product_upload'), $imageNames);
                $validate['img'] = $imageNames;
            }

        // Jika berhasil

        Product::create($validate);

        // Jika klik Save & Add New
        if ($request->action === 'save_and_new') {
            return redirect()
                ->route('products.create')
                ->with(
                    'success',
                    'Product : ' . $validate['name'] . ' created successfully.'
                );
        }

        // Jika klik Save
        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Product : ' . $validate['name'] . ' created successfully.'
            );
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('cat_name', 'asc')->get();
        return view('customer.product.edit', compact('product','categories'));

    }

    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'img' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'required|boolean'
        ],
        [
            'name.required' => 'The Item Name is required',
            'description.string' => 'The Description must be a String',
            'cost_price.required' => 'The Price is required',
            'selling_price.required' => 'The Price is required',
            'stock.required' => 'The Stoct is required',
            'category_id.required' => 'The Category is required',
            'img.image' => 'The Image must be an image file',
            'img.max' => 'The Image size must not exceed 2MB',
            'is_active.required' => 'The Active Status is required',
            'is_active.boolean' => 'The Active Status must be true or false.'
        ]);

       // Handle Image
        if ($request->hasFile('img'))
            {
                $image = $request->file('img');
                $imageNames = time().'.'. $image->getClientOriginalExtension();
                $image->move(public_path('img_product_upload'), $imageNames);
                $validate['img'] = $imageNames;
            }

        // Jika berhasil
        $product = Product::findOrFail($id);
        $product->update($validate);

        return redirect()->route('products.index')->with('success', 'Product : ' . $validate['name'] . ', Update successfully.');
    }

    public function markAsActive(int $id)
    {
        $product = Product::find($id);
        $product->update(['is_active' => 1]);

        return redirect()->route('products.index')->with('success', 'Product ' . $product->name . ' marked as active successfully.');
    }

    public function markAsNonactive(int $id)
    {
        $product = Product::find($id);
        $product->update(['is_active' => 0]);

        return redirect()->route('products.index')->with('success', 'Product ' . $product->name . ' marked as non active successfully.');
    }

    public function show(Product $product)
    {
        return view('customer.product.show', compact('product'));
    }

}
