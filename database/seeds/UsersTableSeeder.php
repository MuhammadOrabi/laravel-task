<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sales = Role::whereSlug('sales-agent')->first();
        factory('App\Models\User')->create([
            'email' => 'ahmed@app.com',
            'name' => 'Ahmed Essam',
            'password' => app('hash')->make('password')
        ])->roles()->sync($sales->id);

        factory('App\Models\User')->create([
            'email' => 'yassmin@app.com',
            'name' => 'Yassmin Hassan',
            'password' => app('hash')->make('password')
        ])->roles()->sync($sales->id);

        factory('App\Models\User', 8)->create()->each(function ($u) use ($sales) {
            $u->roles()->sync($sales->id);
        });
    }
}
