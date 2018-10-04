<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

    protected $fillable = ["title", "slug", "model"];

    protected $dates = [];

    public static $rules = [
        "title" => "required",
        "slug" => "required",
        "model" => "required",
    ];

    // Relationships

}
