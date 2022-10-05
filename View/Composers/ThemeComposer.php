<?php

declare(strict_types=1);

namespace Modules\Ticket\View\Composers;

use Illuminate\Support\Arr;

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
          "txt": "Via Solferino - 50100 Firenze (FI)"
        },
        {
          "name": "Tipo di disservizio",
          "txt": "Danneggiamento proprietà pubblica"
        },
        {
          "name": "Titolo",
          "txt": "Panchina danneggiata"
        },
        {
          "name": "Dettagli",
          "txt": "La seduta della panchina risulta inutilizzabile e pericolosa dato che ci sono molte schegge e parti appuntite"
        },
        {
          "name": "Immagini",
          "txt": "6yhakandsahm413d8da.jpg"
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

    public function getDisservizioStep1() {
        $str = '[
        {
          "title": "Autorizzazioni e condizioni",
          "active": true,
          "completed": false
        },
        {
          "title": "Dati di segnalazione",
          "active": false,
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

    public function getDisservizioStep3() {
        $str = '[
        {
          "title": "Autorizzazioni e condizioni",
          "active": false,
          "completed": true
        },
        {
          "title": "Dati di segnalazione",
          "active": false,
          "completed": true
        },
        {
          "title": "Riepilogo",
          "active": true,
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

    public function getLinksBreadcrumbs2() {
        $str = '[
          {
            "link2": "Home"
          },
          {
            "link3": "Area Personale"
          },
        ]';

        return collect(json_decode($str));
    }

    public function segnalazioniDisservizio1() {
        $str = '[
      {
        "item": "A chi è rivolto",
        "anchor": "who-needs"
      },
      {
        "item": "Descrizione",
        "anchor": "description"
      },
      {
        "item": "Come fare",
        "anchor": "how-to"
      },
      {
        "item": "Cosa serve",
        "anchor": "needed"
      },
      {
        "item": "Cosa si ottiene",
        "anchor": "obtain"
      },
      {
        "item": "Costi",
        "anchor": "costs"
      },
      {
        "item": "Accedi al servizio",
        "anchor": "service-access"
      },
      {
        "item": "Condizioni di servizio",
        "anchor": "conditions"
      },
      {
        "item": "Contatti",
        "anchor": "contacts"
      }
    ]';

        return collect(json_decode($str));
    }

  public function getServiziCorrelatiDisservizio() {
      $str = '[
        {
          "icon": "it-settings",
          "link": "Richiesta appuntamento",
          "class": "shadow mb-4"
        }
      ]';

      return collect(json_decode($str));
  }

  public function getSegnalazioneDisservizioAreaPersonaleNavscrollPage1() {
      $str = '[
        {
          "item": "Ultimi messaggi",
          "anchor": "latest-posts"
        },
        {
          "item": "Ultime attività",
          "anchor": "latest-activities"
        }
      ]';

      return collect(json_decode($str));
  }

  public function getDisserviziCategories() {
      $str = '[
      {
        "title": "categoria",
        "list": [
          {
            "name": "category",
            "id": "water",
            "value": "acqua,allagamenti,fogne",
            "label": "Acqua, allagamenti, problemi fognari (21)"
          },
          {
            "name": "category",
            "id": "enviroment",
            "value": "inquinamneto",
            "label": "Ambiente, inquinamento, protezione ambientale (14)"
          },
          {
            "name": "category",
            "id": "street-furniture",
            "value": "arredo-urbano",
            "label": "Arredo urbano (7)"
          },
          {
            "name": "category",
            "id": "rodent-control",
            "value": "derattizazione",
            "label": "Disinfestazione, derattizazione, animali randagi (208)"
          },
          {
            "name": "category",
            "id": "waste",
            "value": "igiene",
            "label": "Igiene urbana, rifiuti, pulizia e decoro (321)"
          },
          {
            "name": "category",
            "id": "maintenance",
            "value": "manutenzione",
            "label": "Manutenzione immobili, edifici pubblici, scuole, barriere architettoniche, cimiteri (302)"
          },
          {
            "name": "category",
            "id": "public-order",
            "value": "ordine-pubblico",
            "label": "Ordine pubblico, disturbo della quiete (302)"
          },
          {
            "name": "category",
            "id": "green",
            "value": "parchi",
            "label": "Parchi e verde pubblico (302)"
          },
          {
            "name": "category",
            "id": "service",
            "value": "servizi",
            "label": "Servizi del comune (302)"
          },
          {
            "name": "category",
            "id": "security",
            "value": "sicurezza",
            "label": "Sicurezza, degrado urbano e sociale (302)"
          },
          {
            "name": "category",
            "id": "road",
            "value": "strade",
            "label": "Strade, marciapiedi, segnaletica e viabilità (302)"
          }
        ]
      }
    ]';

      return collect(json_decode($str));
  }

  public function getSelectOptionList(){
    $str = '[{"text":"Abruzzo","link":"#"},{"text":"Basilicata","link":"#"},{"text":"Calabria","link":"#"},{"text":"Campania","link":"#"},{"text":"Emilia Romagna","link":"#"},{"text":"Friuli Venezia Giulia","link":"#"},{"text":"Lazio","link":"#"},{"text":"Liguria","link":"#"},{"text":"Lombardia","link":"#"},{"text":"Marche","link":"#"},{"text":"Molise","link":"#"},{"text":"Piemonte","link":"#"},{"text":"Puglia","link":"#"},{"text":"Sardegna","link":"#"},{"text":"Sicilia","link":"#"},{"text":"Toscana","link":"#"},{"text":"Trentino Alto Adige","link":"#"},{"text":"Umbria","link":"#"},{"text":"Valle d’Aosta","link":"#"},{"text":"Veneto","link":"#"}]';

    return collect(json_decode($str));
  }

  public function readJson(string $name){
    $tmp = explode('.', $name);
    $content = file_get_contents(__DIR__.'/../../Resources/json/'.$tmp[0].'.json');
    $json=json_decode($content,true);
    $key=implode('.',array_slice($tmp,1));
    
    return Arr::get($json,$key);
    
  }
}
