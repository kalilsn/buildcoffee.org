'use strict';
module.exports = function(grunt) {

    require('load-grunt-tasks')(grunt);

    grunt.initConfig({

        watch: {
            sass: {
                files: ['assets/styles/**/*.{scss,sass}'],
                tasks: ['sass', 'autoprefixer', 'cssmin']
            },
            js: {
                files: '<%= jshint.all %>',
                tasks: ['jshint', 'uglify:dev'],
                options: {
                   livereload: true
                }
            },
            images: {
                files: ['assets/images/**/*.{png,jpg,gif,svg}'],
                options: {
                    livereload: true
                }
            },
            css: {
                files: ['style.css'],
                options: {
                    livereload: true
                }
            },
            php: {
                files: ['**/*.php', '!wpcs/**'],
                options: {
                    livereload: true
                }
            }
        },

        // sass
        sass: {
            dist: {
                options: {
                    style: 'expanded',
                },
                files: {
                    'assets/styles/build/style.css': 'assets/styles/style.scss',
                    'assets/styles/build/editor-style.css': 'assets/styles/editor-style.scss'
                }
            }
        },

        // autoprefixer
        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 9', 'ios 6', 'android 4'],
                map: true
            },
            files: {
                expand: true,
                flatten: true,
                src: 'assets/styles/build/*.css',
                dest: 'assets/styles/build'
            },
        },

        clean: {
            sourceMap: ['**/*.map'],
            js: ['assets/js/*.min.js'],
            css: ['**/*.min.css', 'assets/styles/build/*.css'],
        },

        cssmin: {
            options: {
                keepSpecialComments: 1
            },
            minify: {
                expand: true,
                cwd: 'assets/styles/build',
                src: ['*.css', '!*.min.css'],
                ext: '.css'
            }
        },

        // javascript linting with jshint
        jshint: {
            options: {
                jshintrc: '.jshintrc',
                'force': true
            },
            all: [
                'Gruntfile.js',
                'assets/js/source/*.js',
            ]
        },

        // uglify to concat, minify, and make source maps
        uglify: {
            options: {
                report: 'gzip',
            },
            dev: {
                options: {
                    sourceMap: true,
                },
                files: {
                    'assets/js/plugins.min.js': [
                        'assets/js/vendor/jquery/dist/jquery.min.js',
                        'assets/js/vendor/*.js',
                    ],
                    'assets/js/main.min.js': [
                        'assets/js/source/*.js',
                    ],
                },
            },
            dist: {
                options: {
                    compress: {
                        drop_console: true
                    }
                },
                files: {
                    'assets/js/plugins.min.js': [
                        'assets/js/vendor/jquery/dist/jquery.min.js',
                        'assets/js/vendor/*.js',
                    ],
                    'assets/js/main.min.js': [
                        'assets/js/source/*.js',
                    ],
                },
            },
        },

        phpcs: {
            php: {
                src: ['*.php', 'lib/**/*.php']
            },
            options: {
                bin: 'wpcs/vendor/bin/phpcs',
                standard: 'phpcs.xml',
                extensions: 'php',
                ignore: 'wpcs',
            }
        },

        // deploy via rsync
        rsync: {
            options: {
                src: './',
                args: ['--verbose',],
                exclude: [
                    '.git*',
                    'node_modules',
                    '.sass-cache',
                    'Gruntfile.js',
                    'package.json',
                    '.DS_Store',
                    'README.md',
                    'config.rb',
                    '.jshintrc',
                    'wpcs',
                    '.bowerrc',
                    '.editorconfig',
                    '.jshintrc',
                ],
                delete: true,
                recursive: true,
                ssh: true
            },
            production: {
                 options: {
                    dest: '/var/www/buildcoffee.org/wp-content/themes/buildcoffee',
                    host: 'root@buildcoffee.org'
                }
            },
            dev: {
                options: {
                    dest: '/var/www/dev.buildcoffee.org/wp-content/themes/buildcoffee',
                    host: 'root@buildcoffee.org'
                }
            }
        }

    });

    grunt.registerTask('build', ['clean', 'jshint', 'sass', 'autoprefixer', 'cssmin', 'uglify:dist', 'phpcs']);
    grunt.registerTask('deploy', ['build', 'rsync:dev']);
    grunt.registerTask('deploy-production', ['build', 'rsync:production']);

    // register task
    grunt.registerTask('default', ['clean', 'jshint', 'sass', 'autoprefixer', 'cssmin', 'uglify:dev', 'watch']);
};
