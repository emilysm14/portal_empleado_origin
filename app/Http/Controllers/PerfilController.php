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
    
    public function show(Perfil $perfil)
    {
        // obtener las recetas con paginacion

        $recetas = Receta::where('user_id',$perfil->user_id)->paginate(10);

        return view('perfiles.show',compact('perfil','recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {

       // Ejecutar el Policie

       $this->authorize('view', $perfil);

        return view ('perfiles.edit',compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
       
        // Ejecutar el Policie

        $this->authorize('update', $perfil);

        // Validar los datos

        $data = request()->validate([
            'nombre' => 'required',
            'url' => 'required',
            'biografia'  => 'required',

        ]);

        // Si el usuario sube una imagen

        if( $request['imagen'] ){

            //obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-perfiles','public');


            // resize de la imagen (manipular el tamaño de la imagen y agregarle efectos)

            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600 );
            $img->save();

            // Crear un arreglo de imagen

            $array_imagen = ['imagen' => $ruta_imagen ];

        }


        // Asignar nombre y url

        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        // Eliminar infomacion de $data

        unset($data['url']);
        unset($data['nombre']);

                 
        // Guardar la información

        // Asignar biografia e imagen

        auth()->user()->perfil()->update( array_merge(
            $data,
            $array_imagen ?? []

        ));


        //Redireccionar
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
