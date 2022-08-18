<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatingsTable extends XotBaseMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->tableCreate(
            function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('display_order');
            $table->integer('allow_modification');
            $table->integer('rating_scale');
            $table->string('rating_area');
            $table->string('restrict');
            $table->timestamps();
        });
    }
}
