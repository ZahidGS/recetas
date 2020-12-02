<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        $usuario = auth()->user();
        $recetas = Receta::where('user_id',$usuario->id)->paginate(6);

        return view('perfiles.show', compact('perfil','recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //ejecutar la policy, se le pasa el metodo a autorizar y el 
        //objeto a revisar
        $this->authorize('view',$perfil);


        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $perfil = Perfil::find($id);
        //ejecutar la policy, se le pasa el metodo a autorizar y el 
        //objeto a revisar
        //return $perfil;

        $this->authorize('update',$perfil);

        //validation del formulario
        $data = request()->validate([
            'nombre' => 'required',
            'url' => 'required',
            'biografia' => 'required',

        ]);
        
        //si el usuario sube una imagen
        //si request tiene una imagen entonces...
        if (request('imagen')) {
            //obtener ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

            //resize de la imagen despues de haberla guardado en storage
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();

            //crear array de imagen
            $array_imagen = ['imagen' => $ruta_imagen];
        }

        //asignar nombre y url
        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        //Eliminar url y name de $data para que no cometa error de datos
        unset($data['url']);
        unset($data['nombre']);

        //guardar
        //asignar biografia e imagen, usando el array_merge
        //si array_imagen viene vacio, se crea el array vacio
        auth()->user()->perfil()->update( array_merge(
            $data,
            $array_imagen ?? [],
        ));


        //redireccionar
        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
