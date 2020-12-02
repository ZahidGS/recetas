<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index(){

        //mostrar las recetas con mas votos, forma estatica
        //$votadas = Receta::has('likes','>',0)->get();

        //cuenta los likes y genera una columna temporal que representa lo contado, forma dinamica
        $votadas = Receta::withCount('likes')->orderBy('likes_count','desc')->take(3)->get();

        //return $votadas;

        //obtener kas recetas mas nuevas
        $nuevas = Receta::latest()->take(5)->get();

        //categorias
        $categorias = CategoriaReceta::all();

        //recetas pr categoria
        $recetas = [];

        foreach ($categorias as $categoria) {
            $recetas[ Str::slug( $categoria->nombre )][] = Receta::where('categoria_id',$categoria->id)->take(3)->get();
        }
        

        return view('inicio.index', compact('nuevas','recetas','votadas'));
    }
}
