<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganizationsTable extends XotBaseMigration
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
            $table->string('phone');
            $table->string('website');
            $table->string('address');
            $table->unsignedInteger('head')->nullable()->index('head');
            $table->string('internal_notes');
            $table->timestamps();
        });
    }
}
