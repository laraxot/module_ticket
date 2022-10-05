let mix = require('laravel-mix');
const path = require('path');

require('laravel-mix-polyfill');

var public_path = 'Resources/dist';

mix.js('Resources/js/app.js', 'js');

mix.sass('Resources/scss/app.scss', 'css');

// mix.vue({ version: 3 });

//mix.setResourceRoot('../');
mix.setPublicPath(public_path);

//Make jQuery Available to Every Module
mix.autoload({
    jquery: ['$', 'window.jQuery', 'jQuery'], // more than one
    moment: 'moment' // only one
        //tether: ['Tether', 'windows.Tether'],
});

mix.extract();

mix.webpackConfig({
    resolve: {
        modules: [
            path.resolve(__dirname, 'node_modules')
        ]
    },
});

mix.polyfill({
    enabled: true,
    useBuiltIns: "usage",
    targets: { "firefox": "50", "ie": 11 }
});

//With File Versioning
//mix.version();
//Generate JavaScript source maps.
mix.sourceMaps();