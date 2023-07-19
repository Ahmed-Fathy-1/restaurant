<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model 
{

    protected $table = 'tables';
    public $timestamps = true;
    protected $fillable = array('capacity');

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}