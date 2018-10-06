<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProposalsController extends Controller 
{
    const MODEL = 'App\Models\Proposal';

    use RESTActions;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $m = self::MODEL;

        if ($request->user->cannot('create', $m)) {
            abort(403);
        }

        $this->validate($request, $m::$rules);
        
        $data = $request->all();
        
        $data['user_id'] = $request->user->id;

        return $this->respond(Response::HTTP_CREATED, $m::create($data));
    }
}
