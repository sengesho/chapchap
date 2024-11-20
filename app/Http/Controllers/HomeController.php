<?php

namespace App\Http\Controllers;

use Illuminate\http\request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Food;

class HomeController extends Controller
{
    public function first()
    {
    
        return view("index");
    }
    
    public function index()
    {
        $foods=food::all();
        return view("home",compact("foods"));
    }
    public function redirect()
    {
        $usertype= Auth ::user()->usertype;

        if($usertype=='1')
        {
            return view('admin.adminhome');
        }
        else{
            $foods=Food::all();
        return view("home",compact("foods"));
        }
    }
}
