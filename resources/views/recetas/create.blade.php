@extends('layouts.app')

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('botones')

<a href="{{route('recetas.index')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
    <svg xmlns="http://www.w3.org/2000/svg" class="icono" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd" />
    </svg>
    Volver
</a>

@endsection
@section('content')
<div class="row justify-content-center" style="color: white;">
    <div class="col-lg-8">
        <div class="card p-5 bg-post" style="border-radius: 20px;">
            <div>
                <h2 class="ml-5"><img src="/images/documentIcon.png" class="createPostIcon" alt=""> Crear Publicación</h2>
                <hr width="75%" style="background: white;" />
            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <form method="POST" action="{{route('recetas.store')}}" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="titulo">Titulo de Publicacion</label>
                            <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror " id="titulo" placeholder="Titulo Publicacion" value="{{old('titulo')}}" autocomplete="off" style="width: 350px;">
                            @error('titulo')
                            <span class="invalid-feedback d-block" role="alert">
                                <!--metodo para mostrar un mensaje de tipo error-->
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="categoria">Area</label>
                            <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror">
                                <option value=""> --seleccione -- </option>
                                @foreach($categorias as $categoria )

                                <option value="{{$categoria->id}}" {{old('categoria')== $categoria->id ? 'selected': ''}}>{{$categoria->nombre}}</option>

                                @endforeach
                            </select>

                            @error('categoria')

                            <span class="invalid-feedback d-block" role="alert">
                                <!--metodo para mostrar un mensaje de tipo error-->
                                <strong>{{$message}}</strong>
                            </span>

                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="preparacion">Contenido de Publicacion</label>
                            <input type="hidden" id="preparacion" name="preparacion" value="{{old ('preparacion')}}">
                            <trix-editor class="form-control @error('preparacion') is-invalid @enderror" input="preparacion"></trix-editor>

                            @error('preparacion')

                            <span class="invalid-feedback d-block" role="alert">
                                <!--metodo para mostrar un mensaje de tipo error-->
                                <strong>{{$message}}</strong>
                            </span>

                            @enderror

                        </div>

                        <div class="form-group mt-3" style="visibility: hidden; height: 10px">
                            <label for="ingredientes">Ingredientes</label>
                            <input type="hidden" id="ingredientes" name="ingredientes" value="{{ Auth::user()->name }}" style="visibility: hidden;">
                            <trix-editor class="form-control @error('ingredientes') is-invalid @enderror" input="ingredientes" style="visibility: hidden;"></trix-editor>

                            @error('ingredientes')

                            <span class="invalid-feedback d-block" role="alert">
                                <metodo para mostrar un mensaje de tipo error>
                                    <strong>{{$message}}</strong>
                            </span>

                            @enderror

                        </div>

                        <div class="form-group mt-3" style="color: black;">
                            <label for="actual-btn" style="width: 100%;">
                                <div class="card bg-primary p-4">
                                    <div class="d-flex" style="align-items: center;">
                                        <img src="/images/adjuntar.png" alt="Adjuntar Archivo">
                                        <span class="text-light text-center"> <h3>Click para agregar un archivo</h3></span>
                                    </div>
                                </div>
                            </label>

                            <input class="form-control @error('imagen') is-invalid @enderror" type="file" id="actual-btn" class="form-control" name="imagen" hidden />

                            @error('imagen')

                            <span class="invalid-feedback d-block" role="alert">
                                <!--metodo para mostrar un mensaje de tipo error-->
                                <strong>{{$message}}</strong>
                            </span>

                            @enderror

                        </div>

                        <div class="form-group" style="color: white;">
                            <input type="submit" class="btn btn-primary" value="Agregar Publicacion">
                            <input type="reset" class="btn btn-limpiar" value="Limpiar Formulario">
                            <a href="{{route('recetas.index')}}" class="btn btn-danger">Cerrar Sesión</a>

                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

    @endsection

    @section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

    @endsection