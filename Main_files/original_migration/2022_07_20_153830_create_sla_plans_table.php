<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlaPlansTable extends XotBaseMigration
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
            $table->string('grace_period');
            $table->string('admin_note');
            $table->boolean('status');
            $table->boolean('transient');
            $table->boolean('ticket_overdue');
            $table->timestamps();
        });
    }
}
