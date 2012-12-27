<?php
/*
Plugin Name: Themeists GarlicJS for WordPress
Plugin URI: #
Description: This plugin loads garlic.js in the admin. GarlicJS allows you to automatically persist your forms' field values locally until the form is submitted. This way you don't lose any precious data if you accidentally close your tab or browser. This currently only works for the 'Text' (html) editor and not the 'Visual' (wysiwyg) editor.
Version: 1.0
Author: Themeists
Author URI: #
License: GPL2
*/

if( !class_exists( 'ThemeistsGarlicJSForWP' ) ):


	/**
	 * Simply loads GarlicJS on the Add new post/page screens 
	 *
	 * @author Richard Tape
	 * @package ThemeistsGarlicJSForWP
	 * @since 1.0
	 */
	
	class ThemeistsGarlicJSForWP
	{


		/**
		 * We might not be using a themeists theme (which means we can't add anything to the options panel). By default,
		 * we'll say we are not. We check if the theme's author is Themeists to set this to true during instantiation.
		 *
		 * @author Richard Tape
		 * @package ThemeistsGarlicJSForWP
		 * @since 1.0
		 */
		
		var $using_themeists_theme = false;
		

		/**
		 * Initialise ourselves and do a bit of setup
		 *
		 * @author Richard Tape
		 * @package ThemeistsGarlicJSForWP
		 * @since 1.0
		 * @param None
		 * @return None
		 */

		function ThemeistsGarlicJSForWP()
		{

			$theme_data = wp_get_theme();
			$theme_author = $theme_data->display( 'Author', false );

			if( strtolower( trim( $theme_author ) ) == "themeists" )
				$this->using_themeists_theme = true;


			if( $this->using_themeists_theme )
			{

				//Nothing for now, might be something in pro version
				do_action( 'themeistsgarlicjsforwp_using_themeists_theme' );

			}

			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_scripts' ) );

		}/* ThemeistsGarlicJSForWP() */


		
		/**
		 * 
		 *
		 * @author Richard Tape
		 * @package Chemistry
		 * @since 0.7
		 * @param (string) $hook - the page name in the admin that we're on
		 * @return (none) but enqueues scripts
		 */
		
		function admin_enqueue_scripts( $hook )
		{

			//We only want to load garlic (and our script) on specific pages. Let's make sure we
			//do that by leveraging $hook which is:
			//post-new.php on the add new post screen (and add new page/cpt)

			if( is_admin() && ( $hook == "post-new.php" ) )
			{


				//This plugin dir (I test locally using symlinks, so can't use plugins_url() )
				$this_dir = WP_PLUGIN_URL . '/' . basename( __DIR__ ) . '/';

				//enqueue our scripts
				wp_enqueue_script( 'themeists_garlic', $this_dir . 'assets/js/themeists_garlicjsforwp.js', array( 'jquery' ) );

				wp_enqueue_script( 'garlicjs', $this_dir . 'assets/js/garlic.min.js', array( 'jquery', 'themeists_garlic' ) );

			}

		}/* admin_enqueue_scripts */
		

		
	}/* class ThemeistsGarlicJSForWP */

endif;


//And so it begins
$themeists_garlicjsforwp = new ThemeistsGarlicJSForWP;