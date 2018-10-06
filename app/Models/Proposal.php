<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'approval_from', 'due', 'client_source', 'client_name', 'value', 'user_id'
    ];

    /**
     * The attributes that are used in filtered scope.
     *
     * @var array
     */
    protected $model_attributes = [
        'type', 'approval_from', 'due', 'client_source', 
        'client_name', 'value', 'user_id', 'code', 'created_at', 
        'updated_at', 'deleted_at', 'id'
    ];

    /**
     * The relations that are used in filtered scope.
     *
     * @var array
     */
    protected $relations = ['user'];
    
    /**
     * The dates attributes.
     *
     * @var array
     */
    protected $dates = ['due', 'deleted_at'];

    /**
     * The attributes that has rules for submssion
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'approval_from' => 'required',
        'client_source' => 'required',
        'due' => 'required',
        'client_name' => 'required',
        'value' => 'required',
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

    /**
     * Scope to filter data based on query params
     *
     * @param  QueryBuilder  $query
     * @param  \Illuminate\Http\Request  $request
     * @return QueryBuilder
     */
    public function scopeFiltered($query, $request)
    {   
        // Filter by user_id
        if ($request->has('user_id')) {
            $query->where('user_id', $request->get('user_id'));
        }

        // Eager load relations
        if ($request->has('with')) {
            $relations = explode(',', $request->get('with'));        
            $query->with(
                array_intersect($relations, $this->relations) ?: []
            );
        }

        // Select attributes
        if ($request->has('attr')) {
            $attributes = explode(',', $request->get('attr'));
            $query->select(
                array_intersect($attributes, $this->model_attributes) ?: '*'
            );
        }

        return $query;
    }
}
