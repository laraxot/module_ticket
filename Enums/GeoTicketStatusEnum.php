<?php

declare(strict_types=1);

namespace Modules\Ticket\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

// Nuovo: Il ticket è stato appena creato e non è ancora stato controllato per la visualizzazione.
// In Attesa di Controllo: Il ticket è in attesa di essere controllato prima della visualizzazione.
// Approvato: il ticket è stato approvato per poter essere visualizzato
// Chiuso: Il ticket è stato risolto con successo e chiuso.



// Assegnato: Il ticket è stato assegnato a un responsabile specifico.
// In Lavorazione: Il responsabile sta attualmente lavorando sul ticket.
// In Attesa di Informazioni: Il ticket è in attesa di ulteriori informazioni da parte del richiedente o di terze parti.
// In Attesa di Revisione: Il lavoro sul ticket è completato e in attesa di revisione o approvazione.
// In Attesa di Implementazione: La soluzione è stata trovata e si attende l'implementazione.
// In Test: La soluzione è stata implementata e il ticket è in fase di test.
// Risolto: Il problema segnalato nel ticket è stato risolto.
// Chiuso: Il ticket è stato risolto con successo e chiuso.
// Riaperto: Il ticket, precedentemente chiuso, è stato riaperto per ulteriori azioni.
// Cancellato: Il ticket è stato cancellato e non richiede più azioni.
// Posticipato: L'azione sul ticket è stata posticipata a una data successiva.
// Duplicato: Il ticket è stato identificato come un duplicato di un altro ticket già esistente.

enum GeoTicketStatusEnum: string implements HasColor, HasIcon, HasLabel
{
    case NewTicket = 'new';
    case WaitingForCheck = 'Waiting for Check';
    case Approved = 'Approved';
    case Closed = 'Closed';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::NewTicket => 'success',
            self::WaitingForCheck => 'warning',
            self::Approved => 'danger',
            self::Closed => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::NewTicket => 'heroicon-o-check-circle',
            self::WaitingForCheck => 'heroicon-o-document',
            self::Approved => 'heroicon-o-x-circle',
            self::Closed => 'heroicon-o-x-circle',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::NewTicket => 'New Ticket',
            self::WaitingForCheck => 'Waiting For Check',
            self::Approved => 'Approved',
            self::Closed => 'Closed',
        };
    }
}
