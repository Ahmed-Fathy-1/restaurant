<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealOrderDetail extends Model 
{

    protected $table = 'meal_order_detail';
    public $timestamps = true;
    protected $fillable = array('meal_id', 'order_detail_id');

}