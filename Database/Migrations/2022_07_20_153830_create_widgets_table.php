<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateWidgetsTable extends XotBaseMigration
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
            $table->integer('id', true);
            $table->string('name', 30)->nullable();
            $table->string('title', 50)->nullable();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }
}
