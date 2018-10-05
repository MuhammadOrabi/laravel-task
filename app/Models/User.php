<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public static $rules = [
        'email'     => 'required|email',
        'password'  => 'required'
    ];

    public function proposal()
    {
        return $this->hasMany('App\Models\Proposal');
    }

     /**
     * The roles that belong to the admin.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function getRole($model, $slug)
    {
        return $this->roles()->whereHas('permissions', function ($query) use ($model, $slug) {
            $query->where('model', $model)->where('slug', $slug);
        })->get()->first();
    }
}
