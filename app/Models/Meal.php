<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{

    protected $table = 'meals';
    public $timestamps = true;
    protected $fillable = array('price', 'description', 'quantity_available', 'discount');

    public function orderDetails()
    {
        return $this->belongsToMany('App\Models\OrderDetail', 'order_detail_id');
    }

}
