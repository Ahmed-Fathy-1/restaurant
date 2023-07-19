<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaitersTable extends Migration {

	public function up()
	{
		Schema::create('waiters', function(Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('waiters');
	}
}
