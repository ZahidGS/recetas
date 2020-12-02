<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Receta;
use Faker\Generator as Faker;

$factory->define(Receta::class, function (Faker $faker) {
    return [
        'titulo' => $faker->sentence,
        'ingredientes' => $faker->paragraph,
        'preparacion' => $faker->paragraph,
        'imagen' => \Faker\Provider\Image::image(storage_path() . '/app/public/upload-recetas', 1000,550, null,false),
        //'imagen' => $faker->image('public/storage/upload-recetas',1000,550, null, false),
        'user_id' => \App\User::all()->random()->id,
        'categoria_id' => \App\CategoriaReceta::all()->random()->id,
    ];
});

