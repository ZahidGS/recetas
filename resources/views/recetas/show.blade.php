@extends('layouts.app')

@section('botones')

<a href="{{route('recetas.index')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
    <svg class="icono" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
    Volver</a>

@endsection

@section('content')

<article class="contenido-receta bg-white p-5 shadow">
    <h1 class="text-center mb-4">{{$receta->titulo}}</h1>

    <div class="imagen-receta">
        <img src="/storage/{{ $receta->imagen }}" class="w-100" alt="">
    </div>

    <div class="receta-meta mt-2">
        <p>
            <span class="font-weight-bold text-primary">Escrito en:</span>
            <a href="{{ route('categorias.show', $receta->categoria->id) }}">{{$receta->categoria->nombre}}</a>
        </p>
        <p>
            <span class="font-weight-bold text-primary">Autor:</span>
            <a href="{{ route('perfiles.show', $receta->autor->id) }}">
                {{$receta->autor->name}}</a>
        </p>
        <p>
            <h4 class="font-weight-bold text-primary">Fecha:</h4>
            @php
                $fecha = $receta->created_at
            @endphp
            <fecha-receta fecha="{{$fecha}}"></fecha-receta>
        </p>
    </div>
    <div class="ingredientes">
        <h2 class="my-3 text-primary">Ingredientes:</h2>
        {!! $receta->ingredientes !!}
    </div>
    <div class="preparacion">
        <h2 class="my-3 text-primary">Preparación:</h2>
        {!! $receta->preparacion !!}
    </div>

    <div class="justify-content-center row text-center">
        
            <like-button
                receta-id="{{$receta->id}}"
                like="{{$like}}"
                likes="{{$likes}}"
            ></like-button>

    </div>
</article>
    
@endsection