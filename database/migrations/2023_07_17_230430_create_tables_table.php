<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateTablesTable extends Migration {

	public function up()
	{
		Schema::create('tables', function(Blueprint $table) {
            $table->id();
			$table->integer('capacity')->unsigned();
			$table->boolean('isbazy')->default(0);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('tables');
	}
}
