<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateFieldValuesTable extends XotBaseMigration
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
            $table->unsignedInteger('field_id')->nullable()->index('field_values_field_id_foreign');
            $table->unsignedInteger('child_id')->nullable();
            $table->string('field_key')->nullable();
            $table->string('field_value')->nullable();
            $table->timestamps();
        });
    }
}
