<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateFaveoQueuesTable extends XotBaseMigration
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
            $table->integer('service_id');
            $table->string('key');
            $table->string('value');
            $table->timestamps();
        });
    }
}
