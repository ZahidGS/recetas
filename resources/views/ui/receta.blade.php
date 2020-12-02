<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img src="{{ asset('/storage/' . $receta->imagen) }}" alt="imagen receta" class="card-img-top">
        <div class="card-body">
            <h3 class="card-title">{{$receta->titulo}}</h3>
            <div class="d-flex justify-content-between">
                @php
                    $fecha = $receta->created_at
                @endphp
                <p class="text-primary fecha">
                    <fecha-receta fecha="{{$fecha}}"></fecha-receta>
                </p>
                <p>{{ count($receta->likes) }} personas les gustó</p>
            </div>
                <p>{{ Str::words( strip_tags( $receta->preparacion ), 20 ) }}</p>
                <a href="{{ route('recetas.show',$receta->id) }}"
                    class="btn btn-primary d-block btn-receta">Ver receta</a>
        </div>
    </div>
</div>
