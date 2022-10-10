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

                            {{-- dddx(false === config('ticket.geo'))--}}
                            @can('geo', $_panel)
                                <section class="it-page-section" id="report-place">

                                    <x-card type="content_box" class="p-big mb-40" :bg_grey="true">
                                        <x-slot name="header" class="m-0"></x-slot>
                                        <x-slot name="title" class="title-xxlarge mb-1">Luogo</x-slot>
                                        <x-slot name="subtitle">Indica il luogo del disservizio</x-slot>

                                        {{-- {{#>cmp-card/cmp-card-content-box
                                        class="p-big p-lg-4"
                                        bg-grey=true
                                        h2-class="mb-1"
                                        header-m0=true
                                        card-title="Luogo"
                                        subtitle="Indica il luogo del disservizio"
                                        margin-class="mb-40"
                                        }} --}}

                                        <x-input.group type="text" name="post.address" id="address"
                                            class="p-big p-lg-4" label="Indirizzo/Luogo">
                                        </x-input.group>

                                        {{-- partials.input.autocomplete --}}
                                        {{-- {{> partials/input-autocomplete/input-autocomplete placeholder="Cerca un luogo*" link=true class="mt-3"}} --}}
                                        {{-- <x-input type="select" type="autocomplete" link=true class="mt-3">
                                        <x-slot name="Cerca">Cerca un luogo*</slot>
                                   </x-input.select> --}}
                                    </x-card>
                                </section>
                            @endcan

                            <section class="it-page-section" id="report-info">
                                <x-card type="content_box" class="p-big mb-40" :bg_grey="true" :required_icon="true">
                                    <x-slot name="header" class="m-0"></x-slot>
                                    <x-slot name="title" class="mb-3">Disservizio</x-slot>


                                    <x-input.group type="text" name="post.category" id="category"
                                        class="p-big p-lg-4" label="Tipo di disservizio">
                                    </x-input.group>

                                    {{-- <div class="text-area-wrapper p-3 px-lg-4 pt-lg-5 pb-lg-0 bg-white"> --}}
                                    <x-input.group type="text" name="post.title" id="title" class="mb-0"
                                        label="Titolo">
                                    </x-input.group>
                                    {{-- {{>partials/input/input type="text" id="title" label="Titolo" required=true name="title"
                                        formClass="mb-0"}} --}}

                                    {{-- </div> --}}

                                    <x-input.group type="textarea" placeholder="Inserire al massimo 200 caratteri"
                                        id="details" :visible="true" name="post.txt"
                                        class="m-0 p-3 px-lg-4 pt-lg-5 pb-lg-4 bg-white" num="2"
                                        label="Dettagli*">
                                    </x-input.group>
                                    {{-- {{>partials/text-area/text-area placeholder="Dettagli*" id="details" visible=true class="m-0 p-3 px-lg-4
                                    pt-lg-5 pb-lg-4 bg-white" num="2" label="Inserire al massimo 200 caratteri"}} --}}


                                    {{-- <x-input.group type="img" name="img_src" class="btn-wrapper px-3 pt-2 pb-3 px-lg-4 pb-lg-4 pt-lg-0 bg-white" placeholder="aaa">
                                        <x-slot name="label" class="title-xsmall-bold u-grey-dark pb-2 ms-2">Immagini</x-slot>
                                    </x-input.group> --}}


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
                                        <x-slot name="big_title">Giulia Bianchi</x-slot>
                                        <x-slot name="label_2">
                                            Codice Fiscale <br>
                                            <span>GLABNC72H25H501Y</span>
                                        </x-slot>
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
