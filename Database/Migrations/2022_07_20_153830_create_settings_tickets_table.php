<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTicketsTable extends XotBaseMigration
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
            $table->string('num_format');
            $table->string('num_sequence');
            $table->string('priority');
            $table->string('sla');
            $table->string('help_topic');
            $table->string('max_open_ticket');
            $table->string('collision_avoid');
            $table->string('lock_ticket_frequency')->default('0');
            $table->string('captcha');
            $table->boolean('status');
            $table->boolean('claim_response');
            $table->boolean('assigned_ticket');
            $table->boolean('answered_ticket');
            $table->boolean('agent_mask');
            $table->boolean('html');
            $table->boolean('client_update');
            $table->boolean('max_file_size');
            $table->timestamps();
        });
    }
}
