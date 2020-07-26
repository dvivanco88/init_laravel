<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('rols')->insert([
            'name' => 'Admin',
            'created_at' => DB::raw('now()'),
            'updated_at' => DB::raw('now()'),
            'is_active' => true
        ]);

        DB::table('users')->insert([
            'name' => 'Daniel Vivanco',
            'rol_id' => 1,
            'email' => 'visoftpc@hotmail.com',
            'created_at' => DB::raw('now()'),
            'updated_at' => DB::raw('now()'),
            'password' => bcrypt('Rayados1'),
            'image' => 'no_photo',
            'enterprise' => false,
            'is_active' => true
        ]);
    }
}
