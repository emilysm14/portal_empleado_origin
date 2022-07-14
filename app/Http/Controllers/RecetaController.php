<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except' => ['show', 'search']]); // aqui se protege la aplicacion a exepcion del ver recetas
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //auth()->user()->recetas->dd();
        
        //$recetas = auth()->user()->recetas;

        $usuario = auth()->user();

        //recetas con paginación

       $recetas = Receta::where('user_id',$usuario->id)->paginate(10);

        return view('recetas.index')
            ->with('recetas',$recetas)
            ->with('usuario',$usuario);


        return view('recetas.index')->with('recetas',$recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        //DB::table('categoria_receta')->get()->pluck('nombre','id')->dd();

        //obtener las categorias sin modelo

        //$categorias = DB::table('categoria_recetas')->get()->pluck('nombre','id');

        //con modelo

        $categorias = CategoriaReceta::all(['id','nombre']);  

        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd( $request['imagen']->store('upload-recetas','public'));


        //validacion
        $data = $request->validate([
            'titulo'=> 'required|min:6',            
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image',
            'categoria' => 'required',
        ]);

        //obtener la ruta de la imagen
        $ruta_imagen = $request['imagen']->store('images','public');


        // resize de la imagen (manipular el tamaño de la imagen y agregarle efectos)

        //$img = Image::make(public_path("public/images/{$ruta_imagen}"))->fit(1000,550);
        //$img->save();

        //almacenar en la bd (sin modelo)
        
       /* DB::table('recetas')-> insert([

            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $ruta_imagen,
            'user_id' => Auth::user()-> id,
            'categoria_id' => $data['categoria']

        ]);*/

        // almacenar en la bd (con modelo)

        auth()->user()->recetas()->create([

            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $ruta_imagen,   
            'categoria_id' => $data['categoria']  

        ]);

        //Redireccionar

        return redirect()->action('RecetaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {

        //  Obtener si el usuario actual le gusta la receta y esta autenticado

        $like = ( auth()->user() ) ? auth()->user()->meGusta->contains($receta->id) :false;

        // pasa la cantidad de likes a la vista

        $likes = $receta->likes->count();

        return view("recetas.show", compact('receta', 'like' ,'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //con modelo

        $this->authorize('view',$receta);

        $categorias = CategoriaReceta::all(['id','nombre']);

        return view('recetas.edit',compact('categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        // Revisar el policie

        $this->authorize('update',$receta);

         //validacion
         $data = $request->validate([
            'titulo'=> 'required|min:6',            
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'categoria' => 'required',
        ]);

        //Asignar los Valores

        $receta->titulo = $data['titulo'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->categoria_id = $data['categoria'];

        // si el usuario sube una nueva imagen

        if (request('imagen')){

             //obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('images','public');


            // resize de la imagen (manipular el tamaño de la imagen y agregarle efectos)

            //$img = Image::make(public_path("public/images/{$ruta_imagen}"))->fit(1000,550);
            //$img->save();

            //Asignamos al objeto

            $receta->imagen = $ruta_imagen;

        }

        $receta->save();

        //redireccionar

        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        
        // Ejecutar el policie

        $this->authorize('delete',$receta);

        // Eliminar la receta

        $receta->delete();

        return redirect()->action("RecetaController@index");
    }

    public function search(Request $request)
    {
        $busqueda = $request->get('buscar');
        
        $recetas = Receta::where('titulo', 'like', '%'. $busqueda . '%' )->paginate(3);
        $recetas->appends(['buscar' => $busqueda]);

        return view('busquedas.show', compact('recetas','busqueda'));
    }
}
