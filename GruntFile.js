/**
 * Grunt Module
 */
 module.exports = function(grunt) {

    'use strict';

    /**
     * Configuration
     */
     grunt.initConfig({

        /**
         * Get package meta data
         */
         pkg: grunt.file.readJSON('package.json'),

        /**
        * Set project object
        */
        project: {
            app: 'public',
            assets: '<%= project.app %>/assets',
            src: '<%= project.assets %>/src',
            css: [
            '<%= project.src %>/scss/main.scss'
            ],
            js: [
            '<%= project.src %>/js/*.js'
            ]
        },

        /**
        * Sass
        */
        sass: {
            dev: {
                options: {
                    style: 'expanded',
                    compass: false
                },
                files: {
                    '<%= project.assets %>/css/style.css': '<%= project.css %>'
                }
            },
            dist: {
                options: {
                    style: 'compressed',
                    compass: false
                },
                files: {
                    '<%= project.assets %>/css/style.css': '<%= project.css %>'
                }
            }
        },

        /**
        * Watch
        */
        watch: {
            sass: {
            files: '<%= project.src %>/scss/{,*/}*.{scss,sass}',
            tasks: ['sass:dev']
            }
        }
    });

    require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);

    /**
     * Default task
     * Run `grunt` on the command line
     */
    grunt.registerTask('default', [
      'sass:dev',
      'watch'
    ]);

};