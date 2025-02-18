<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // Use the correct namespace for the model
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class AdminController extends Controller
{
    // Show category page
    public function getCategory()
    {
        $data= Category::all();
        return view('admin.category',compact('data'));
    }

    // Add new category
    public function addCategory(Request $request)
    {
        // Validate input
        $request->validate([
            'category' => 'required|string|max:255'
        ]);

        // Create a new category
        $data = new Category;
        $data->category_name = $request->category; // Ensure correct field name
        $data->save();

        return redirect()->back()->with('success', 'Category added successfully!');
    }

    function deleteCategory($id){

        $data=Category::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
    
    
    function editCategory($id){

        $category = Category::findOrFail($id);
        return view('admin.editCategory', compact('category'));
    }


    function updateCategory(Request $request, $id){

        $data = Category::findOrFail($id);
        $data->category_name = $request->category_name;
        $data->save();
        return redirect()->route('admin.category')->with('success', 'Category updated successfully!');
    }




    // for orders 

    public function showOrder()
    {   
        // Eager loading user and product details

        $orders = Order::with(['user', 'orderItems.product'])->get(); 

        return view('admin.showOrder', compact('orders'));
    }

    // update delivery status

    public function updateDeliveryStatus(Request $request, $orderId)
{
    // Validate the input for delivery status
    $request->validate([
        'delivery_status' => 'required|string|in:Pending,Shipped,Delivered,Cancelled', // Acceptable statuses
    ]);

    // Find the order by ID and update its delivery status
    $order = Order::findOrFail($orderId);
    $order->order_status = $request->delivery_status;
    $order->save();

    return redirect()->back()->with('success', 'Delivery status updated successfully!');
}


}
