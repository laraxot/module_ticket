<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserAssignOrganizationsTable extends XotBaseMigration
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
            $table->foreign(['org_id'], 'user_assign_organizations_ibfk_1')->references(['id'])->on('organizations')->onUpdate('NO ACTION');
            $table->foreign(['user_id'], 'user_assign_organizations_ibfk_2')->references(['id'])->on('users')->onUpdate('NO ACTION');
        });
    }
}
