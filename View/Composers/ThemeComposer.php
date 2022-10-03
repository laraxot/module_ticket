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

    public function getDisservizioInfoAuthor() {
        $str = '[
        {
          "name": "Codice Fiscale",
          "description": "GLABNC72H25H501Y"
        }]';

        return collect(json_decode($str));
    }

    public function getDisservizioInfoContacts() {
        $str = '[
        {
          "name": "Telefono",
          "description": "+39 331 1234567"
        },
        {
          "name": "Email",
          "description": "giulia.bianchi@gmail.com"
        }
      ]';

        return collect(json_decode($str));
    }

    public function getBreads() {
        return collect([]);
    }

    public function getDisservizioStep2() {
        $str = '[
        {
          "title": "Informativa sulla privacy",
          "active": false,
          "completed": true
        },
        {
          "title": "Dati di segnalazione",
          "active": true,
          "completed": false
        },
        {
          "title": "Riepilogo",
          "active": false,
          "completed": false
        }
      ]';

        return collect(json_decode($str));
    }

    public function getDisservizioDatiSpecifici() {
        $str = '[
        {
          "item": "Luogo",
          "anchor": "report-place"
        },
        {
          "item": "Disservizio",
          "anchor": "report-info"
        },
        {
          "item": "Autore della segnalazione",
          "anchor": "report-author"
        }
      ]';

        return collect(json_decode($str));
    }

    public function getLinksBreadcrumbs() {
        $str = '[
          {
            "title": "Home"
          },
          {
            "title": "Servizi"
          },
          {
            "title": "Segnalazione disservizio"
          }
        ]';

        return collect(json_decode($str));
    }
}
