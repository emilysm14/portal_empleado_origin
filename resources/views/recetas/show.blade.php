@extends('layouts.app')

@section('botones')

<a href="{{route('recetas.index')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
    <svg xmlns="http://www.w3.org/2000/svg" class="icono" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd" />
    </svg>
    Volver
</a>

@endsection
@section('content')

{{--<h1>{{ $receta }}</h1> --}}

<div class="row justify-content-center">
    <div class="col-lg-6">
        <article class="contenido-receta bg-view p-5 shadow">
            <h1 class="text-center mb-4">{{$receta->titulo}}</h1>
            <hr width="75%" style="background: black;"/>
            <div class="imagen-receta" style="text-align:center">

                <img src="{{asset('storage/'.$receta->imagen)}}" class="" height="250" width="330">

            </div>

            <div class="receta-meta mt-3">
                <p>
                    <span class="font-weight-bold text-primary">Area de Publicacion:</span>
                    <a class="text-dark" href=" {{ route('categorias.show', ['categoriaReceta' => $receta->categoria->id]) }} ">{{ $receta->categoria->nombre }}
                    </a>
                </p>
                <p>
                    <span class="font-weight-bold text-primary">Autor:</span>
                    <a class="text-dark" href=" {{ route('perfiles.show', ['perfil' => $receta->autor->id]) }} ">{{$receta->autor->name}}
                    </a>
                </p>

                <p>
                    <span class="font-weight-bold text-primary">Fecha Creacion:</span>

                    @php

                    $fecha = $receta->created_at

                    @endphp

                    <fecha-receta fecha="{{$fecha}}"></fecha-receta>

                </p>

                <p>
                    <span class="font-weight-bold text-primary">Fecha Ultima Modificacion:</span>

                    @php

                    $fecha = $receta->updated_at

                    @endphp

                    <fecha-receta fecha="{{$fecha}}"></fecha-receta>

                </p>
                
                <div class="ingredientes" >
                    <h2 class="my-3 text-dark">Contenido Publicacion</h2>
                    {!!$receta->preparacion!!}
                </div>

                <div class="justify-content-center row text-">
                    <like-button receta-id="{{$receta->id}}" like="{{$like}}" likes="{{$likes}}"></like-button>
                </div>

            </div>

        </article>

    </div>
</div>
@endsection