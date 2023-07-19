<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealOrderDetailTable extends Migration {

	public function up()
	{
		Schema::create('meal_order_detail', function(Blueprint $table) {
			$table->id();
            $table->foreignId('meal_id')->constrained();
            $table->foreignId('order_detail_id')->constrained();
			$table->timestamps();
        });
	}

	public function down()
	{
		Schema::dropIfExists('meal_order_detail');
	}
}
