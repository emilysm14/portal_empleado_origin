@extends('layouts.app')

@section('content')

<div class="container mainContainer">
    <h2 class="titulo-categoria text-center text-uppercase mb-4">
        Área: {{ $categoriaReceta->nombre }}
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

                        <select name="" id="" class="form-control">
                            <option value="xd">Mi Perfil</option>
                        </select>
                        
                        <br>
                        <a href="{{route('recetas.index')}}" class="btn btn-primary">MIS PUBLICACIONES</a>
                        <br>
                        <a href="" class="btn btn-secondary">MIS ME GUSTA</a>

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
            <div class="col-lg-6">
                <div class="row">
                    @foreach($recetas as $receta)
                    @include('ui.receta')
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row">
                <div class="card shadow">
                    <div class="card-body">
                        <hr>
                        <div class="card bg-primary text-center text-light p-4">
                            <h3>TOTAL PUBLICACIONES</h3> 
                            <h1>12</h1> 
                        </div>
                        <div class="card bg-secondary mt-3 text-center text-light p-4">
                            <h3>TOTAL DE ME GUSTA</h3>
                            <h1>4</h1> 
                        </div>

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
            </div>
        </div>
    </div>
</div>

@endsection