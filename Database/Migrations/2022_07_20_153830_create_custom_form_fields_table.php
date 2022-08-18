<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomFormFieldsTable extends XotBaseMigration
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
            $table->integer('forms_id');
            $table->string('label');
            $table->string('name');
            $table->string('type');
            $table->string('value');
            $table->string('required');
            $table->timestamps();
        });
    }
}
