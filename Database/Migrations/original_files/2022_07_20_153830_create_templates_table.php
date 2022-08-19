<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemplatesTable extends XotBaseMigration
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
            $table->string('variable');
            $table->integer('type');
            $table->string('subject');
            $table->text('message');
            $table->string('description');
            $table->integer('set_id');
            $table->timestamps();
        });
    }
}
