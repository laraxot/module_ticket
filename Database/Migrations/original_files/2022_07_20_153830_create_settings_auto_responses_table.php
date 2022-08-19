<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsAutoResponsesTable extends XotBaseMigration
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
            $table->boolean('new_ticket');
            $table->boolean('agent_new_ticket');
            $table->boolean('submitter');
            $table->boolean('participants');
            $table->boolean('overlimit');
            $table->timestamps();
        });
    }
}
