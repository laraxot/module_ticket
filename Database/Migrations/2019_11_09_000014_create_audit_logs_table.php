<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateAuditLogsTable extends XotBaseMigration
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
                $table->text('description');
                $table->unsignedInteger('subject_id')->nullable();
                $table->string('subject_type')->nullable();
                $table->unsignedInteger('user_id')->nullable();
                $table->text('properties')->nullable();
                $table->string('host', 45)->nullable();
                $table->timestamps();
            }
        );
    }
}
