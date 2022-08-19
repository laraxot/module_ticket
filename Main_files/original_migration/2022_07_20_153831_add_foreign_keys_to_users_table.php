<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsersTable extends XotBaseMigration
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
            $table->foreign(['assign_group'], 'users_ibfk_1')->references(['id'])->on('groups')->onUpdate('NO ACTION');
            $table->foreign(['primary_dpt'], 'users_ibfk_2')->references(['id'])->on('departments')->onUpdate('NO ACTION');
        });
    }
}
