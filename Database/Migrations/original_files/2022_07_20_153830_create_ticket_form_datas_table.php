<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketFormDatasTable extends XotBaseMigration
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
            $table->unsignedInteger('ticket_id')->nullable()->index('ticket_id');
            $table->text('title');
            $table->text('content');
            $table->timestamps();
        });
    }
}
