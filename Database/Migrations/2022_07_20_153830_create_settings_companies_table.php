<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsCompaniesTable extends XotBaseMigration
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
            $table->string('company_name');
            $table->string('website');
            $table->string('phone');
            $table->string('address');
            $table->string('landing_page');
            $table->string('offline_page');
            $table->string('thank_page');
            $table->string('logo');
            $table->string('use_logo');
            $table->timestamps();
        });
    }
}
