<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAssignOrganizationsTable extends XotBaseMigration
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
            $table->unsignedInteger('org_id')->nullable()->index('org_id');
            $table->unsignedInteger('user_id')->nullable()->index('user_id');
            $table->timestamps();
        });
    }
}
