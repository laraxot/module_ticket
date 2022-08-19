<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreatePasswordResetsTable extends XotBaseMigration
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
            $table->string('email')->index();
            $table->string('token')->index();
            $table->dateTime('created_at')->default('0000-00-00 00:00:00');
        });
    }
}
