const packageJSON = require('./package.json');
require('colors');

const projectConfig = Object.freeze({
    name: packageJSON.name,
    distDir: `../dist/${packageJSON.name}/`,
    textdomain: packageJSON.textdomain,
    version: packageJSON.version,
    type: 'wp-theme',
});

module.exports = (grunt) => {
    'use strict';

    grunt.initConfig({
        clean: {
            options: { force: true },
            dist: [
                projectConfig.distDir + '/**',
                projectConfig.distDir.replace(/\/$/, '') + '.zip',
                projectConfig.distDir.replace(projectConfig.name + '/', '') + projectConfig.name + '-' + projectConfig.version + '.zip',
            ],
        },

        copy: {
            dist: {
                files: [
                    {
                        expand: true,
                        src: [
                            '**',
                            '!node_modules/**',
                            '!src/**',
                            '!sass/**',
                            '!config/**',
                            '!coverage/**',
                            '!dist/**',
                            '!*.local',
                            '!**/.*',
                            '!Gruntfile.js',
                            '!package.json',
                            '!package-lock.json',
                            '!composer.lock',
                            '!phpcs.xml',
                            '!jsconfig.json',
                            '!vite.config.js',
                            '!vite.config.js.timestamp-*.mjs',
                            '!wp-i18n.json',
                        ],
                        dest: projectConfig.distDir,
                    },
                ],
            },
        },

        compress: {
            dist: {
                options: {
                    force: true,
                    mode: 'zip',
                    archive:
                        projectConfig.distDir.replace(projectConfig.name, '') +
                        projectConfig.name +
                        '-' +
                        projectConfig.version +
                        '.zip',
                },
                expand: true,
                cwd: projectConfig.distDir,
                src: ['**'],
                dest: '../' + projectConfig.name,
            },
        },

        screen: {
            begin: `
Automatic Build Tool
# Project   : ${projectConfig.name}
# Dist      : ${projectConfig.distDir}
# Version   : ${projectConfig.version}`.cyan,

            finish: `
╭─────────────────────────────────────────────────────────────────╮
│                                                                 │
│                      All tasks completed.                       │
│   Built files & Installable zip copied to the dist directory.   │
│                    ~ Automatic Build Tool ~                     │
│                                                                 │
╰─────────────────────────────────────────────────────────────────╯`.green,
        },
    });

    require('load-grunt-tasks')(grunt);

    grunt.registerMultiTask('screen', function () {
        grunt.log.writeln(this.data);
    });

    grunt.registerTask('build', [
        'screen:begin',
        'clean',
        'copy',
        'compress',
        'screen:finish',
    ]);
};
