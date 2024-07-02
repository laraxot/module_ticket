<?php
declare(strict_types=1);

namespace Modules\Ticket\Filament\Widgets;

use Filament\Forms;
use Illuminate\Support\Str;
use Filament\Widgets\Widget;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class LocationFormWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static ?string $heading = 'Location Map';

    protected static string $view = 'ticket::filament.widgets.location-form';
    public float $lat=0;
    public float $lng=0;
    public ?int $err_code=null;
    public ?string $err_message=null;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Card::make()->schema([
                Forms\Components\TextInput::make('Title')
                    ->maxLength(256),
                Forms\Components\RichEditor::make('content')

            ])
        ];
    }
}