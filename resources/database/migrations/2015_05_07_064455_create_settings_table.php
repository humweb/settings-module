<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->integer('user_id')->default(0)->index();
			$table->integer('configurable_id');
			$table->string('configurable_type');
			$table->string('key')->index();
			$table->text('val')->nullable();
			$table->tinyInteger('is_encoded')->default(0);
			$table->timestamps();
			$table->primary(array('configurable_id', 'configurable_type', 'key'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('settings');
	}

}
