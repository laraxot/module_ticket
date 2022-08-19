<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateHelpTopicsTable extends XotBaseMigration
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
            $table->string('topic');
            $table->string('parent_topic');
            $table->unsignedInteger('custom_form')->nullable()->index('custom_form');
            $table->unsignedInteger('department')->nullable()->index('department');
            $table->unsignedInteger('ticket_status')->nullable()->index('ticket_status');
            $table->unsignedInteger('priority')->nullable()->index('priority');
            $table->unsignedInteger('sla_plan')->nullable()->index('sla_plan');
            $table->string('thank_page');
            $table->string('ticket_num_format');
            $table->string('internal_notes');
            $table->boolean('status');
            $table->boolean('type');
            $table->unsignedInteger('auto_assign')->nullable()->index('auto_assign_2');
            $table->boolean('auto_response');
            $table->timestamps();
        });
    }
}
