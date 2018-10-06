<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait RESTActions 
{
    /**
     * get all the rows of the model
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * get the row of the model by id
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * add a row to the model
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
        return $this->respond(Response::HTTP_CREATED, $m::create($request->all()));
    }

    /**
     * update the row of the model by id
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * remove the row of the model by id
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * wrrapper for sending the response
     *
     * @param  int  $status
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    protected function respond($status, $data = [])
    {
        return response()->json($data, $status);
    }

}
