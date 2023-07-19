<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model 
{

    protected $table = 'customers';
    public $timestamps = true;
    protected $fillable = array('name', 'phone');

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}