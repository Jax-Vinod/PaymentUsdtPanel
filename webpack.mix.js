const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.webpackConfig({
    resolve: {
        alias: {
            'masonry': 'masonry-layout',
            'isotope': 'isotope-layout',
            // custom aliases for easy reference
            'src': path.resolve(__dirname, 'resources/'),
            'resources': path.resolve(__dirname, 'resources/'),
            'components': path.resolve(__dirname, 'resources/components/'),
            'pages': path.resolve(__dirname, 'resources/components/pages/'),
            'img': path.resolve(__dirname, 'resources/img/'),
        }
    },
    // https://github.com/JeffreyWay/laravel-mix/issues/936#issuecomment-331418769
    output: {
        publicPath: '',
        chunkFilename: mix.inProduction() ? 'js/[name].[chunkhash].js' : 'js/[name].js'
    }
});

// Setup Autoprefixer
mix.options({
    postCss: [
        require('autoprefixer')(),
        /**
         * Automatically create rtl css
         * applies styles based on the 'dir' attribute on <html></html>
         * eg: <html dir="ltr"></html>
         * experimental, broken
         */
        // require('postcss-rtl')()
    ]
})

// ===public path
// mix.setPublicPath('public/')


// ===compile our main.js file
mix.js('resources/main.js', 'public/')
    // Add any additional vendor modules that need to be cached
    // remove any unused libraries in the array as they will be included in the vendor bundle
    .extract(['vue', 'bootstrap-vue', 'animejs', 'axios', 'vue-echarts-v3/src/full.js', 'vue2-dropzone'])

Mix.manifest.refresh = () => void 0;

//
// mix.sass('resources/sass/bootstrap/bootstrap.scss', 'public/css');

// mix.js('resources/js/app.js', 'public/js');


// We strongly recommend running vuejs projects on a domain or sub-domain but if you really need to run it in a sub-folder, please change below path
// mix.setResourceRoot('/')

// Disable all OS notifications
// mix.disableNotifications()


// Disable all Success notifications
// mix.disableSuccessNotifications()

