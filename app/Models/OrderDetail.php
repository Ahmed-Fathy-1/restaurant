<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    protected $table = 'order_details';
    public $timestamps = true;
    protected $fillable = array('amount_to_pay', 'order_id', 'meal_id');

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function meals()
    {
        return $this->belongsToMany('App\Models\Meal');
    }

}
