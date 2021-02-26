var Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

// Module build configuration
Encore
    .setOutputPath('modules/mod_bpslider/assets')
    .setPublicPath('/modules/mod_bpslider/assets/')
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
    .addEntry('theme', [
        './.dev/scss/theme.scss',
    ])
    .configureFilenames({
        css: '[name]-[contenthash].css',
        js: '[name]-[contenthash].js'
    });

// Export configurations
module.exports = Encore.getWebpackConfig();