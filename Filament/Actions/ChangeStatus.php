<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Actions;

use Filament\Tables\Actions\Action;
use Modules\Ticket\Models\GeoTicket;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Modules\Ticket\Actions\ChangeStatus as ActionChangeStatus;
use Modules\Ticket\Enums\GeoTicketStatusEnum;

class ChangeStatus extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->translateLabel()
            ->action(
                function (GeoTicket $record, array $data): void {
                    app(ActionChangeStatus::class)->execute($record, $data['status'], $data['reason']);
                }
            )
            ->form([
                Select::make('status')
                    ->options(GeoTicketStatusEnum::class)
                    ->required(),
                TextInput::make('reason')
                    ->label('Per quale motivo stai modificando lo stato?')
                    ->required()
            ])
            ->label('Change Status')
            // ->icon('heroicon-o-status')
            ->tooltip('Change Status')
            // ->modalDescription('Inserisci la quantità di crediti da aggiungere o sottrarre')
            ->modalHeading('Modifica Status')
            // ->requiresConfirmation()
            ->modalSubmitActionLabel('Modifica')
        ;
    }

    public static function getDefaultName(): ?string
    {
        return 'changeStatus';
    }
}
