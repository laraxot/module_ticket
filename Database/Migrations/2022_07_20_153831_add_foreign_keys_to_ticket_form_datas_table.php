<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTicketFormDatasTable extends XotBaseMigration
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
            $table->foreign(['ticket_id'], 'ticket_form_datas_ibfk_1')->references(['id'])->on('tickets')->onUpdate('NO ACTION');
        });
    }
}
