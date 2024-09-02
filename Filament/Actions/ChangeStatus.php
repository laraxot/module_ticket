<?php

declare(strict_types=1);

namespace Modules\Ticket\Filament\Actions;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use Modules\Ticket\Actions\ChangeStatus as ActionChangeStatus;
use Modules\Ticket\Enums\TicketStatusEnum;
use Modules\Ticket\Models\Ticket;

class ChangeStatus extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->translateLabel()
            ->action(
                function (Ticket $record, array $data): void {
                    app(ActionChangeStatus::class)->execute($record, $data['status'], $data['reason']);
                }
            )
            ->form([
                Select::make('status')
                    ->options(TicketStatusEnum::class)
                    ->required(),
                TextInput::make('reason')
                    ->label('Per quale motivo stai modificando lo stato?')
                    ->helperText('La motivazione verrà visualizzata nel dettaglio del ticket')
                    ->required(),
            ])
            ->label('Change Status')
            ->icon('ui-status')
            ->tooltip('Change Status')
            ->modalHeading('Modifica Status')
            // ->requiresConfirmation()
            ->modalSubmitActionLabel('Modifica');
    }

    public static function getDefaultName(): ?string
    {
        return 'changeStatus';
    }
}
