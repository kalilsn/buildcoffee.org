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
                tasks: ['jshint', 'babel', 'uglify:dev'],
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

        babel: {
            options: {
                sourceMap: true,
                presets: ['es2015'],
            },
            dist: {
                files: [{
                    expand: true,
                    src: ['assets/js/source/*.js', '!assets/js/source/*.compiled.js'],
                    ext: '.compiled.js',
                }],
            },
        },

        clean: {
            js: ['**/*.compiled.js'],
            css: ['**/*.css.map', 'assets/styles/build/*.css'],
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
                '!assets/js/source/*.compiled.js',
            ]
        },

        // uglify to concat, minify, and make source maps
        uglify: {
            options: {
                sourceMap: 'assets/js/plugins.js.map',
                sourceMappingURL: 'plugins.js.map',
                sourceMapPrefix: 2,
                report: 'gzip',
            },
            dev: {
                files: {
                    'assets/js/plugins.min.js': [
                        'assets/js/vendor/jquery/dist/jquery.min.js',
                        'assets/js/vendor/*.js',
                    ],
                    'assets/js/main.min.js': [
                        'assets/js/source/*.compiled.js',
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
                        'assets/js/source/*.compiled.js',
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

    grunt.registerTask('build', ['clean', 'sass', 'autoprefixer', 'cssmin', 'babel', 'uglify:dist', 'phpcs']);
    grunt.registerTask('deploy', ['build', 'rsync:dev']);
    grunt.registerTask('deploy-production', ['build', 'rsync:production']);

    // register task
    grunt.registerTask('default', ['clean', 'sass', 'autoprefixer', 'cssmin', 'babel', 'uglify:dev', 'watch']);
};
