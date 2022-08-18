<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketThreadsTable extends XotBaseMigration
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
            $table->unsignedInteger('ticket_id')->nullable()->index('ticket_id_2');
            $table->unsignedInteger('user_id')->nullable()->index('user_id');
            $table->string('poster');
            $table->unsignedInteger('source')->nullable()->index('source');
            $table->integer('reply_rating');
            $table->integer('rating_count');
            $table->boolean('is_internal');
            $table->string('title');
            $table->binary('body')->nullable();
            $table->string('format');
            $table->string('ip_address');
            $table->timestamps();
        });
    }
}
