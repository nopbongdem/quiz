<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('questions', function (Blueprint $table) {
			$table->increments('id');

			$table->text('question');
			$table->string('image')->nullable();
			$table->json('choose');
			$table->tinyInteger('answer');
			$table->integer('category_id')->unsigned()->nullable();
			$table->boolean('status')->default(true);
			$table->softDeletes();

			$table->timestamps();

			$table->foreign('category_id')
			->references('id')
			->on('categories')
			->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('questions');
	}
}
