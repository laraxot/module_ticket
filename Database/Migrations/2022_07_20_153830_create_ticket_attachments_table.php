<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketAttachmentsTable extends XotBaseMigration
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
            $table->unsignedInteger('thread_id')->nullable()->index('thread_id');
            $table->string('size');
            $table->string('type');
            $table->string('poster');
            $table->timestamps();
            $table->binary('file')->nullable();
            $table->string('driver');
            $table->string('path');
        });
    }
}
