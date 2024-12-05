<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    public function index(){
        $objGender= Gender::all();
        return response()->json($objGender);
    }
}
