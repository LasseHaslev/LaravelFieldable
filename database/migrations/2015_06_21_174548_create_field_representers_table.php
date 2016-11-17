<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldRepresentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_representers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')
                ->default( '' );
            $table->string('identifier')
                ->default( '' );

            $table->integer('field_type_id')
                ->unsigned()
                ->nullable()
                ->index();
            $table->foreign('field_type_id')
                ->references('id')
                ->on('field_types')
                ->onDelete('cascade');

            $table->string('description')
                ->default( '' );
            $table->boolean('is_repeatable')
                ->default( false );

            $table->integer('order')
                ->unsigned()
                ->default(0);

            // $table->boolean( 'is_group' );
            // $table->integer('field_representer_id')
                // ->unsigned()
                // ->nullable()
                // ->index();
            // $table->foreign('field_representer_id')
                // ->references('id')
                // ->on('field_representers')
                // ->onDelete('cascade');

            $table->integer('fieldable_id')
                ->unsigned()
                ->nullable();
            $table->string('fieldable_type')
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
        Schema::drop('field_representers');
    }
}
