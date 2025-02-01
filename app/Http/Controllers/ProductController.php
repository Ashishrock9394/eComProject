<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
   
    public function viewProduct(){

        $products = Product::all();
        return view('admin.product',compact('products'));
    }

    public function addProductpage(){

        $categories = Category::all(); // Fetch categories from the database
        return view('admin.addProduct', compact('categories'));
    }

    public function addProduct(Request $request){

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'category_name' => 'required|exists:categories,category_name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity;
        $product->category = $request->category_name;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product added successfully!');

    }


    // delete product

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Delete the image file if it exists
        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }

    // update product 

    public function editProduct($id)
    {
        $product = Product::find($id);
        $categories = Category::all(); // Fetch all categories

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        
        return view('admin.editProduct', compact('product', 'categories'));
    }



    public function updateProduct(Request $request, $id){

        
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'category_name' => 'required|exists:categories,category_name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity;
        $product->category = $request->category_name;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                \Storage::disk('public')->delete($product->image);
            }
            // Store new image
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
         }

        $product->save();

        return redirect()->route('view_product')->with('success', 'Product uodated successfully!');

    }


    public function showProduct($id) {
        $product = Product::with('category')->find($id);

        // If the product doesn't exist, show an error or redirect
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Pass the product to the view
        return view('user.productDetails', compact('product'));
    }
    

}
