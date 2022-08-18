<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeamAssignAgentsTable extends XotBaseMigration
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
            $table->unsignedInteger('team_id')->nullable()->index('team_id');
            $table->unsignedInteger('agent_id')->nullable()->index('agent_id');
            $table->timestamps();
        });
    }
}
