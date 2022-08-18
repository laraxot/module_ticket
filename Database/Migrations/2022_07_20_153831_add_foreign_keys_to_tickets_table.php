<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTicketsTable extends XotBaseMigration
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
            $table->foreign(['assigned_to'], 'tickets_ibfk_9')->references(['id'])->on('users')->onUpdate('NO ACTION');
            $table->foreign(['priority_id'], 'tickets_ibfk_4')->references(['priority_id'])->on('ticket_priorities')->onUpdate('NO ACTION');
            $table->foreign(['help_topic_id'], 'tickets_ibfk_6')->references(['id'])->on('help_topics')->onUpdate('NO ACTION');
            $table->foreign(['user_id'], 'tickets_ibfk_1')->references(['id'])->on('users')->onUpdate('NO ACTION');
            $table->foreign(['source'], 'tickets_ibfk_8')->references(['id'])->on('ticket_sources')->onUpdate('NO ACTION');
            $table->foreign(['team_id'], 'tickets_ibfk_3')->references(['id'])->on('teams')->onUpdate('NO ACTION');
            $table->foreign(['sla'], 'tickets_ibfk_5')->references(['id'])->on('sla_plans')->onUpdate('NO ACTION');
            $table->foreign(['status'], 'tickets_ibfk_7')->references(['id'])->on('ticket_statuses')->onUpdate('NO ACTION');
            $table->foreign(['dept_id'], 'tickets_ibfk_2')->references(['id'])->on('departments')->onUpdate('NO ACTION');
        });
    }
}
