<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanesController extends Controller
{
    public function index(){
        return Plan::where('activo', true)->get();
    }


}
