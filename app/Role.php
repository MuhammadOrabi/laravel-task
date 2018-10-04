<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    protected $fillable = ["title", "slug"];

    protected $dates = [];

    public static $rules = [
        "title" => "required",
        "slug" => "required",
    ];

    // Relationships

}
