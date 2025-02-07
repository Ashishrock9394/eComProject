<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    //

    public function showCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cart = Cart::where('user_id', Auth::id())->get(); // Get cart items for the logged-in user

        return view('user.cart', compact('cart'));
    }


    public function addToCart(Request $request, $id) {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        $user = Auth::user();
        $product = Product::find($id);
    
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }
    
        // Check if the product already exists in the cart
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $product->id)
                        ->first();
    
        if ($cartItem) {
            // If product exists, increment the quantity
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // If product doesn't exist, create a new cart entry
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->product_id = $product->id;
            $cart->product_title = $product->title;
            $cart->product_image = $product->image;
            $cart->product_price = $product->price;
            $cart->quantity = 1;  
            $cart->save();
        }
    
        return redirect()->back()->with('success', 'Product added to cart!');
    }
    

    public function updateCart(Request $request, $id) {
        $cartItem = Cart::find($id);
        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }
        return response()->json(['message' => 'Cart updated successfully']);
    }

    public function removeFromCart($id) {
        Cart::destroy($id);
        return response()->json(['message' => 'Item removed successfully']);
    }
    


}
