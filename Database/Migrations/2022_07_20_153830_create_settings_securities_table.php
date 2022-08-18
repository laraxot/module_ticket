<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsSecuritiesTable extends XotBaseMigration
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
            $table->string('lockout_message');
            $table->integer('backlist_offender');
            $table->integer('backlist_threshold');
            $table->integer('lockout_period');
            $table->integer('days_to_keep_logs');
            $table->timestamps();
        });
    }
}
