<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $fillable = [
        'titulo', 'preparacion', 'ingredientes','imagen','categoria_id'
    ];

    //Obtiene la categoria de la receta via FK, relacion 1:1 belongsTo
    //una categoria pertenece a una receta
    public function categoria()
    {
        return $this->belongsTo(CategoriaReceta::class);
    }

    //obtiene informacion del usuario FK
    public function autor(){
        return $this->belongsTo(User::class, 'user_id'); //FK de esta tabla
                // se le indica el campo con el que se va a relacionar, no siempre es asi
    }

    //Likes que ha recibido una receta
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes_receta');
    }
}
