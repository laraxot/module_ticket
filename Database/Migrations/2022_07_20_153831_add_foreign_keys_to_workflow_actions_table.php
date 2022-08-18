<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWorkflowActionsTable extends XotBaseMigration
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
            $table->foreign(['workflow_id'], 'workflow_action_1')->references(['id'])->on('workflow_names')->onUpdate('NO ACTION');
        });
    }
}
