<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreatePrioritiesTable extends XotBaseMigration
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

                $table->string('color')->nullable();

                $table->timestamps();

                $table->softDeletes();
            }
        );
    }
}
