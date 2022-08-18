<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepartmentsTable extends XotBaseMigration
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
            $table->string('type');
            $table->unsignedInteger('sla')->nullable()->index('sla');
            $table->unsignedInteger('manager')->nullable()->index('manager_2');
            $table->string('ticket_assignment');
            $table->string('outgoing_email');
            $table->string('template_set');
            $table->string('auto_ticket_response');
            $table->string('auto_message_response');
            $table->string('auto_response_email');
            $table->string('recipient');
            $table->string('group_access');
            $table->string('department_sign');
            $table->timestamps();
        });
    }
}
