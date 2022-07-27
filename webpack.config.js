const fs = require('fs');
const Encore = require('@symfony/webpack-encore');

// Create plugins assets build directory
fs.mkdir(__dirname + '/media/mod_bpslider', {recursive: true}, (err) => {
    if (err) throw err;
});

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

// Module build configuration
Encore
    .setOutputPath('media/mod_bpslider')
    .setPublicPath('/media/mod_bpslider/')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSassLoader()
    .enableVersioning(Encore.isProduction())
    .disableSingleRuntimeChunk()
    .enableSourceMaps(!Encore.isProduction())
    .configureBabel(function (babelConfig) {
    }, {
        includeNodeModules: ['swiper', 'dom7', 'ssr-window'],
        useBuiltIns: 'usage',
        corejs: 3
    })
    .addExternals({
        jquery: 'jQuery',
        joomla: 'Joomla',
    })
    .addEntry('module', [
        './.dev/js/module.js',
        './.dev/scss/module.scss',
    ])
    .addStyleEntry('theme', [
        './.dev/scss/theme.scss',
    ])
    .configureFilenames({
        css: '[name]-[contenthash].css',
        js: '[name]-[contenthash].js'
    });

// Export configurations
module.exports = Encore.getWebpackConfig();