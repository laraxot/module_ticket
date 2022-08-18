<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAdditionalInfosTable extends XotBaseMigration
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
            $table->integer('owner');
            $table->string('service');
            $table->string('key');
            $table->string('value')->nullable();
            $table->timestamps();
        });
    }
}
