<?php

declare(strict_types=1);

namespace Modules\Ticket\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Ticket\Models\TicketPriority;

class TicketPrioritySeeder extends Seeder
{
    private array $data = [
        [
            'name' => 'Low',
            'color' => '#008000',
            'is_default' => false,
        ],
        [
            'name' => 'Normal',
            'color' => '#CECECE',
            'is_default' => true,
        ],
        [
            'name' => 'High',
            'color' => '#ff0000',
            'is_default' => false,
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
            TicketPriority::firstOrCreate($item);
        }
    }
}
