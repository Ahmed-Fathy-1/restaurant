<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration {

	public function up()
	{
		Schema::create('reservations', function(Blueprint $table) {
			$table->id();
            $table->foreignId('table_id')->constrained();
            $table->foreignId('customer_id')->constrained();
			$table->datetime('from_time');
			$table->datetime('to_time');
			$table->timestamps();
        });
	}

	public function down()
	{
		Schema::dropIfExists('reservations');
	}
}
