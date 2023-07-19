<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('table_id', 'customer_id', 'reservation_id', 'waiter_id', 'total', 'paid', 'date');

    public function table()
    {
        return $this->belongsTo('App\Models\Table');
    }

    public function reservation()
    {
        return $this->belongsTo('App\Models\Reservation');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function waiter()
    {
        return $this->belongsTo('App\Models\Waiter');
    }

    public function details()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

}
