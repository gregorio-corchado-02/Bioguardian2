<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function create()
    {
        return view('crearPublicacion'); // Asegúrate de que 'crearPublicacion' es el nombre de tu vista
    }

}
