'use strict';
 
 
module.exports = function(grunt) {
 
    grunt.initConfig({
        concat: {
            css: {
                src: [
                    'css/fontawesome-min.css'
                    ,'css/bootstrap.min.css'
                    ,'css/xsIcon.css'
                    ,'css/iconmoon.css'
                    ,'css/isotope.css'
                    ,'css/magnific-popup.css'
                    ,'css/owl.carousel.min.css'
                    ,'css/owl.theme.default.min.css'
                    ,'css/navigation.css'
                    ,'css/animate.css'
                    ,'css/style.css'
                    ,'css/responsive.css'
                ],
                dest: 'main-css/main.css'
              },
 
            js: {
                src: [
                    'js/jquery-3.2.1.min.js'
                    ,'jquery.lazy-master/jquery.lazy.min.js'
                    ,'js/bootstrap.min.js'
                    ,'js/jquery-mixtub.js'
                    ,'js/jquery.magnific-popup.min.js'
                    ,'js/owl.carousel.min.js'
                    ,'js/navigation.js'
                    ,'js/jquery.appear.min.js'
                    ,'js/isotope.js'
                    ,'js/wow.min.js'
                    ,'js/main.js'
            ],
                dest: 'main-js/main.js'
              }
            },
        uglify: {
            js: {
                src: 'main-js/main.js',
                dest: 'build/main.min.js'
                }
            },
        cssmin: {
            options: {
                sourceMap: true
            },
            css: {
                src: 'main-css/main.css',
                dest: 'build/main.min.css'
                }
            },
        browserSync: {
            dev: {
                bsFiles: {
                    src : [
                        'css/*.css'
                        ,'js/*.js'
                        ,'**/*.php'

                    ]
                },
                options: {
                    watchTask: true
                    //,server: './'
                    ,proxy: 'globe-bank-2.localhost'
                }
            }
        },
        watch: {
            sass: {
                files: ['css/*.css'],
                tasks: ['concat','cssmin'],
                options: {
                    livereload: 35729
                },
            },
            js: {
                files: ['js/*.js'],
                tasks: ['concat','uglify'],
                options: {
                    livereload: 35729
                },
            },
            php: {
                files: ['**/*.php'],
                options: {
                    livereload: 35729
                },
            },
            options: {
                style: 'expanded',
                compass: true,
            },
        }
    });
 
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-browser-sync');
    grunt.registerTask('default', ['concat', 'uglify', 'cssmin', 'browserSync', 'watch']);
};