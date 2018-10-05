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
            'email' => 'ahmed@app.com',
            'name' => 'Ahmed Essam',
            'password' => app('hash')->make('password')
        ]);

        factory('App\Models\User')->create([
            'email' => 'yassmin@app.com',
            'name' => 'Yassmin Hassan',
            'password' => app('hash')->make('password')
        ]);

        factory('App\Models\User', 8)->create();
    }
}
