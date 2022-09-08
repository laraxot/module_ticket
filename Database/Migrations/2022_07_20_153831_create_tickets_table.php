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
                $table->string('ticket_number');
                $table->unsignedInteger('user_id')->nullable()->index('user_id');
                $table->unsignedInteger('dept_id')->nullable()->index('dept_id');
                $table->unsignedInteger('team_id')->nullable()->index('team_id');
                $table->unsignedInteger('priority_id')->nullable()->index('priority_id'); // magari mettiamo i nostri?
                $table->unsignedInteger('sla')->nullable()->index('sla');
                $table->unsignedInteger('help_topic_id')->nullable()->index('help_topic_id');
                $table->unsignedInteger('status')->nullable()->index('status'); // abbiamo già il nostro
                $table->boolean('rating'); // abbiamo già il nostro
                $table->boolean('ratingreply'); // non so cosa possa essere
                $table->integer('flags'); // boh?
                $table->integer('ip_address');
                $table->unsignedInteger('assigned_to')->nullable()->index('assigned_to');
                $table->integer('lock_by');
                $table->dateTime('lock_at')->nullable();
                $table->unsignedInteger('source')->nullable()->index('source'); // abbiamo il nostro link show(?)
                $table->integer('isoverdue');
                $table->integer('reopened');
                $table->integer('isanswered');
                $table->integer('html');
                $table->integer('is_deleted');
                $table->integer('closed');
                $table->boolean('is_transferred');
                $table->dateTime('transferred_at');
                $table->dateTime('reopened_at')->nullable();
                $table->dateTime('duedate')->nullable(); // non so cosa sia
                $table->dateTime('closed_at')->nullable();
                $table->dateTime('last_message_at')->nullable();
                $table->dateTime('last_response_at')->nullable();
                $table->integer('approval');
                $table->integer('follow_up');
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
