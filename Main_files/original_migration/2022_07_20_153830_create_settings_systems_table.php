<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsSystemsTable extends XotBaseMigration
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
            $table->boolean('status');
            $table->string('url');
            $table->string('name');
            $table->string('department');
            $table->string('page_size');
            $table->string('log_level');
            $table->string('purge_log');
            $table->integer('api_enable');
            $table->integer('api_key_mandatory');
            $table->string('api_key');
            $table->string('name_format');
            $table->unsignedInteger('time_farmat')->nullable()->index('time_farmat');
            $table->unsignedInteger('date_format')->nullable()->index('date_format');
            $table->unsignedInteger('date_time_format')->nullable()->index('date_time_format');
            $table->string('day_date_time');
            $table->unsignedInteger('time_zone')->nullable()->index('time_zone');
            $table->string('content');
            $table->string('version');
            $table->timestamps();
        });
    }
}
