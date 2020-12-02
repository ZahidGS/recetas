@extends('layouts.app')

@section('botones')

<a href="{{route('recetas.index')}}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
    <svg class="icono" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
    Volver</a>

@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css"
    integrity="sha512-pTg+WiPDTz84G07BAHMkDjq5jbLS/AqY0rU/QdugnfeE0+zu0Kjz++0rrtYNK9gtzEZ33p+S53S2skXAZttrug=="
    crossorigin="anonymous" />
@endsection

@section('content')

<h1 class="text-center mb-5">Editar receta</h1>
<h3 class="text-center mb-5">{{$receta->titulo}}</h3>

<div class="row justify-content-center mt-5">
    <div class="col-md-8 bg-white">
        <form action="{{route('recetas.update', $receta->id)}}" enctype="multipart/form-data" method="post" novalidate>
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titulo">Título receta</label>
                <input type="text" class="form-control @error('titulo') is invalid @enderror" name="titulo" id="titulo"
                    placeholder="Título" value="{{$receta->titulo}}">

                @error('titulo')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select name="categoria" id="categoria" class="form-control 
                    @error('categoria') is-invalid @enderror">

                    <option value="">-- Seleccione --</option>

                    @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $receta->categoria_id == $categoria->id ? 'selected' : ''}}>
                        {{ $categoria->nombre }}</option>
                    @endforeach

                </select>

                @error('categoria')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="preparacion">Preparación</label>
                <input type="hidden" name="preparacion" id="preparacion" value="{{ $receta->preparacion }}" class="form-control  
                @error('preparacion') is-invalid @enderror">
                <trix-editor input="preparacion"></trix-editor>

                @error('preparacion')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="ingredientes">Ingredientes</label>
                <input type="hidden" name="ingredientes" id="ingredientes" value="{{ $receta->ingredientes}}" class="form-control 
                @error('ingredientes') is-invalid @enderror">
                <trix-editor input="ingredientes"></trix-editor>

                @error('ingredientes')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="imagen">Elige la imagen</label>
                <input type="file" class="form-control-file @error('imagen') is-invalid @enderror" id="imagen"
                    name="imagen">

                <div class="mt-4">
                    <h4>Imagen Actual:</h4>
                    <img src="/storage/{{ $receta->imagen}}" style="width: 300px" alt="">
                </div>
                @error('imagen')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Actualizar receta</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"
    integrity="sha512-EkeUJgnk4loe2w6/w2sDdVmrFAj+znkMvAZN6sje3ffEDkxTXDiPq99JpWASW+FyriFah5HqxrXKmMiZr/2iQA=="
    crossorigin="anonymous" defer></script>
@endsection