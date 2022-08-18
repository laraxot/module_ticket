<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHelpTopicsTable extends XotBaseMigration
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
            $table->foreign(['priority'], 'help_topics_ibfk_4')->references(['priority_id'])->on('ticket_priorities')->onUpdate('NO ACTION');
            $table->foreign(['auto_assign'], 'help_topics_ibfk_6')->references(['id'])->on('users')->onDelete('SET NULL');
            $table->foreign(['custom_form'], 'help_topics_ibfk_1')->references(['id'])->on('custom_forms')->onUpdate('NO ACTION');
            $table->foreign(['ticket_status'], 'help_topics_ibfk_3')->references(['id'])->on('ticket_statuses')->onUpdate('NO ACTION');
            $table->foreign(['sla_plan'], 'help_topics_ibfk_5')->references(['id'])->on('sla_plans');
            $table->foreign(['department'], 'help_topics_ibfk_2')->references(['id'])->on('departments')->onUpdate('NO ACTION');
        });
    }
}
