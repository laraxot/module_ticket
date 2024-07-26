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
/**
 * ------------------------
 * Pending Moderation - PENDING.
 *
 * Colore: #808080 (Gray)
 * Icona: <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h2l1 2h13l1-2h2" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 14h14l2 4H3l2-4z" /></svg>
 * -----------------------
 * Under Review
 *
 * Colore: #0000FF (Blue)
 * Icona: <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
 * -----------------------
 * Approved
 *
 * Colore: #008000 (Green)
 * Icona: <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4" /></svg>
 * -----------------------
 * Rejected
 *
 * Colore: #FF0000 (Red)
 * Icona: <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
 * -----------------------
 * Publicly Visible
 *
 * Colore: #00FF00 (Light Green)
 * Icona: <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 0110 10v4a10 10 0 01-10 10A10 10 0 012 16v-4a10 10 0 0110-10z" /></svg>
 * -----------------------
 * Reopened
 *
 * Colore: #FFA500 (Orange)
 * Icona: <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m0-4a9 9 0 110 18 9 9 0 010-18z" /></svg>
 * Descrizione dei colori associati
 * Gray (#808080): Stato neutro o di attesa.
 * Blue (#0000FF): Fiducia e serietà, adatto per stati di revisione.
 * Green (#008000): Conferma e approvazione.
 * Red (#FF0000): Errori o stati negativi.
 * Light Green (#00FF00): Pronto e visibile pubblicamente.
 * Orange (#FFA500): Energia e attenzione, utilizzato per stati riaperti.
 */
enum GeoTicketStatusEnum: string implements HasColor, HasIcon, HasLabel
{
    case NEW = 'new';
    case PENDING = 'in_pending';
    case IN_REVIEW = 'in_review';
    case IN_PROGRESS = 'in_progress';
    case ON_HOLD = 'on_hold';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';
    case REOPENED = 'reopened';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::NEW => 'yellow',
            self::PENDING => 'yellow',
            self::IN_REVIEW => 'blue',
            self::IN_PROGRESS => 'orange',
            self::ON_HOLD => 'red',
            self::RESOLVED => 'green',
            self::CLOSED => 'gray',
            self::REOPENED => 'pink',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::NEW => 'heroicon-o-plus-circle',
            self::PENDING => 'heroicon-o-plus-circle',
            self::IN_REVIEW => 'heroicon-o-clock',
            self::IN_PROGRESS => 'heroicon-o-refresh',
            self::ON_HOLD => 'heroicon-o-pause',
            self::RESOLVED => 'heroicon-o-check-circle',
            self::CLOSED => 'heroicon-o-x-circle',
            self::REOPENED => 'heroicon-o-reply',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::NEW => 'New',
            self::PENDING => 'Pending',
            self::IN_REVIEW => 'In Review',
            self::IN_PROGRESS => 'In Progress',
            self::ON_HOLD => 'On Hold',
            self::RESOLVED => 'Resolved',
            self::CLOSED => 'Closed',
            self::REOPENED => 'Reopened',
            // default => 'Unknown',
        };
    }
}
