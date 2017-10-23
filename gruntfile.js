module.exports = function(grunt) {

grunt.initConfig({
  uglify: {
    my_target: {
      files: [{
        expand: true,
        cwd: 'src/js',
        src: '**/*.js',
        dest: 'dist/js'
      }]
    }
  }
});

  grunt.loadNpmTasks('grunt-contrib-uglify');

  grunt.registerTask('default', ['uglify']);

};
