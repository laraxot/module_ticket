<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTeamAssignAgentsTable extends XotBaseMigration
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
            $table->foreign(['team_id'], 'team_assign_agents_ibfk_1')->references(['id'])->on('teams')->onUpdate('NO ACTION');
            $table->foreign(['agent_id'], 'team_assign_agents_ibfk_2')->references(['id'])->on('users')->onUpdate('NO ACTION');
        });
    }
}
