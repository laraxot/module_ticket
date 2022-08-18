<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGroupAssignDepartmentsTable extends XotBaseMigration
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
            $table->foreign(['group_id'], 'group_assign_departments_ibfk_1')->references(['id'])->on('groups')->onUpdate('NO ACTION');
            $table->foreign(['department_id'], 'group_assign_departments_ibfk_2')->references(['id'])->on('departments')->onUpdate('NO ACTION');
        });
    }
}
