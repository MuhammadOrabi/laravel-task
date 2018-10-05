<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model 
{

    protected $fillable = ["title", "slug"];

    protected $dates = [];

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
