<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketCollaboratorsTable extends XotBaseMigration
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
            $table->boolean('isactive');
            $table->unsignedInteger('ticket_id')->nullable()->index('ticket_id');
            $table->unsignedInteger('user_id')->nullable()->index('user_id');
            $table->string('role');
            $table->timestamps();
        });
    }
}
