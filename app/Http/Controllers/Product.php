<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Product extends Controller
{
    public function addproduct()
    {
        return view("admin.addproduct");
    }
}
