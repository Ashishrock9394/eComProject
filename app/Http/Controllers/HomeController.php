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
        $products = Product::paginate(6);; // Renaming variable to $products
        return view('user.userpage', compact('products'));
    }

    // Redirect to admin or user page based on user type
    public function redirect(){
        $products = Product::paginate(6);; // Renaming variable to $products

        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        $usertype = Auth::user()->usertype;    
        if ($usertype == "1") {
            return view('admin.home');
        } else {
            return view('user.userpage', compact('products')); // Make sure to use $products here
        }
    } 
    
}
