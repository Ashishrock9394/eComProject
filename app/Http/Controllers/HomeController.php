<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Product;

class HomeController extends Controller
{
    // For the homepage or product listing page
    public function index(){
        $products = Product::paginate(6); // Renaming variable to $products

        if(Auth::check()){
            $usertype = Auth::user()->user_type;
            if($usertype == "1"){
                return view('admin.home');
            } else {
                return view('user.userpage', compact('products')); // Make sure to use $products here
            }
        }

        return view('user.userpage', compact('products'));
    }

    // Redirect to admin or user page based on user type
    public function redirect(){
        $products = Product::paginate(6);; // Renaming variable to $products

        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        $usertype = Auth::user()->user_type;    
        if ($usertype == "1") {
            return view('admin.home');
        } else {
            return view('user.userpage', compact('products')); // Make sure to use $products here
        }
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
