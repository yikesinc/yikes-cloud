'use strict';
module.exports = function(grunt) {

    grunt.initConfig({
	
        // js minification
        uglify: {
            dist: {
                files: {
					// scripts
                    'inc/js/yikes-theme-scripts.min.js': [ // theme specific script
                        'inc/js/navigation.js' , 'inc/js/skip-link-focus-fix.js' , 'inc/js/a11y.js'
                    ],
					 'inc/js/customizer.min.js': [ // customizer specific script
                        'inc/js/customizer.js'
                    ],
                }
            }
        },

		sass: {                                // Task
			dist: {                            // Target
				options: {                     // Target options
					style: 'expanded'
				},
				files: {                       // Dictionary of files
					'style.css': 'style.scss', // 'destination': 'source'
					'style-editor.css' : 'style-editor.scss',
				}
			}
		},
		
		// css minify contents of our directory and add .min.css extension
		cssmin: {
			target: {
				files: {
					'style.min.css': ['style.css'],
					'style-editor.min.css': ['style-editor.css']
				}
			}
		},

        // watch our project for changes
       watch: {
			admin_css: { // admin css
				files: 'style.scss',
				tasks: ['postcss','sass','cssmin'],
				options: {
					spawn:false,
					event:['all']
				},
			},
			sass_partials: { // sass partials
				files: 'partials/*.scss',
				tasks: ['sass','cssmin'],
				options: {
					spawn:false,
					event:['all']
				},
			},
			sass_mixins: { // sass partial mixins
				files: 'partials/mixins/*.scss',
				tasks: ['sass','cssmin'],
				options: {
					spawn:false,
					event:['all']
				},
			},
			editor_css: {
				files: 'style-editor.scss',
				tasks: ['postcss','sass','cssmin'],
				options: {
					spawn:false,
					event:['all']
				},
			},
			general_js: {
				files: 'inc/js/*.js',
				tasks: ['uglify'],
				options: {
					spawn:false,
					event:['all']
				},
			},
		},
		
		// Browser Sync
		/* Optional -- http://www.browsersync.io/docs/grunt/ */
		browserSync: {
			bsFiles: {
				src : [ 'style.min.css' ],
			},
			options: {
				proxy: "localhost/mc_free/",
				watchTask : true
			}
		},

		
		// Autoprefixer for our CSS files
		postcss: {
			options: {
                map: true,
                processors: [
                    require('autoprefixer-core')({
                        browsers: ['last 2 versions']
                    })
                ]
            },
			dist: {
			  src: [ 'style*.css' ]
			}
		},
		  		
    });

    // load tasks
    grunt.loadNpmTasks('grunt-contrib-uglify-es');
	grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-browser-sync'); // browser-sync auto refresh
	grunt.loadNpmTasks('grunt-postcss'); // CSS autoprefixer plugin (cross-browser auto pre-fixes)

    // register task
    grunt.registerTask('default', [
		'uglify',
		'sass',
        'cssmin',
		'postcss',
		'browserSync',
        'watch',
    ]);

};