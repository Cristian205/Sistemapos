<?php

namespace App\Http\Controllers;

use App\Models\CategoriaNegocio;
use Illuminate\Http\Request;

class CategoriaNegocioController extends Controller
{
    //
     public function index()
    {
        return CategoriaNegocio::select('id', 'nombre')
            ->orderBy('nombre')
            ->get();
    }
}
