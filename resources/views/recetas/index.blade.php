@extends('layouts.app')


@section('botones')

@include('ui.navegacion')

{{-- {{Auth::User()}} este helper trae la info del usuario que esta autenticado--}}

@endsection

@section('content')
<h2 class="titulo-categoria text-center text-uppercase mb-4">
    MIS PUBLICACIONES
</h2>
<div class="d-flex justify-content-around">
    <div class="row">
        <div class="col-lg-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid" src="/images/userimg.png" alt="no hay">
                    </div>
                    <hr>
                    <h3 class="card-title text-center p-3">{{ Auth::user()->name }}</h3>

                    <br>
                    <a href="{{route('perfiles.edit', ['perfil' => Auth::user()->id])}}" class="btn btn-primary mr-2 text-uppercase font-weight-bold ">
                        <svg class="icono" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Editar Perfil
                    </a>

                    <div>

                    </div>

                    <div class="meta-receta d-flex justify-content-between">
                        <p class="text-primary fecha font-weight-bold">

                        </p>
                        <p></p>
                    </div>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                    <div class="row mx-auto bg-white p-4">

                        @if(count($recetas) > 0)

                        @foreach($recetas as $receta)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="/storage/{{$receta->imagen}}" class="card-img-top" alt="imagen receta">
                                <div class="card-body">
                                    <h3>{{$receta->titulo}}</h3>
                                    <a href="{{route('recetas.show',['receta' => $receta->id])}}" class="btn btn-primary d-block mt-2 text-uppercase font-weight-bold ">Ver Publicación</a>
                                    <a href="{{route('recetas.edit',['receta' => $receta->id])}}" class="btn btn-secondary d-block mt-2 text-uppercase mb-2 font-weight-bold">Editar Publicación</a>
                                </div>
                            </div>
                        </div>

                        @endforeach

                        @else

                        <p class="text-center w-100">No hay recetas creadas aún..</p>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<h2 class="text-center my-5">Recetas que te gustan</h2>
<div class="col-md-10 mx-auto bg-white p-3">
    @if(count( $usuario->meGusta ) > 0)
    <ul class="list-group">
        @foreach($usuario->meGusta as $receta)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <p>{{$receta->titulo}}</p>
            <a class="btn btn-outline-success text-uppercase font-weight-bold" href="{{route('recetas.show',['receta'=> $receta->id])}}">Ver</a>
        </li>
        @endforeach
    </ul>
    @else
    <p class="text-center">Aun no tienes recetas Guardadas <small>Dale me gusta a las recetas y aparecerán aquí</small></p>
    @endif
</div>-->
</div>



@endsection