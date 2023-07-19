<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration {

	public function up()
	{
		Schema::create('meals', function(Blueprint $table) {
			$table->id();
			$table->integer('price')->unsigned();
			$table->string('description');
			$table->integer('quantity_available')->unsigned();
			$table->integer('discount')->default(0)->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('meals');
	}
}
