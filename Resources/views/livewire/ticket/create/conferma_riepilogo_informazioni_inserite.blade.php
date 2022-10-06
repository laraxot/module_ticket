<div>
    <main>
        <div class="container" id="main-container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <x-breadcrumb.rows :rows="$_theme->getLinksBreadcrumbs()">
                    </x-breadcrumb.rows>

                    <x-heading type="heading" {{-- title="Segnalazionedisservizio" --}}>
                        <x-slot name="title">Segnalazione disservizio</x-slot>
                    </x-heading>
                </div>

                <div class="col-12">
                    {{-- <x-info type="progress" step-list=step-list.disservizio-step-3 step-num="3" step-title="Riepilogo"
                        step-tot="3">
                    </x-info> --}}

                    <x-info.rows type="progress" :rows="$_theme->getDisservizioStep3()">
                        <x-slot name="step_title">Riepilogo</x-slot>
                        <x-slot name="step_num">3</x-slot>
                        <x-slot name="step_tot">3</x-slot>
                    </x-info.rows>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">

                    <x-callout type="cmp">
                        <x-slot name="calloutType">warning</x-slot>
                        <x-slot name="icon">it-horn</x-slot>
                        <x-slot name="title">Attenzione</x-slot>
                        <x-slot name="txt">Le informazioni che hai fornito hanno valore di dichiarazione.<span
                                class='d-lg-block'> Verifica
                                che siano corrette.</span></x-slot>
                        <x-slot name="textClass">titillium text-paragraph</x-slot>
                    </x-callout>

                    {{-- <x-callout calloutType="warning" icon="it-horn" calloutTitle="Attenzione"
                        calloutText="Le informazioni che hai fornito hanno valore di dichiarazione.<span class='d-lg-block'> Verifica che siano corrette.</span>"
                        textClass="titillium text-paragraph"></x-callout> --}}

                    <h2 class="title-xxlarge mb-4 mt-40">Segnalazione</h2>

                    <x-card type="content_box" class="mb-0" bg_grey=true header_m0=true h3_title=true h3_class="mb-4"
                        margin_class="mb-4">
                        <x-slot name="title">Disservizio</x-slot>

                        <x-info.rows type="summary" :rows="$_theme->getDisservizioInfoList()" class="p-3 p-lg-4" info=true header_class="pb-2">
                        </x-info.rows>


                        {{-- <x-info-summary class="p-3 p-lg-4" header-class="pb-2" info=true info-list=disservizio-info.list>
                        </x-info-summary> --}}
                    </x-card>

                    <h2 class="title-xxlarge mb-4 mt-40">Dati Generali</h2>

                    <x-card type="content_box" class="mb-0" bg_grey=true header_m0=true h3_title=true h3_class="mb-4"
                        margin_class="mb-4">
                        <x-slot name="title">Autore della segnalazione</x-slot>

                        <x-info.rows type="summary-no-modify" :rows="$_theme->getDisservizioInfoAuthor()" class="mb-4 mb-lg-30 p-3 p-lg-4" info=true disservizio_page=true>
                            <x-slot name="title">Giulia Bianchi</x-slot>
                        </x-info.rows>

                        <x-info.rows type="summary-no-modify" :rows="$_theme->getDisservizioInfoContacts()" class="p-3 p-lg-4" info=true disservizio_page=true>
                            <x-slot name="title">Contatti</x-slot>
                        </x-info.rows>

                    </x-card>

                    <x-nav type="steps" next="true" modalId="modal-terms" saveBtn="true">
                        {{-- <x-slot name="next">true</x-slot>
                        <x-slot name="modalId">modal-terms</x-slot>
                        <x-slot name="saveBtn">true</x-slot> --}}
                        <x-slot name="aria-label-save">di segnalazione disservizio</x-slot>
                    </x-nav>
                    <button type="button" wire:click="previous()" class="btn btn-primary">
                        Indietro
                    </button>
                </div>
            </div>
        </div>
        {{-- </div> --}}

        <div class="bg-grey-card shadow-contacts">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 offset-lg-3 p-contacts">
                        <x-contacts>
                        </x-contacts>
                    </div>
                </div>
            </div>
        </div>

        {{-- <x-modal type="terms_and_conditions"></x-modal> --}}
    </main>
</div>
