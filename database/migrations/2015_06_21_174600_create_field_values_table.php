<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_values', function (Blueprint $table) {
            $table->increments('id');

            $table->string('value');

            $table->integer('field_representer_id')
                ->unsigned()
                ->index();
            $table->foreign('field_representer_id')
                ->references('id')
                ->on('field_representers')
                ->onDelete('cascade');

            $table->integer('valueable_id')
                ->unsigned()
                ->nullable();
            $table->string('valueable_type')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('field_values');
    }
}
