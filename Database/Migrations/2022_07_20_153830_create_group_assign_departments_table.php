<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupAssignDepartmentsTable extends XotBaseMigration
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
            $table->unsignedInteger('group_id')->index('group_id');
            $table->unsignedInteger('department_id')->index('department_id');
            $table->timestamps();
        });
    }
}
