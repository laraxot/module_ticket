@extends('pub_theme::layouts.app', ['title' => 'Elenco segnalazioni - Nome del Comune'])
@section('content')
    <main>
        <div class="container" id="main-container">
            <div class="row justify-content-center mb-md-40 mb-lg-80">
                <div class="col-12 col-lg-10">
                    <x-breadcrumb type="v2" :rows="collect([])">
                    </x-breadcrumb>
                    <x-heading type="heading">
                        <x-slot name="title">Elenco segnalazioni</x-slot>
                        <x-slot name="subTitle">Negli ultimi 12 mesi sono state risolte 73 segnalazioni.</x-slot>
                        <x-slot name="heading-p0">true</x-slot>
                    </x-heading>
                </div>
                <hr class="d-none d-lg-block mt-30 mb-2">
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-3 d-none d-lg-block">
                    {{-- <x-category.lists></x-category-list> --}}
                    <x-list.rows type="category" :rows="$_theme->getDisserviziCategories()"></x-list.rows>
                </div>
                <div class="col-lg-8 offset-lg-1">
                    <div class="d-flex justify-content-between border-bottom border-light pb-3 mt-5">
                        <span class="search-results">645 Risultati</span>

                        <x-button label="Filtra" label-class="t-primary title-xsmall-semi-bold ms-1" iconBtn="it-funnel"
                            class="p-0 pe-2 d-lg-none" xs=true modalId="modal-categories"></x-button>
                        <x-button label="Rimuovi tutti i filtri" label-class="title-xsmall-semi-bold ms-1"
                            class="p-0 pe-2 d-none d-lg-block" xs=true></x-button>
                    </div>

                    <ul class="nav nav-tabs w-100 flex-nowrap border-bottom border-light mb-40 mt-3 shadow-none"
                        id="tabDisservizio" role="tablist">
                        <li class="nav-item w-100" role="tab">
                            <a class="nav-link active title-medium-semi-bold pt-0" href="#data-ex-disservizio1"
                                aria-current="page" data-bs-toggle="tab" role="button" aria-controls="disservizio1"
                                aria-selected="true">
                                Mappa
                            </a>
                        </li>
                        <li class="nav-item w-100" role="tab">
                            <a class="nav-link title-medium-semi-bold pt-0" href="#data-ex-disservizio2" aria-current="page"
                                data-bs-toggle="tab" role="button" aria-controls="disservizio2" aria-selected="true">
                                Elenco
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="data-ex-disservizio1" role="tabpanel">
                            <div class="row">
                                <div class="col-12">
                                    {{--                                    <x-map></x-map> --}}
                                </div>
                                <div class="col-lg-6 mt-50 mb-4 mb-lg-0">
                                    <x-button>
                                        <x-button type="label" cardTitle="Fai una segnalazione"
                                            cardDescription="Se vuoi aggiungere una segnalazione, puoi farlo dopo esserti autenticato con le tue
                  credenziali SPID o CIE."
                                            subtitle-class="mt-3" disservizioBtn=true></x-button>
                                        <x-button type="text" label="Segnala disservizio" modalId="modal-disservizio"
                                            class="btn btn-primary mobile-full py-3 mt-2 mb-4 mb-lg-0"></x-button>
                                    </x-button>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="data-ex-disservizio2" role="tabpanel">
                            <div class="row">
                                <x-card type="content_box">
                                    <x-slot name="bs_grey">true</x-slot>
                                    <x-slot name="margin_class">mb-4 mb-lg-30</x-slot>

                                    <x-card type="info-button">
                                        <x-slot name="medium_title">Buca in via Solferino</x-slot>
                                        <x-slot name="label_2">Tipologia di segnalazione <br>
                                            <span>Verde pubblico e arredo urbano</span>
                                        </x-slot>
                                        <x-slot name="show_more_disservizio">true</x-slot>
                                        <x-slot name="collapse_class">pb-0</x-slot>
                                        <x-slot name="collapse_id">collapse1</x-slot>
                                        <x-slot name="info">true</x-slot>
                                    </x-card>
                                </x-card>

                                <x-card type="content_box">
                                    <x-slot name="bg_grey">true</x-slot>
                                    <x-slot name="margin_class">mb-4 mb-lg-30</x-slot>
                                    <x-card type="info_button">
                                        <x-slot name="medium_title">Titolo segnalazione 2</x-slot>
                                        <x-slot name="label_2">ipologia segnalazione</x-slot>
                                        <x-slot name="show_more_disservizio">true</x-slot>
                                        <x-slot name="collapse_id">collapse2</x-slot>
                                        <x-slot name="true"></x-slot>
                                    </x-card>
                                </x-card>


                                <x-card type="content_box">
                                    <x-slot name="bg_grey">true</x-slot>
                                    <x-slot name="margin_class">mb-4 mb-lg-30</x-slot>
                                    <x-card type="info_button">
                                        <x-slot name="medium_title">Titolo segnalazione 3</x-slot>
                                        <x-slot name="label_2">Tipologia segnalazione</x-slot>
                                        <x-slot name="show_more_disservizio">true</x-slot>
                                        <x-slot name="collapse_id">collapse3</x-slot>
                                        <x-slot name="info">true</x-slot>
                                    </x-card>
                                </x-card>
                            </div>
                            <div class="col-12 text-center">
                                <x-button label="Carica altre segnalazioni"
                                    class="btn btn-outline-primary mobile-full py-3 mt-10 mx-auto"></x-button>

                            </div>
                            <div class="col-lg-6 mt-50 mb-4 mb-lg-0">
                                <x-button>
                                    <x-slot name="title">Fai una segnalazione</x-slot>
                                    <x-slot name="txt">Se vuoi aggiungere una segnalazione, puoi farlo dopo esserti
                                        autenticato con le tue
                                        credenziali SPID o CIE.</x-slot>
                                    {{-- subtitle-class="mt-3" disservizioBtn=true --}}>
                                    <x-button type="text" label="Segnala disservizio" modalId="modal-disservizio"
                                        class="btn btn-primary mobile-full py-3 mt-2 mb-4 mb-lg-0"></x-button>
                                </x-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-primary">
            <div class="container">
                <div class="row d-flex justify-content-center bg-primary">
                    <div class="col-12 col-lg-6 p-lg-0 px-3">
                        <x-rating public-template=true></x-rating>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-grey-card shadow-contacts">
            <div class="container">
                <div class="row d-flex justify-content-center p-contacts">
                    <div class="col-12 col-lg-5">
                        <x-card.rows type="contacts" :rows="collect([])">
                        </x-card.rows>
                    </div>
                </div>
            </div>
        </div>


       {{-- <x-modal type="clickMap"></x-modal> --}}
    </main>
@endsection
