<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration {

	public function up()
	{
		Schema::create('order_details', function(Blueprint $table) {
			$table->id();
			$table->string('amount_to_pay');
            $table->foreignId('meal_id')->constrained();
            $table->foreignId('order_id')->constrained();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('order_details');

}
}
