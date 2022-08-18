<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTicketThreadsTable extends XotBaseMigration
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
            $table->foreign(['ticket_id'], 'ticket_threads_ibfk_1')->references(['id'])->on('tickets')->onUpdate('NO ACTION');
            $table->foreign(['source'], 'ticket_threads_ibfk_3')->references(['id'])->on('ticket_sources')->onUpdate('NO ACTION');
            $table->foreign(['user_id'], 'ticket_threads_ibfk_2')->references(['id'])->on('users')->onUpdate('NO ACTION');
        });
    }
}
