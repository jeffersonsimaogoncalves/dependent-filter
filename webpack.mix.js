let mix = require('laravel-mix')
let path = require('path')

require('./nova.mix')

mix
    .js('resources/js/filter.js', 'dist')
    .vue({ version: 3 })
    .sourceMaps()
    .setPublicPath('dist')
    .alias({
        '@': path.join(__dirname, 'resources/js'),
    })
    .nova('jeffersonsimaogoncalves/dependent-filter')
