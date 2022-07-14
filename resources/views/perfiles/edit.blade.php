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

{{--{{$perfil}} --}}

<div class="row justify-content-center" style="color: white;">
    <div class="col-lg-8">
        <div class="card p-5 bg-post" style="border-radius: 20px;">
            <div>
                <h1 class="text-center"><img src="/images/edition.png" class="createEditionIcon" alt="">Editar Mi Perfil</h1>
                <hr width="75%" style="background: white;"/>
            </div>
                <div class="row justify-content-center mt-5">
                    <div class="col-md-8">
                        <form action="{{ route('perfiles.update',['perfil'=>$perfil->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror " id="nombre" placeholder="Tu Nombre" value="{{ $perfil->usuario->name }}" autocomplete="off" readOnly>
                                @error('nombre')
                                <span class="invalid-feedback d-block" role="alert">
                                    <!--metodo para mostrar un mensaje de tipo error-->
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="url">Apellidoss</label>
                                <input type="text" name="url" class="form-control @error('url') is-invalid @enderror " id="url" placeholder="Apellidos" value="{{ $perfil->usuario->url }}" autocomplete="off" readOnly>
                                @error('url')
                                <span class="invalid-feedback d-block" role="alert">
                                    <!--metodo para mostrar un mensaje de tipo error-->
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            

                            <div class="form-group mt-3">
                                <label for="biografia">Biografia</label>
                                <input type="hidden" id="biografia" name="biografia" value="{{$perfil->biografia}}">
                                <trix-editor class="form-control @error('biografia') is-invalid @enderror" input="biografia"></trix-editor>

                                @error('biografia')

                                <span class="invalid-feedback d-block" role="alert">
                                    <!--metodo para mostrar un mensaje de tipo error-->
                                    <strong>{{$message}}</strong>
                                </span>

                                @enderror
                            </div>

                            <div class="form-group mt-3" style="color: black;">
                                <label for="imagen">Tu Imagen</label>

                                <input class="form-control @error('imagen') is-invalid @enderror" type="file" id="imagen" class="form-control" name="imagen">

                                @if( $perfil->imagen)

                                <div class="mt-4">
                                    <p>Imagen Actual:</p>
                                    <img src="/storage/{{$perfil->imagen}}" style="width: 300px">

                                </div>

                                @error('imagen')

                                <span class="invalid-feedback d-block" role="alert">
                                    <!--metodo para mostrar un mensaje de tipo error-->
                                    <strong>{{$message}}</strong>
                                </span>

                                @enderror
                                @endif

                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Actualizar Perfil">
                                <input type="submit" class="btn btn-danger" value="Cancelar">

                            </div>

                        </form>

    </div>
</div>


@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

@endsection
