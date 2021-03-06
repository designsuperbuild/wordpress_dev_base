'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    sass: {
      dev: {
        files: {
          'assets/css/main.min.css':'assets/sass/app.scss'
        }
      },
      options: {
        sourceMap: true,
        outputStyle: 'compressed'
      }
    },
    uglify: {
      dist: {
        files: {
          'assets/js/scripts.min.js': [
            'assets/js/plugins/bootstrap/transition.js',
            'assets/js/plugins/bootstrap/alert.js',
            'assets/js/plugins/bootstrap/button.js',
            'assets/js/plugins/bootstrap/carousel.js',
            'assets/js/plugins/bootstrap/collapse.js',
            'assets/js/plugins/bootstrap/dropdown.js',
            'assets/js/plugins/bootstrap/modal.js',
            'assets/js/plugins/bootstrap/tooltip.js',
            'assets/js/plugins/bootstrap/popover.js',
            'assets/js/plugins/bootstrap/scrollspy.js',
            'assets/js/plugins/bootstrap/tab.js',
            'assets/js/plugins/bootstrap/affix.js',
            'assets/js/plugins/*.js',
            'assets/js/_*.js'
          ]
        },
        options: {
          // JS source map: to enable, uncomment the lines below and update sourceMappingURL based on your install
          // sourceMap: 'assets/js/scripts.min.js.map',
          // sourceMappingURL: '/app/themes/roots/assets/js/scripts.min.js.map'
        }
      }
    },
    version: {
      assets: {
        files: {
          'lib/scripts.php': ['assets/css/main.min.css', 'assets/js/scripts.min.js']
        }
      }
    },
    watch: {
      sass: {
        files: [
          'assets/sass/*.scss',
          'assets/sass/bootstrap/*.scss'
        ],
        tasks: ['clean:compiledCSS','sass', 'version'],
        options: {
          spawn: false,
          livereload: true
        }
      },
      js: {
        files: [
          'Gruntfile.js',
          'assets/js/*.js',
          '!assets/js/*.min.js'
        ],
        tasks: ['clean:compiledJS', 'uglify', 'version'],
        options: {
          spawn: false,
          livereload: true
        }
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: true
        },
        files: [
          'templates/*.php',
          '*.php'
        ]
      }
    },
    clean: {
      dist: [
        'assets/css/main.min.css',
        'assets/js/scripts.min.js'
      ],
      compiledCSS: [
        'assets/css/*.min.css'
      ],
      compiledJS: [
        'assets/js/*.min.js'
      ]
    }
  });

  // Load tasks
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-wp-assets');

  // Register tasks
  grunt.registerTask('default', [
    'clean:dist',
    'sass',
    'uglify',
    'version'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};