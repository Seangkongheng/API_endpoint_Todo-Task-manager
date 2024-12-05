<?php

namespace App\Http\Controllers;

use App\Models\Position\Positon;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(){
        $objPosition= Positon::all();
        return response()->json($objPosition);
    }
}
