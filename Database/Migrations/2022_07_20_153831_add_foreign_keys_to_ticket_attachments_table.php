<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTicketAttachmentsTable extends XotBaseMigration
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
            $table->foreign(['thread_id'], 'ticket_attachments_ibfk_1')->references(['id'])->on('ticket_threads')->onUpdate('NO ACTION');
        });
    }
}
