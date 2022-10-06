<div>
    <main>
        <div class="container" id="main-container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <x-breadcrumb.rows :rows="$_theme->getLinksBreadcrumbs()">
                    </x-breadcrumb.rows>
                    <x-heading type="heading">
                        <x-slot name="title">Segnalazione disservizio</x-slot>
                    </x-heading>
                </div>
                <div class="col-12">
                    <x-info.rows type="progress" :rows="$_theme->getDisservizioStep2()">
                        <x-slot name="step_title">Riepilogo</x-slot>
                        <x-slot name="step_num">2</x-slot>
                        <x-slot name="step_tot">3</x-slot>
                        <x-slot name="class">mb-lg-80</x-slot>
                        <x-slot name="step_title">Dati di segnalazione</x-slot>
                        <x-slot name="subtitle">I campi contraddistinti dal simbolo asterisco sono obbligatori</x-slot>
                        <x-slot name="classSubtitle">mt-40 mb-3</x-slot>
                    </x-info.rows>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-3 d-lg-block mb-4 d-none ">
                    <x-nav.rows type="scroll" :rows="$_theme->getDisservizioDatiSpecifici()" id="one" label="INFORMAZIONI RICHIESTE">
                    </x-nav.rows>
                </div>
                <div class="col-12 col-lg-8 offset-lg-1">
                    <div class="steppers-content" aria-live="polite">
                        <div class="it-page-sections-container">
                            <section class="it-page-section" id="report-place">
                                <x-card type="content_box" class="p-big mb-40" :bg_grey="true">
                                    <x-slot name="header" class="m-0"></x-slot>
                                    <x-slot name="title" class="title-xxlarge mb-1">Luogo</x-slot>
                                    <x-slot name="subtitle">Indica il luogo del disservizio</x-slot>
                                    

                                    {{-- <x-slot name="class">p-big p-lg-4</x-slot>
                                    <x-slot name="bg_grey">true</x-slot>
                                    <x-slot name="h2_class">mb-1</x-slot>
                                    <x-slot name="header_m0">true</x-slot>
                                    <x-slot name="title">Luogo</x-slot>
                                    <x-slot name="subtitle">Indica il luogo del disservizio</x-slot>
                                    <x-slot name="margin_class">mb-40</x-slot> --}}


                                   {{--partials.input.autocomplete--}}
                                   {{-- {{> partials/input-autocomplete/input-autocomplete placeholder="Cerca un luogo*" link=true class="mt-3"}} --}}
                                   {{-- <x-input type="select" type="autocomplete" link=true class="mt-3">
                                        <x-slot name="Cerca">Cerca un luogo*</slot>
                                   </x-input.select> --}}
                                </x-card>
                            </section>


                                
                            <section class="it-page-section" id="report-info">
                                <x-card type="content_box" class="p-big mb-40" :bg_grey="true" :required_icon="true">
                                    <x-slot name="header" class="m-0"></x-slot>
                                    {{-- <x-slot name="class">p-big</x-slot> --}}
                                    {{-- <x-slot name="bg_grey">true</x-slot> --}}
                                    {{-- <x-slot name="h2_class">mb-3</x-slot> --}}
                                    {{-- <x-slot name="header_m0">true</x-slot> --}}
                                    {{-- <x-slot name="required_icon">true</x-slot> --}}
                                    <x-slot name="title" class="mb-3">Disservizio</x-slot>
                                    {{-- <x-slot name="margin_class">mb-40</x-slot> --}}
    {{--
                                    <x-input type="select" name="category_id" placeholder="Tipo di disservizio*"
                                        class="p-md-3 p-lg-4 pb-lg-0" label="Tipo di disservizio*" label_hidden=true
                                        id="inefficiency" selectClass="u-grey-dark" :options="$_theme->readJson('select-option-list.serv-1-disservizio.list')"
                                    >
                                    </x-input>
--}}
                                    <x-input.group type="select" name="category_id" placeholder="Tipo di disservizio*"
                                        class="p-md-3 p-lg-4 pb-lg-0" label="Tipo di disservizio*" label_hidden=true
                                        id="inefficiency" selectClass="u-grey-dark" :options="['a'=>'b']"
                                    >
                                    <x-slot name="name">category_id</x-slot>
                                    <x-slot name="placeholder">Tipo di disservizio*</x-slot>
                                    </x-input>

                                    {{-- {{>partials/select/select
                                        placeholder="Tipo di disservizio*"
                                        class="p-md-3 p-lg-4 pb-lg-0"
                                        select-option-list=serv-1-disservizio.list
                                        label-text="Tipo di disservizio*"
                                        label-hidden=true
                                        id="inefficiency"
                                        selectClass="u-grey-dark"
                                        }} --}}

                                    <div class="text-area-wrapper p-3 px-lg-4 pt-lg-5 pb-lg-0 bg-white">
                                        <x-input type="text" class="mb-0" placeholder="titolo" name="title">
                                            <x-slot name="id">title</x-slot>
                                            <x-slot name="label">Titolo</x-slot>
                                            <x-slot name="required">true</x-slot>
                                            <x-slot name="name">title</x-slot>
                                            <x-slot name="formClass">mb-0</x-slot>
                                        </x-input>
                                    </div>
                                    <x-input type="text" class="m-0 p-3 px-lg-4 pt-lg-5 pb-lg-4 bg-white" placeholder="dettagli" name="details">
                                        <x-slot name="id">details</x-slot>
                                        <x-slot name="placeholder">Dettagli*</x-slot>
                                            <x-slot name="label">pt-lg-5 pb-lg-4 bg-white</x-slot>
                                            <x-slot name="num">2</x-slot>
                                            <x-slot name="name">title</x-slot>
                                            <x-slot name="visible">true</x-slot>
                                        </x-input>

                                        <div class="btn-wrapper px-3 pt-2 pb-3 px-lg-4 pb-lg-4 pt-lg-0 bg-white">
                                            <label class="title-xsmall-bold u-grey-dark pb-2 ms-2">Immagini</label>
                                            <div class="upload-wrapper d-flex justify-content-between align-items-center">
                                                <img src="../assets/images/img-disservizio-thumbnail.png" alt=""
                                                    class=" img" />
                                                <span class="t-primary fw-bold w-100 ms-2">6yhakandsahm413d8.jpg</span>
                                                <a href="#" class="align-self-center"
                                                    aria-label="elimina immagina caricata">
                                                    <svg class="icon icon-primary icon-sm mb-1 ">
                                                        <use
                                                            href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-close">
                                                        </use>
                                                    </svg>
                                                </a>
                                            </div>
                                            <hr>
                                            <x-button label="Carica file" primary=true iconBtn="it-upload" iconWhite=true
                                                sm=true class="w-100 fw-bold" aria-label="Carica file per il disservizio">
                                            </x-button>
                                            <p class="title-xsmall u-grey-dark pt-10 mb-0">Seleziona una o più immagini da
                                                allegare alla
                                                segnalazione</p>
                                        </div>
                                </x-card>
                            </section>


                            <section class="it-page-section" id="report-author">
                                <x-card type="content_box" :bg_grey="true">
                                    <x-slot name="header" class="m-0"></x-slot>
                                    {{-- <x-slot name="h2_class">mb-1</x-slot>
                                    <x-slot name="header_m0">true</x-slot>
                                    <x-slot name="bg_grey">true</x-slot> --}}
                                    <x-slot name="title">Autore della segnalazione</x-slot>
                                    <x-slot name="subtitle">Informazione su di te</x-slot>

                                    <x-card type="info_button">
                                        <x-slot name="big_title">
                                            big-title="Giulia Bianchi</x-slot>
                                        <x-slot name="label_2">Codice
                                            Fiscale <br> <span>GLABNC72H25H501Y</span></x-slot>
                                        <x-slot name="card-class">mt-3</x-slot>
                                        <x-slot name="onlyContact">true</x-slot>
                                        <x-slot name="no_header">true</x-slot>
                                        <x-slot name="show_more_anagrafica">true</x-slot>
                                        <x-slot name="collapse_id">collapse-parents</x-slot>
                                        <x-slot name="collapse_id">modal-documents</x-slot>
                                        <x-slot name="btn_label_text">Modifica</x-slot>
                                    </x-card>
                                </x-card>
                            </section>
                        </div>
                        <x-nav type="steps" :save="true" :saveBtn="true">
                            {{-- <x-slot name="save">true</x-slot> --}}
                            {{-- <x-slot name="saveBtn">true</x-slot> --}}
                            <x-slot name="aria_label_save">di segnalazione disservizio</x-slot>
                        </x-nav>
                        <button type="button" wire:click="previous()" class="btn btn-primary">
                            Indietro
                        </button>
                        <button type="button" wire:click="acconsento()" class="btn btn-primary">
                            Avanti
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="bg-grey-card shadow-contacts">
            <div class="container">
                <div class="row d-flex justify-content-center p-contacts">
                    <div class="col-12 col-lg-5">
                        <x-contacts>
                        </x-contacts>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>
