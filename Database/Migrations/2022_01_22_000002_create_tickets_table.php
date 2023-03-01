<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateTicketsTable extends XotBaseMigration {
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
                $table->string('txt');
                $table->integer('parent_id');
                $table->string('created_by')->nullable();
                $table->string('updated_by')->nullable();
                $table->timestamps();
            }
        );

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table) {
                // if (! $this->hasColumn('created_by')) {
                // }
                // if (! $this->hasColumn('url')) {
                //     $table->string('url')->nullable();
                // }

                if (! $this->hasColumn('deleted_at')) {
                    $table->softDeletes();
                }

                if (! $this->hasColumn('category_id')) {
                    $table->integer('category_id');
                }

                if (! $this->hasColumn('content')) {
                    $table->string('content');
                }
            }
        );
    }
}
