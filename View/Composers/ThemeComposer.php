<?php

declare(strict_types=1);

namespace Modules\Ticket\View\Composers;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Modules\Blog\Models\Categorizable;
use Modules\Blog\Models\Category;
use Modules\LU\Services\ProfileService;

class ThemeComposer {
    public function getFullName(): ?string {
        return ProfileService::make()->getUser()->full_name;
    }

    public function getSteps(): Collection {
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

    public function getDisservizioInfoList(array $form_data): Collection {
        $str = '[
        {
          "name": "Indirizzo",
          "txt": "Macante"
        },
        {
          "name": "Tipo di disservizio",
          "txt": "Problema con il sito"
        },
        {
          "name": "Titolo",
          "txt": "'.$form_data['post']['title'].'"
        },
        {
          "name": "Dettagli",
          "txt": "'.$form_data['post']['txt'].'"
        },
        {
          "name": "Immagini",
          "txt": "Immagini non presenti"
        }
      ]';

        return collect((array) json_decode($str));
    }

    public function getDisservizioInfoAuthor(): Collection {
        $str = '[
        {
          "name": "Codice Fiscale",
          "description": "GLABNC72H25H501Y"
        }]';

        return collect(json_decode($str));
    }

    public function getDisservizioInfoContacts(): Collection {
        $authorInfo = ProfileService::make()->getProfile();
        $phone = '';
        $email = '';
        if (! is_null($authorInfo)) {
            if (property_exists($authorInfo, 'phone')) {
                $phone = $authorInfo->phone;
            }
            if (property_exists($authorInfo, 'email')) {
                $email = $authorInfo->email;
            }
        }

        $str = '[
        {
          "name": "Telefono",
          "description": "'.$phone.'"
        },
        {
          "name": "Email",
          "description": "'.$email.'"
        }
      ]';

        return collect((array) json_decode($str));
    }

    public function getBreads(): Collection {
        return collect([]);
    }

    public function getDisservizioStep1(): Collection {
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

    public function getDisservizioStep2(): Collection {
        $str = '[
        {
          "title": "Informativa sulla privacy4",
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

    public function getDisservizioStep3(): Collection {
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

    public function getDisservizioDatiSpecifici(): Collection {
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

    public function getLinksBreadcrumbs(): Collection {
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

    public function getLinksBreadcrumbs2(): Collection {
        $str = '[
          {
            "link2": "Home"
          },
          {
            "link3": "Area Personale"
          },
        ]';

        return collect((array) json_decode($str));
    }

    public function segnalazioniDisservizio1(): Collection {
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

    public function getServiziCorrelatiDisservizio(): Collection {
        $str = '[
        {
          "icon": "it-settings",
          "link": "Richiesta appuntamento",
          "class": "shadow mb-4"
        }
      ]';

        return collect(json_decode($str));
    }

    public function getSegnalazioneDisservizioAreaPersonaleNavscrollPage1(): Collection {
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

    public function getSegnalazioneDisservizioAreaPersonaleNavscrollPage3(): Collection {
        $str = '[
          {
            "item": "Pratiche",
            "anchor": "practices"
          },
          {
            "item": "Pagamenti",
            "anchor": "payments"
          }
      ]';

        return collect(json_decode($str));
    }

    public function getSegnalazioneDisservizioAreaPersonaleAccordionPratiche(): Collection {
        $str = '[
        {
          "num": "1",
          "title": "Iscrizione scuola d’infanzia",
          "date": "15/02/2022",
          "icon": "folder-incomplete.svg",
          "icon_label": "Da completare",
          "color": "u-main-alert",
          "warning-icon": true,
          "label-tag": "Servizio non digitale",
          "practice": "Pratica:",
          "practice_number": "AN4059281",
          "btn-label": "Perfeziona la richiesta",
          "collapse": [
            {
              "icon": "it-clip",
              "aria-label": "Scarica la",
              "link": "Ricevuta richiesta",
              "class": "shadow p-0"
            },
            {
              "icon": "it-clip",
              "aria-label": "Scarica la",
              "link": "Graduatoria",
              "class": "shadow p-0"
            }
          ]
        },
        {
          "num": "2",
          "title": "Richiesta assegno maternità",
          "date": "24/06/2021",
          "icon": "folder-concluded.svg",
          "icon_label": "Conclusa",
          "label-tag": "Servizio non digitale",
          "practice": "Pratica:",
          "practice_number": "AN4059281",
          "collapse": [
            {
              "icon": "it-clip",
              "link": "Ricevuta richiesta",
              "class": "shadow p-0"
            },
            {
              "icon": "it-clip",
              "aria-label": "Scarica la",
              "link": "Graduatoria",
              "class": "shadow p-0"
            },
            {
              "icon": "it-clip",
              "aria-label": "Scarica la",
              "link": "Ricevuta richiesta",
              "class": "shadow p-0"
            }
          ]
        },
        {
          "num": "3",
          "title": "Iscrizione corso di formazione",
          "date": "24/06/2021",
          "icon": "folder-concluded.svg",
          "icon_label": "Conclusa",
          "label-tag": "Servizio non digitale",
          "practice": "Pratica:",
          "practice_number": "AN4059281",
          "collapse": [
            {
              "icon": "it-clip",
              "link": "Ricevuta richiesta",
              "class": "shadow p-0"
            },
            {
              "icon": "it-clip",
              "aria-label": "Scarica la",
              "link": "Graduatoria",
              "class": "shadow p-0"
            },
            {
              "icon": "it-clip",
              "aria-label": "Scarica la",
              "link": "Ricevuta richiesta",
              "class": "shadow p-0"
            }
          ]
        },
        {
          "num": "4",
          "title": "Richiesta permesso ZTL",
          "date": "10/05/2021",
          "icon": "folder-concluded.svg",
          "icon_label": "Conclusa",
          "label-tag": "Servizio non digitale",
          "practice": "Pratica:",
          "practice_number": "AN4059281",
          "collapse": [
            {
              "icon": "it-clip",
              "aria-label": "Scarica la",
              "link": "Ricevuta richiesta",
              "class": "shadow p-0"
            },
            {
              "icon": "it-clip",
              "aria-label": "Scarica la",
              "link": "Graduatoria",
              "class": "shadow p-0"
            },
            {
              "icon": "it-clip",
              "aria-label": "Scarica la",
              "link": "Ricevuta richiesta",
              "class": "shadow p-0"
            }
          ]
        },
        {
          "num": "5",
          "title": "Richiesta parcheggio residenti",
          "date": "06/03/2021",
          "icon": "folder-concluded.svg",
          "icon_label": "Conclusa",
          "label-tag": "Servizio non digitale",
          "practice": "Pratica:",
          "practice_number": "AN4059281",
          "collapse": [
            {
              "icon": "it-clip",
              "aria-label": "Scarica la",
              "link": "Ricevuta richiesta",
              "class": "shadow p-0"
            },
            {
              "icon": "it-clip",
              "aria-label": "Scarica la",
              "link": "Graduatoria",
              "class": "shadow p-0"
            },
            {
              "icon": "it-clip",
              "aria-label": "Scarica la",
              "link": "Ricevuta richiesta",
              "class": "shadow p-0"
            }
          ]
        }
      ]';

        return collect(json_decode($str));
    }

    public function getSegnalazioneDisservizioAreaPersonaleAccordionPagamenti(): Collection {
        $str = '[
            {
              "num": "5",
              "title": "Pagamento contravvenzione",
              "date": "01/10/2021",
              "icon": "folder-pay.svg",
              "icon_label": "Pagato",
              "label-tag":"Servizio non digitale",
              "btn-label":"Perfeziona la richiesta",
              "practice":"Pratica:",
              "practice_number":"AN4059281",
              "collapse": [
                {
                  "icon": "it-clip",
                  "link": "Ricevuta pagamento (PDF 80KB)",
                  "aria-label":"Scarica la",
                  "class": "shadow mt-3"
                }
              ]
            },
            {
              "num": "6",
              "title": "Pagamento contravvenzione",
              "date": "24/06/2021",
              "icon": "folder-pay.svg",
              "icon_label": "Pagato",
              "label-tag":"Servizio non digitale",
              "btn-label":"Perfeziona la richiesta",
              "practice":"Pratica:",
              "practice_number":"AN4059281",
              "collapse": [
                {
                  "icon": "it-clip",
                  "link": "Ricevuta pagamento (PDF 80KB)",
                  "aria-label":"Scarica la",
                  "class": "shadow mt-3"
                }
              ]
            },
            {
              "num": "7",
              "title": "Pagamento contravvenzione",
              "date": "10/05/2021",
              "icon": "folder-pay.svg",
              "icon_label": "Pagato",
              "label-tag":"Servizio non digitale",
              "btn-label":"Perfeziona la richiesta",
              "practice":"Pratica:",
              "practice_number":"AN4059281",
              "collapse": [
                {
                  "icon": "it-clip",
                  "link": "Ricevuta pagamento (PDF 80KB)",
                  "aria-label":"Scarica la",
                  "class": "shadow mt-3"
                }
              ]
            },
            {
              "num": "8",
              "title": "Pagamento contravvenzione",
              "date": "06/03/2021",
              "icon": "folder-pay.svg",
              "icon_label": "Pagato",
              "label-tag":"Servizio non digitale",
              "btn-label":"Perfeziona la richiesta",
              "practice":"Pratica:",
              "practice_number":"AN4059281",
              "collapse": [
                {
                  "icon": "it-clip",
                  "link": "Ricevuta pagamento (PDF 80KB)",
                  "aria-label":"Scarica la",
                  "class": "shadow mt-3"
                }
              ]
            }
      ]';

        return collect(json_decode($str));
    }

    public function getDisserviziCategories(): Collection {
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

    public function getSelectOptionList(): Collection {
        $str = '[{"text":"Abruzzo","link":"#"},{"text":"Basilicata","link":"#"},{"text":"Calabria","link":"#"},{"text":"Campania","link":"#"},{"text":"Emilia Romagna","link":"#"},{"text":"Friuli Venezia Giulia","link":"#"},{"text":"Lazio","link":"#"},{"text":"Liguria","link":"#"},{"text":"Lombardia","link":"#"},{"text":"Marche","link":"#"},{"text":"Molise","link":"#"},{"text":"Piemonte","link":"#"},{"text":"Puglia","link":"#"},{"text":"Sardegna","link":"#"},{"text":"Sicilia","link":"#"},{"text":"Toscana","link":"#"},{"text":"Trentino Alto Adige","link":"#"},{"text":"Umbria","link":"#"},{"text":"Valle d’Aosta","link":"#"},{"text":"Veneto","link":"#"}]';

        return collect(json_decode($str));
    }

    public function readJson(string $name): array {
        $tmp = explode('.', $name);
        $content = file_get_contents(__DIR__.'/../../Resources/json/'.$tmp[0].'.json');
        $json = (array) json_decode((string) $content, true);
        $key = implode('.', array_slice($tmp, 1));

        return (array) Arr::get($json, $key);
    }

    public function getTicketCategories(): Collection {
        $res = Category::ofType('ticket')->get();

        $fillable = app(Category::class)->getFillable();
        if ($res->count() < 1) {
            $ticketCategories = config('ticket.categories');

            if (is_array($ticketCategories)) {
                foreach ($ticketCategories as $v) {
                    $cat = Category::firstOrCreate($v);
                    Categorizable::firstOrCreate(['category_id' => $cat->id, 'categorizable_type' => 'ticket']);
                }
            }
        }

        return $res;
    }
}
