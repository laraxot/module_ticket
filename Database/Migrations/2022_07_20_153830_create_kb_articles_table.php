<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateKbArticlesTable extends XotBaseMigration
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
            $table->text('name');
            $table->string('slug');
            $table->text('description');
            $table->boolean('status');
            $table->boolean('type');
            $table->dateTime('publish_time')->nullable();
            $table->timestamps();
        });
    }
}
