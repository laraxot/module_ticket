<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountryCodesTable extends XotBaseMigration
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
            $table->char('iso', 2);
            $table->string('name', 100);
            $table->string('nicename', 100);
            $table->char('iso3', 3);
            $table->smallInteger('numcode');
            $table->integer('phonecode');
            $table->timestamps();
        });
    }
}
