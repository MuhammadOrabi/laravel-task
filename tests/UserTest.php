<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use Firebase\JWT\JWT;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    protected $user;
    protected $token;

    public function setUp()
    {
        parent::setUp();

        Artisan::call('migrate:fresh', ['--seed' => true]);
        $this->user = User::whereEmail('ahmed@app.com')->first();
        $payload = [
            'iss' => 'lumen-jwt-test',
            'sub' => $this->user->id,
            'iat' => time(),
            'exp' => time() + 60*60*60
        ];
        
        $this->token = JWT::encode($payload, env('JWT_SECRET'));    
    }

    /**
     * Test Create Proposal.
     *
     * @return void
     */
    public function testCreateProposal()
    {
        $data = [
            'type' => 'web development',
            'approval_from' => 'Mohamed Ansary',
            'client_source' => 'Digital campaign',
            'client_name' => 'Orabi',
            'value' => 'blah blah',
            'due' => '2018-10-05 17:32:11'
        ];

        $response = $this->post('/api/proposal', $data, [
            'Authorization' => 'Bearer '. $this->token
        ]);
        
        $this->assertOk();
    }
}
