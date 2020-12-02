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

<h1 class="text-center mb-5">Editar perfil</h1>
<h3 class="text-center mb-5">{{$perfil->usuario->name}}</h3>

<div class="row justify-content-center mt-5">
    <div class="col-md-10 bg-white p-3">
        <form action="{{route('perfiles.update',$perfil->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control @error('nombre') is invalid @enderror" name="nombre" id="nombre"
                    placeholder="Nombre" value="{{$perfil->usuario->name}}">

                @error('nombre')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="url">Sitio Web</label>
                <input type="text" class="form-control @error('url') is invalid @enderror" name="url" id="url"
                    placeholder="Tu sitio web" value="{{$perfil->usuario->url}}">

                @error('url')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="biografia">Biografía</label>
                <input type="hidden" 
                name="biografia" 
                id="biografia" 
                value="{{ $perfil->biografia }}" 
                class="form-control  
                @error('biografia') is-invalid @enderror">
                <trix-editor input="biografia"></trix-editor>

                @error('biografia')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="imagen">Elige la imagen</label>
                <input type="file" class="form-control-file @error('imagen') is-invalid @enderror" id="imagen"
                name="imagen">
                
                @if ($perfil->imagen)
                <div class="mt-4">
                    <h4>Imagen Actual:</h4>
                    <img src="/storage/{{ $perfil->imagen}}" style="width: 300px" alt="">
                </div>
                @endif
                @error('imagen')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
                
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Actualizar perfil</button>
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