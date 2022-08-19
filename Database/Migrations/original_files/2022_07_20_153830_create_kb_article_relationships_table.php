<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateKbArticleRelationshipsTable extends XotBaseMigration
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
            $table->unsignedInteger('article_id')->index('article_relationship_article_id_foreign');
            $table->unsignedInteger('category_id')->index('article_relationship_category_id_foreign');
            $table->timestamps();
        });
    }
}
