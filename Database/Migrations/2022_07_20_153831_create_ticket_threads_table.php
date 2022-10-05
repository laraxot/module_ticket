<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateTicketThreadsTable extends XotBaseMigration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $this->tableCreate(
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('ticket_id')->nullable()->index('ticket_id_2');
                $table->unsignedInteger('user_id')->nullable()->index('user_id');
                $table->string('poster');
                $table->unsignedInteger('source')->nullable()->index('source'); // non so cosa possa essere
                $table->integer('reply_rating');
                $table->integer('rating_count');
                $table->boolean('is_internal');
                $table->string('title'); // dovrebbe essere in post.title
                $table->binary('body')->nullable(); // dovrebbe essere in post.txt
                $table->string('format');
                $table->string('ip_address');
                $table->timestamps();
            }
        );

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table) {
                if (! $this->hasColumn('created_by')) {
                    $table->string('created_by')->nullable();
                    $table->string('updated_by')->nullable();
                }
            }
        );
    }
}
