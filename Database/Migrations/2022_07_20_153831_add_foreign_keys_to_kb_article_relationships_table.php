<?php

use Modules\Xot\Database\Migrations\XotBaseMigration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToKbArticleRelationshipsTable extends XotBaseMigration
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
            $table->foreign(['article_id'], 'article_relationship_article_id_foreign')->references(['id'])->on('kb_articles');
            $table->foreign(['category_id'], 'article_relationship_category_id_foreign')->references(['id'])->on('kb_categories');
        });
    }
}
