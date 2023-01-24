<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateTicketsTable extends XotBaseMigration
{
       /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $this->tableCreate(
            function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');

            $table->longText('content')->nullable();

            $table->string('author_name')->nullable();

            $table->string('author_email')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}