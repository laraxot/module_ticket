<?php

declare(strict_types=1);

use Modules\Ticket\Models\Epic;
use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class .
 */
class CreateTicketEpicsTable extends XotBaseMigration
{
    protected ?string $model_class = Epic::class;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                $table->foreignId('parent_id')->nullable()->constrained('epics');
                $table->foreignId('project_id'); // ->constrained('projects');
                $table->string('name');
                $table->date('starts_at');
                $table->date('ends_at');
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
