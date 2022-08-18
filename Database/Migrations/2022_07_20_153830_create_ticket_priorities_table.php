<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketPrioritiesTable extends XotBaseMigration
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
            $table->increments('priority_id');
            $table->string('priority');
            $table->string('status');
            $table->string('priority_desc');
            $table->string('priority_color');
            $table->boolean('priority_urgency');
            $table->boolean('ispublic');
            $table->string('is_default');
            $table->timestamps();
        });
    }
}
