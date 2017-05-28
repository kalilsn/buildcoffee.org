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
                files: ['*.php'],
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

        // css minify
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
                "force": true
            },
            all: [
                'Gruntfile.js',
                'assets/js/source/**/*.js'
            ]
        },

        // uglify to concat, minify, and make source maps
        uglify: {
            options: {
                sourceMap: 'assets/js/plugins.js.map',
                sourceMappingURL: 'plugins.js.map',
                sourceMapPrefix: 2
            },
            dev: {
                files: {
                    'assets/js/plugins.min.js': [
                        'assets/js/source/plugins.js',
                        'assets/js/vendor/navigation.js',
                        'assets/js/vendor/skip-link-focus-fix.js',
                        'assets/js/vendor/readmore-js/readmore.js',
                    ],
                    'assets/js/main.min.js': [
                        'assets/js/source/main.js'
                    ]
                }
            },
            dist: {
                options: {
                    compress: {
                        drop_console: true
                    }
                },
                files: {
                    'assets/js/plugins.min.js': [
                        'assets/js/source/plugins.js',
                        'assets/js/vendor/navigation.js',
                        'assets/js/vendor/skip-link-focus-fix.js',
                        'assets/js/vendor/readmore-js/readmore.js',
                    ],
                    'assets/js/main.min.js': [
                        'assets/js/source/main.js'
                    ]
                }
            },
        },

        phpcs: {
            php: {
                src: ['*.php', 'lib/**/*.php']
            },
            options: {
                bin: 'wpcs/vendor/bin/phpcs',
                standard: 'WordPress'
            }
        },

        // deploy via rsync
        rsync: {
            options: {
                src: "./",
                args: ["--verbose"],
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
                recursive: true,
                syncDestIgnoreExcl: true,
                ssh: true
            },
            production: {
                 options: {
                    dest: "/var/www/buildcoffee.org/wp-content/themes/buildcoffee",
                    host: "root@buildcoffee.org"
                }
            },
            dev: {
                options: {
                    dest: "/var/www/dev.buildcoffee.org/wp-content/themes/buildcoffee",
                    host: "root@buildcoffee.org"
                }
            }
        }

    });

    grunt.registerTask('deploy', ['sass', 'autoprefixer', 'cssmin', 'uglify:dist', 'rsync:dev']);
    grunt.registerTask('deploy-production', ['sass', 'autoprefixer', 'cssmin', 'uglify:dist', 'rsync:production']);

    // register task
    grunt.registerTask('default', ['sass', 'autoprefixer', 'cssmin', 'uglify:dev', 'watch']);
};
