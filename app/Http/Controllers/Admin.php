<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;

class Admin extends Controller
{

    public function userlist()
        {
            $users=user::all();
            return view("admin.userlist",compact("users"));
        }

    public function productlist()
        {
            $foods=food::all();
            return view("admin.productlist",compact("foods"));
        }    

    public function admin()
        {
            return view("admin.adminhome");
        }

    public function destroy($id)
        {
            $user = User::find($id);
    
            if (!$user) {
                return redirect()->back()->with('error', 'User not found.');
            }
    
            $user->delete();
    
            return redirect()->route('admin.userlist')->with('success', 'User deleted successfully.');
        } 

    // adding new food to the database
    public function storefood(Request $request)
{
    $validated = $request->validate([
        'foodname' => 'required|string|max:255',
        'description' => 'nullable|string',
        'purchase_price' => 'required|numeric',
        'sale_price' => 'required|numeric',
        'foodimage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
    ]);

    // Ukoresha validated data mu kubika
    $food = new Food();
    $food->foodname = $validated['foodname'];
    $food->description = $validated['description'];
    $food->purchase_price = $validated['purchase_price'];
    $food->sale_price = $validated['sale_price'];
    $food->admin_id = auth()->id();

    // Handling image upload if present, otherwise assign a default value
    if ($request->hasFile('foodimage')) {
        $imagePath = $request->file('foodimage')->store('foodimage', 'public');
        $food->foodimage = $imagePath;
    } else {
        return redirect()->back()->with('error', 'Please upload a valid image.');
    }

    $food->save(); 

    return redirect()->route('admin')->with('success', 'Food item created successfully');
}



  
}
