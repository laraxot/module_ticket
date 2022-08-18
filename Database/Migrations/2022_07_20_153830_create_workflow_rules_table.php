<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkflowRulesTable extends XotBaseMigration
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
            $table->unsignedInteger('workflow_id')->index('workflow_rules_1');
            $table->string('matching_criteria');
            $table->string('matching_scenario');
            $table->string('matching_relation');
            $table->text('matching_value');
            $table->timestamps();
        });
    }
}
