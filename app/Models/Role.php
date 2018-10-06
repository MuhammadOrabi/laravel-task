<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["title", "slug"];

    /**
     * The attributes that has rules for submssion
     *
     * @var array
     */
    public static $rules = [
        "title" => "required",
        "slug" => "required",
    ];

    // Relationships
    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    /**
     * The permissions that belong to the role.
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }
}
