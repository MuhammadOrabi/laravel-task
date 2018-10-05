<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model {

    protected $fillable = ['type', 'approval_from', 'proposal_no', 'client_source', 'client_name', 'value', 'user_id'];

    protected $dates = ['due', 'deleted_at'];

    public static $rules = [
        'type' => 'required',
        'approval_from' => 'required',
        'proposal_no' => 'required|numeric',
        'client_source' => 'required',
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
}
