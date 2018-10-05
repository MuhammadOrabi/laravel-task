<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class ProposalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'web development', 'digital marketing', 'web product'
        ];
        $approval_from = [
            'Mostafa Megahed', 'Mohamed Ansary'
        ];
        $client_source = [
            'Recap', 'Digital campaign'
        ];

        $users = User::all();
        $users->each(function ($user) use ($types, $approval_from, $client_source) {
            factory('App\Models\Proposal', 10)->create([
                'user_id' => $user->id,
                'type' => $types[array_rand($types)],
                'approval_from' => $approval_from[array_rand($approval_from)],
                'client_source' => $client_source[array_rand($client_source)]
            ]);
        });
    }
}
