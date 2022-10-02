<?php

declare(strict_types=1);

namespace Modules\Ticket\View\Composers;

class ThemeComposer {
    public function getSteps() {
        $steps = collect([
            (object) [
                'title' => 'Primo step',
                'completed' => true,
                'active' => true,
            ],
            (object) [
                'title' => 'Secondo step',
                'completed' => false,
                'active' => false,
            ],
            (object) [
                'title' => 'Terzo step',
                'completed' => false,
                'active' => false,
            ],
        ]);

        return $steps;
    }

    public function getDisservizioInfoList() {
        $str = '[
        {
          "name": "Indirizzo",
          "description": "Via Solferino - 50100 Firenze (FI)"
        },
        {
          "name": "Tipo di disservizio",
          "description": "Danneggiamento proprietà pubblica"
        },
        {
          "name": "Titolo",
          "description": "Panchina danneggiata"
        },
        {
          "name": "Dettagli",
          "description": "La seduta della panchina risulta inutilizzabile e pericolosa dato che ci sono molte schegge e parti appuntite"
        },
        {
          "name": "Immagini",
          "description": "6yhakandsahm413d8da.jpg"
        }
      ]';

        return collect(json_decode($str));
    }
}
