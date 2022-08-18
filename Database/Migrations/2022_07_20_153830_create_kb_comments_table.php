<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateKbCommentsTable extends XotBaseMigration
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
            $table->unsignedInteger('article_id')->index('comment_article_id_foreign');
            $table->string('name');
            $table->string('email');
            $table->string('website');
            $table->string('comment');
            $table->boolean('status');
            $table->timestamps();
        });
    }
}
