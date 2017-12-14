module.exports = function(grunt) {
    'use strict';

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        watch: {
            less: {
                // Compiles less files upon saving
                files: ['src/less/*.less'],
                tasks: ['less:development', 'less:production']
            },
            js: {
                // Compile js files upon saving
                files: ['src/js/*.js'],
                tasks: ['js']
            },
            skins: {
                // Compile any skin less files upon saving
                files: ['src/less/skins/*.less'],
                tasks: ['less:skins', 'less:minifiedSkins']
            }
        },

        less: {
            // Development not compressed
            development: {
                files: {
                    // compilation.css  :  source.less
                    'bwnraids/css/AdminLTE.css': 'src/less/AdminLTE.less',
                    // AdminLTE without plugins
                    'bwnraids/css/alt/AdminLTE-without-plugins.css': 'src/less/AdminLTE-without-plugins.less',
                    // Separate plugins
                    'bwnraids/css/alt/AdminLTE-select2.css': 'src/less/select2.less',
                    'bwnraids/css/alt/AdminLTE-fullcalendar.css': 'src/less/fullcalendar.less',
                    'bwnraids/css/alt/AdminLTE-bootstrap-social.css': 'src/less/bootstrap-social.less'
                }
            },
            // Production compressed version
            production: {
                options: {
                    compress: true
                },
                files: {
                    // compilation.css  :  source.less
                    'bwnraids/css/AdminLTE.min.css': 'src/less/AdminLTE.less',
                    // AdminLTE without plugins
                    'bwnraids/css/alt/AdminLTE-without-plugins.min.css': 'src/less/AdminLTE-without-plugins.less',
                    // Separate plugins
                    'bwnraids/css/alt/AdminLTE-select2.min.css': 'src/less/select2.less',
                    'bwnraids/css/alt/AdminLTE-fullcalendar.min.css': 'src/less/fullcalendar.less',
                    'bwnraids/css/alt/AdminLTE-bootstrap-social.min.css': 'src/less/bootstrap-social.less'
                }
            },
            // Non minified skin files
            skins: {
                files: {
                    'bwnraids/css/skins/skin-tdb.css': 'src/less/skins/skin-tdb.less',
                    'bwnraids/css/skins/skin-blue.css': 'src/less/skins/skin-blue.less',
                    'bwnraids/css/skins/skin-black.css': 'src/less/skins/skin-black.less',
                    'bwnraids/css/skins/skin-yellow.css': 'src/less/skins/skin-yellow.less',
                    'bwnraids/css/skins/skin-green.css': 'src/less/skins/skin-green.less',
                    'bwnraids/css/skins/skin-red.css': 'src/less/skins/skin-red.less',
                    'bwnraids/css/skins/skin-purple.css': 'src/less/skins/skin-purple.less',
                    'bwnraids/css/skins/skin-blue-light.css': 'src/less/skins/skin-blue-light.less',
                    'bwnraids/css/skins/skin-black-light.css': 'src/less/skins/skin-black-light.less',
                    'bwnraids/css/skins/skin-yellow-light.css': 'src/less/skins/skin-yellow-light.less',
                    'bwnraids/css/skins/skin-green-light.css': 'src/less/skins/skin-green-light.less',
                    'bwnraids/css/skins/skin-red-light.css': 'src/less/skins/skin-red-light.less',
                    'bwnraids/css/skins/skin-purple-light.css': 'src/less/skins/skin-purple-light.less',
                    'bwnraids/css/skins/_all-skins.css': 'src/less/skins/_all-skins.less'
                }
            },
            // Skins minified
            minifiedSkins: {
                options: {
                    compress: true
                },
                files: {
                    'bwnraids/css/skins/skin-tdb.min.css': 'src/less/skins/skin-tdb.less',
                    'bwnraids/css/skins/skin-blue.min.css': 'src/less/skins/skin-blue.less',
                    'bwnraids/css/skins/skin-black.min.css': 'src/less/skins/skin-black.less',
                    'bwnraids/css/skins/skin-yellow.min.css': 'src/less/skins/skin-yellow.less',
                    'bwnraids/css/skins/skin-green.min.css': 'src/less/skins/skin-green.less',
                    'bwnraids/css/skins/skin-red.min.css': 'src/less/skins/skin-red.less',
                    'bwnraids/css/skins/skin-purple.min.css': 'src/less/skins/skin-purple.less',
                    'bwnraids/css/skins/skin-blue-light.min.css': 'src/less/skins/skin-blue-light.less',
                    'bwnraids/css/skins/skin-black-light.min.css': 'src/less/skins/skin-black-light.less',
                    'bwnraids/css/skins/skin-yellow-light.min.css': 'src/less/skins/skin-yellow-light.less',
                    'bwnraids/css/skins/skin-green-light.min.css': 'src/less/skins/skin-green-light.less',
                    'bwnraids/css/skins/skin-red-light.min.css': 'src/less/skins/skin-red-light.less',
                    'bwnraids/css/skins/skin-purple-light.min.css': 'src/less/skins/skin-purple-light.less',
                    'bwnraids/css/skins/_all-skins.min.css': 'src/less/skins/_all-skins.less'
                }
            }
        },
        // Concatenate JS Files
        concat: {
            options: {
                separator: '\n\n',
            },
            dist: {
                src: [
                    'src/js/*.js'
                ],
                dest: 'bwnraids/js/app.js'
            }
        },

        // Build the documentation files
        includes: {
            build: {
                src: ['*.html'], // Source files
                dest: 'docs/', // Destination directory
                flatten: true,
                cwd: 'src/docs',
                options: {
                    silent: true,
                    includePath: 'docs/include'
                }
            }
        },

        // Optimize images
        image: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'src/img/',
                    src: ['**/*.{png,jpg,gif,svg,jpeg}'],
                    dest: 'bwnraids/img/'
                }]
            }
        },
        // Clean directories
        clean: {
            css: ['bwnraids/css/*'],
            js: ['bwnraids/js/app.js'],
            img: ['bwnraids/img/*'],
        }
    });

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-includes');
    grunt.loadNpmTasks('grunt-image');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-text-replace');

    grunt.registerTask('docs', ['includes']);
    grunt.registerTask('release', ['clean', 'concat', 'less:production', 'less:minifiedSkins', 'image']);

    grunt.registerTask('default', ['clean', 'concat', 'less:development', 'less:skins', 'less:minifiedSkins', 'image']);
};