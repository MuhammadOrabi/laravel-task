<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait RESTActions 
{
    public function all(Request $request)
    {
        $m = self::MODEL;

        if ($request->user->cannot('view', $m)) {
            abort(403);
        }

        $data = $m::query();
        
        if (method_exists($m, 'scopeFiltered')) {
            $data = $m::filtered($request);
        }

        $data = $data->paginate()->appends(
            $request->except('page')
        );
        
        return $this->respond(Response::HTTP_OK, $data);
    }

    public function get(Request $request, $id)
    {
        $m = self::MODEL;
        
        if ($request->user->cannot('view', $m)) {
            abort(403);
        }

        $model = $m::find($id);
        if(is_null($model)){
            return $this->respond(Response::HTTP_NOT_FOUND);
        }
        return $this->respond(Response::HTTP_OK, $model);
    }

    public function add(Request $request)
    {
        $m = self::MODEL;

        if ($request->user->cannot('create', $m)) {
            abort(403);
        }

        $this->validate($request, $m::$rules);
        return $this->respond(Response::HTTP_CREATED, $m::create($request->all()));
    }

    public function put($id, Request $request)
    {
        $m = self::MODEL;

        if ($request->user->cannot('update', $m)) {
            abort(403);
        }
        $this->validate($request, $m::$rules);

        $model = $m::find($id);
        if(is_null($model)){
            return $this->respond(Response::HTTP_NOT_FOUND);
        }
        $model->update($request->all());
        return $this->respond(Response::HTTP_OK, $model);
    }

    public function remove(Request $request, $id)
    {
        $m = self::MODEL;

        if ($request->user->cannot('delete', $m)) {
            abort(403);
        }

        if (is_null($m::find($id))) {
            return $this->respond(Response::HTTP_NOT_FOUND);
        }
        $m::destroy($id);
        return $this->respond(Response::HTTP_NO_CONTENT);
    }

    protected function respond($status, $data = [])
    {
        return response()->json($data, $status);
    }

}
