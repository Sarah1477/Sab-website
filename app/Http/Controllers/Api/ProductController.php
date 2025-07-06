<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    // GET /api/products
    public function index()
    {
        $products = Product::with('category')->get();

        return response()->json($products);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

// CREATE product
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the product
        $product = Product::create($request->only('name', 'description', 'price', 'stock', 'category_id'));

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }

// UPDATE product
    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update basic product info
        $product->update($request->only('name', 'description', 'price', 'stock', 'category_id'));

        // Handle new images (optional)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        return redirect('/products/' . $id . '/edit')->with('success', 'Product updated successfully!');
    }

    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);

        // Delete the image file from storage
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete(); // Remove DB record

        return back()->with('success', 'Image deleted successfully.');
    }


    public function destroy($id)
    {
        $product = Product::with('images')->findOrFail($id);

        // Delete all related images from storage and DB
        foreach ($product->images as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $image->delete();
        }

        // Delete the product itself
        $product->delete();

        return redirect('/products/create')->with('success', 'Product deleted successfully.');
    }



}
