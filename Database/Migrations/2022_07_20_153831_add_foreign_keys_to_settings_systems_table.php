<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSettingsSystemsTable extends XotBaseMigration
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
            $table->foreign(['date_time_format'], 'settings_systems_ibfk_4')->references(['id'])->on('date_time_formats')->onUpdate('NO ACTION');
            $table->foreign(['time_zone'], 'settings_systems_ibfk_1')->references(['id'])->on('timezones')->onUpdate('NO ACTION');
            $table->foreign(['date_format'], 'settings_systems_ibfk_3')->references(['id'])->on('date_formats')->onUpdate('NO ACTION');
            $table->foreign(['time_farmat'], 'settings_systems_ibfk_2')->references(['id'])->on('time_formats')->onUpdate('NO ACTION');
        });
    }
}
