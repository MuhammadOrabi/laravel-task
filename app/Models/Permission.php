<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'model'];

    /**
     * The attributes that has rules for submssion
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'slug' => 'required',
        'model' => 'required',
    ];

    // Relationships
    /**
     * The roles that belong to the permission.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
}
