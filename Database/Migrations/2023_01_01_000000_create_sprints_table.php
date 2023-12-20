<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class .
 */
class CreateSprintsTable extends XotBaseMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                $table->string('name');
                $table->date('starts_at');
                $table->date('ends_at');
                $table->longText('description')->nullable();
                $table->foreignId('project_id')->nullable(); // ->constrained('projects');
                $table->foreignId('epic_id')->nullable()->constrained('epics');
                $table->dateTime('started_at')->nullable();
                $table->dateTime('ended_at')->nullable();
                $table->softDeletes();
                $table->timestamps();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                // if (! $this->hasColumn('order_column')) {
                //    $table->integer('order_column')->nullable();
                // }
                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
}
