var Encore = require('@symfony/webpack-encore');

// Module build configuration
Encore
    .setOutputPath('modules/mod_bpslider/assets')
    .setPublicPath('/modules/mod_bpslider/assets/')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableVersioning(Encore.isProduction())
    .disableSingleRuntimeChunk()
    .enableSourceMaps(!Encore.isProduction())
    .configureBabel(function (babelConfig) {
    }, {
        include_node_modules: ['swiper', 'dom7', 'ssr-window'],
    })
    .addExternals({
        jquery: 'jQuery'
    })
    .addEntry('module', [
        './modules/mod_bpslider/.dev/js/module.js'
    ])
    .configureFilenames({
        css: '[name]-[hash:6].css',
        js: '[name]-[hash:6].js'
    });

// Export configurations
module.exports = Encore.getWebpackConfig();