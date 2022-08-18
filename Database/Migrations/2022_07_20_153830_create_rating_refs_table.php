<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatingRefsTable extends XotBaseMigration
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
            $table->integer('rating_id');
            $table->integer('ticket_id');
            $table->integer('thread_id');
            $table->integer('rating_value');
            $table->timestamps();
        });
    }
}
