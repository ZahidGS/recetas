<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //

    //Relacion 1:1 de perfil a usuario, como este tiene el user_id
    // se usa el belongsTo, ya que este campo pertenece al modelo User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
