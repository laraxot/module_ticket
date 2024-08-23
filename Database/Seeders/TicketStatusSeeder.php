<?php

declare(strict_types=1);

namespace Modules\Ticket\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Ticket\Models\TicketStatus;

class TicketStatusSeeder extends Seeder
{
    private array $data = [
        [
            'name' => 'Todo',
            'color' => '#cecece',
            'is_default' => true,
            'order' => 1,
        ],
        [
            'name' => 'In progress',
            'color' => '#ff7f00',
            'is_default' => false,
            'order' => 2,
        ],
        [
            'name' => 'Done',
            'color' => '#008000',
            'is_default' => false,
            'order' => 3,
        ],
        [
            'name' => 'Archived',
            'color' => '#ff0000',
            'is_default' => false,
            'order' => 4,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $item) {
            TicketStatus::firstOrCreate($item);
        }
    }
}
