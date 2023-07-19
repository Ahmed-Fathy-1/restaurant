<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->id();
            $table->foreignId('table_id')->constrained();
            $table->foreignId('waiter_id')->constrained();
            $table->foreignId('reservation_id')->constrained();
            $table->foreignId('customer_id')->constrained();
			$table->string('total');
			$table->string('paid')->default('unpaid');
			$table->date('date');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('orders');
	}
}
