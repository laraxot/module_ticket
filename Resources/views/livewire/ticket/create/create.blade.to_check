<div>
    <main>
        <div class="container" id="main-container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <x-breadcrumb.rows :rows="$_theme->getLinksBreadcrumbs()">
                    </x-breadcrumb.rows>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <h1 class="title-xxxlarge mb-4">Segnalazione disservizio</h1>
                </div>
                <div class="col-12">
                    <x-info.rows type="progress" :rows="$_theme->getDisservizioStep1()">
                        <x-slot name="step_num">1</x-slot>
                        <x-slot name="step_title">Autorizzazioni e condizioni</x-slot>
                        <x-slot name="step_tot">3</x-slot>
                    </x-info.rows>
                    {{-- {{> cmp-info-progress/cmp-info-progress
                        step-list=step-list.disservizio-step-1
                        step-num="1"
                        step-title="Autorizzazioni e condizioni"
                        step-tot="3"
                        }} --}}
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 pb-40 pb-lg-80">
                    <p class="text-paragraph mb-lg-4">
                        Il Comune di Firenze gestisce i dati personali forniti e liberamente comunicati sulla base
                        dell’articolo 13
                        del Regolamento (UE) 2016/679 General data protection regulation (Gdpr) e degli articoli 13 e
                        successive
                        modifiche e integrazione del decreto legislativo (di seguito d.lgs) 267/2000 (Testo unico enti
                        locali).
                    </p>
                    <p class="text-paragraph mb-0">
                        Per i dettagli sul trattamento dei dati personali consulta l’
                        <a href="#" class="t-primary">informativa sulla privacy1.</a>
                    </p>

                    <div class="form-check mt-4 mb-3 mt-md-40 mb-lg-40">
                        <div class="checkbox-body d-flex align-items-center">
                            <input type="checkbox" id="privacy" name="privacy-field" value="privacy-field">
                            <label class="title-small-semi-bold pt-1" for="privacy">Ho letto e compreso l’informativa sulla
                                privacy3</label>
                        </div>
                    </div>

                    <x-button type="advanced">
                        <x-slot name="label">Avanti</x-slot>
                        <x-slot name="primary">true</x-slot>
                        <x-slot name="class">mobile-full</x-slot>
                    </x-button>


                    {{-- <x-button type="advanced" label="Avanti" class="mobile-full" primary="true">
                    </x-button> --}}


                </div>
            </div>
        </div>

        <div class="bg-grey-card shadow-contacts">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 offset-lg-3 p-contacts">
                        <x-contacts></x-contacts>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>