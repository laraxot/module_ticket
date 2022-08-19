<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEmailsTable extends XotBaseMigration
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
            $table->foreign(['department'], 'emails_ibfk_1')->references(['id'])->on('departments')->onUpdate('NO ACTION');
            $table->foreign(['help_topic'], 'emails_ibfk_3')->references(['id'])->on('help_topics')->onUpdate('NO ACTION');
            $table->foreign(['priority'], 'emails_ibfk_2')->references(['priority_id'])->on('ticket_priorities')->onUpdate('NO ACTION');
        });
    }
}
