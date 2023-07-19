<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waiter extends Model 
{

    protected $table = 'waiters';
    public $timestamps = true;
    protected $fillable = array('name');

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}