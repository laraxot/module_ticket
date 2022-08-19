<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateKbPagesTable extends XotBaseMigration
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
            $table->boolean('status');
            $table->boolean('visibility');
            $table->string('slug');
            $table->text('description');
            $table->timestamps();
        });
    }
}
