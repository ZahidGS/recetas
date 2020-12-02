<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Zahid Guerrero',
            'email' => 'z@gmail.com',
            'password' => Hash::make('zahid123'),
            'url' => 'https://laravel.com/',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        $user2 = User::create([
            'name' => 'Rosa Valdes',
            'email' => 'r@gmail.com',
            'password' => Hash::make('password'),
            'url' => 'https://laravel.com/',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $user3 = User::create([
            'name' => 'Arely Guerrero',
            'email' => 'a@gmail.com',
            'password' => Hash::make('password'),
            'url' => 'https://laravel.com/',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        factory(App\Receta::class,25)->create();

        //('department', DB::raw('SUM(price) as total_sales'))
        $affected = DB::table('recetas')->update(['imagen' => DB::raw('CONCAT("upload-recetas/", imagen)')]);
        //$affecte2 = DB::table('perfils')->update(['imagen' => DB::raw('CONCAT("upload-perfiles/", imagen)')]);
    }
}
