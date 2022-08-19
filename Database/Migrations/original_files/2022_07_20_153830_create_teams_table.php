<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeamsTable extends XotBaseMigration
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
            $table->string('name');
            $table->boolean('status');
            $table->unsignedInteger('team_lead')->nullable()->index('team_lead');
            $table->boolean('assign_alert');
            $table->string('admin_notes');
            $table->timestamps();
        });
    }
}
