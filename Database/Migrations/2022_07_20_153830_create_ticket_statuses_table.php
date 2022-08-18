<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketStatusesTable extends XotBaseMigration
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
            $table->string('state');
            $table->integer('mode');
            $table->string('message');
            $table->integer('flags');
            $table->integer('sort');
            $table->integer('email_user');
            $table->string('icon_class');
            $table->string('properties');
            $table->timestamps();
        });
    }
}
