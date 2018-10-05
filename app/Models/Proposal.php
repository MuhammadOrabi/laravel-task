<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model {

    protected $fillable = [
        'type', 'approval_from', 'due', 'client_source', 'client_name', 'value', 'user_id'
    ];

    protected $attributes = [
        'type', 'approval_from', 'due', 'client_source', 
        'client_name', 'value', 'user_id', 'code', 'created_at', 
        'updated_at', 'deleted_at', 'id'
    ];

    protected $relations = ['user'];
    
    protected $dates = ['due', 'deleted_at'];

    public static $rules = [
        'type' => 'required',
        'approval_from' => 'required',
        'client_source' => 'required',
        'due' => 'required',
        'client_name' => 'required',
        'value' => 'required',
        'user_id' => 'required|numeric',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the proposal's id.
     *
     * @param  string  $value
     * @return string
     */
    public function getIdAttribute($value)
    {
        return sprintf('%05d', $value);
    }

    public function scopeFiltered($query, $request)
    {   
        if ($request->has('user_id')) {
            $query->where('user_id', $request->get('user_id'));
        }

        if ($request->has('with')) {
            $relations = explode(',', $request->get('with'));        
            $query->with(
                array_intersect($relations, $this->relations) ?: []
            );
        }

        if ($request->has('attr')) {
            $attributes = explode(',', $request->get('attr'));
            $query->select(
                array_intersect($attributes, $this->attributes) ?: '*'
            );
        }

        return $query;
    }
}
