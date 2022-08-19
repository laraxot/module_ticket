<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateLoginAttemptsTable extends XotBaseMigration
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
            $table->string('User');
            $table->string('IP');
            $table->string('Attempts');
            $table->dateTime('LastLogin');
            $table->timestamps();
        });
    }
}
