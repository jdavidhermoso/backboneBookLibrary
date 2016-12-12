module.exports = function (grunt) {
  grunt.initConfig({
    sass: {
      dev: {
        files: {
          'app/styles/main.css': 'app/styles/main.scss'
        }
      }
    },
    sasslint: {
      options: {
        configFile: '.sass-lint.yml',
        outputFile: 'app/styles/sass-lint-report.xml'
      },
      target: ['app/styles/**/*.scss']
    },
    copy: {
      css: {
        files: [
          {
            expand: true,
            cwd: 'app/styles',
            src: ['*.css'],
            dest: 'dist/styles'
          }
        ]
      },
      js: {
        files: [
          {
            expand: true, cwd: 'app/scripts', src: ['**/*.js'], dest: 'dist/scripts'
          },
        ]
      },
      images: {
        files: [
          {expand: true, cwd: 'app/images', src: ['**'], dest: 'dist/images'},
        ],
      },
      fonts: {
        files: [
          {expand: true, cwd: 'app/fonts', src: ['**'], dest: 'dist/fonts'},
        ]
      },
      ci: {
        files: [
          {
            expand: true, cwd: 'dist/vendors/codeigniter3/application', src: ['**/**'], dest: 'application',
          },
          {
            expand: true, cwd: 'dist/vendors/codeigniter3/system', src: ['**/**'], dest: 'system',
          },
          {
            expand : true, cwd : 'dist/vendors/codeigniter3/', src: ['index.php'], dest : '../../../'
          }
        ]
      },
      other: {
        files: [
          {
            expand: true,
            cwd: 'app',
            src: ['favicon.ico', 'apple-touch-icon.png', 'robots.txt'],
            dest: 'dist'
          },
        ],
      }
    },
    watch: {
      files: ['app/styles/**/*.scss', 'app/scripts/**/*.js', 'app/index.html'],
      tasks: ['dev']
    },
    jscs: {
      src: "app/scripts/*.js",
      options: {
        config: ".jscsrc",
        fix: false
      }
    },
    jshint: {
      beforeconcat: ['app/scripts/*.js']
    },
    uglify: {
      dist: {
        options: {
          compress: {
            drop_console: true
          }
        },
        files: {
          'dist/scripts/main.min.js': ['app/scripts/*.js']
        }
      }
    },
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-sass-lint');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks("grunt-jscs");
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-clean');

  grunt.registerTask('dev', ['sass', 'copy:css', 'copy:js', 'copy:images', 'copy:fonts', 'copy:other', 'watch']);
  grunt.registerTask('codechecks', ['sasslint', 'jscs', 'jshint']);
  grunt.registerTask('default', ['dev']);
};
