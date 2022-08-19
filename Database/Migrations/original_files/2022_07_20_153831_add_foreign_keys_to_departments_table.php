<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDepartmentsTable extends XotBaseMigration
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
            $table->foreign(['sla'], 'departments_ibfk_1')->references(['id'])->on('sla_plans')->onUpdate('NO ACTION');
            $table->foreign(['manager'], 'departments_ibfk_2')->references(['id'])->on('users')->onUpdate('NO ACTION');
        });
    }
}
