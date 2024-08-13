<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class info extends Controller
{
public function phone()
    {
       // return "09373773737";

           return response()->json(['099388383'], 200);
    }

public function location()
    {
       // return "09373773737";

           return response()->json(['UAE'], 200);
    }



       //return response()->json(Book::with('category')->get(), 200);

}