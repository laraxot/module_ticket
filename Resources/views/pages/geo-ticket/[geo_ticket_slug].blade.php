<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {!! $_theme->metatags() !!}
    <!-- Used to add dark mode right away, adding here prevents any flicker -->
    <script>
        if (typeof(Storage) !== "undefined") {
            if(localStorage.getItem('dark_mode') && localStorage.getItem('dark_mode') == 'true'){
                document.documentElement.classList.add('dark');
            }
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @filamentStyles
    @vite(['Resources/css/app.css'],'themes/Sixteen/dist')

</head>
<body class="min-h-screen antialiased bg-white dark:bg-gradient-to-b dark:from-gray-950 dark:to-gray-900">
    <div class="max-w-full sm:max-w-lg w-full bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 sm:p-6 mx-auto mt-4 sm:mt-10">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-white mb-4">Ticket #12345</h1>
        <p class="text-gray-600 dark:text-gray-300 mb-4">Questo è un esempio di ticket. Qui puoi inserire la descrizione del problema o della richiesta associata al ticket.</p>

        <div class="mb-4">
            <span class="font-semibold text-gray-800 dark:text-gray-200">Priorità:</span>
            <span class="text-yellow-500 font-medium">Alta</span>
        </div>

        <div class="mb-4">
            <span class="font-semibold text-gray-800 dark:text-gray-200">Stato:</span>
            <span class="text-green-500 font-medium">In corso</span>
        </div>

        <div class="mb-4">
            <span class="font-semibold text-gray-800 dark:text-gray-200">Assegnato a:</span>
            <span class="text-gray-700 dark:text-gray-400">Mario Rossi</span>
        </div>

        <button class="bg-blue-500 text-white font-semibold px-4 py-2 rounded hover:bg-blue-600 mb-6 w-full">
            Risolvi Ticket
        </button>

        <!-- Slider di Immagini -->
        <div>
            <h2 class="text-lg sm:text-xl font-bold text-gray-800 dark:text-white mb-4">Immagini</h2>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="https://via.placeholder.com/300" alt="Immagine 1" class="w-full h-auto object-cover rounded-lg">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://via.placeholder.com/300" alt="Immagine 2" class="w-full h-auto object-cover rounded-lg">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://via.placeholder.com/300" alt="Immagine 3" class="w-full h-auto object-cover rounded-lg">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://via.placeholder.com/300" alt="Immagine 4" class="w-full h-auto object-cover rounded-lg">
                    </div>
                </div>
                <!-- Aggiunta di controlli di navigazione -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <!-- Aggiunta di paginazione -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <livewire:toast />
    @livewire('notifications')
    @filamentScripts
    @vite(['Resources/js/app.js'],'themes/Sixteen/dist')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/cookie-consent/css/cookie-consent.css')}}">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
</body>
</html>
