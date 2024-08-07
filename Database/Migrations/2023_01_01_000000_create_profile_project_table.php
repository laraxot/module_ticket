<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Ticket\Models\ProfileProject;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class .
 */
class CreateProfileProjectTable extends XotBaseMigration
{
    protected ?string $model_class = ProfileProject::class;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                $table->string('user_id')->nullable()->index();
                $table->string('profile_id')->nullable()->index();
                $table->foreignId('project_id'); // ->constrained('projects');
                $table->string('role');
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
