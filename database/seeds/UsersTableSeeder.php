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
        factory('App\Models\User')->create([
            'email' => 'orabi@app.com',
            'password' => app('hash')->make('password')
        ]);
    }
}
