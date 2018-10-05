<?php namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;

class AuthController extends Controller 
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request) 
    {
        $this->request = $request;
    }

    /**
     * Create a new token.
     * 
     * @param  \App\Models\User   $user
     * @return string
     */
    protected function jwt(User $user) 
    {
        $payload = [
            'iss' => 'lumen-jwt', // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() + 60*60*60 // Expiration time
        ];
        
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     * 
     * @param  \App\User   $user 
     * @return mixed
     */
    public function authenticate(User $user) 
    {
        $this->validate($this->request, User::$rules);

        $user = User::where('email', $this->request->input('email'))->first();

        if (!$user) {
            return response()->json([
                'error' => 'User not found.'
            ], 400);
        }

        // Verify the password and generate the token
        if (app('hash')->check($this->request->input('password'), $user->password)) {
            return response()->json([
                'token' => $this->jwt($user)
            ], 200);
        }

        // Bad Request response
        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);
    }

}
