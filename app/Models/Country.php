<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
    protected $table = 'countries';
    protected $fillable = [
        'name',
        'status'
    ];

    public function states()
    {
        return $this->hasMany('App\Models\State');
    }

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }
}
