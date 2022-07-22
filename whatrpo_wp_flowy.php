<?php

/*
	Plugin Name: Whatpro Test Flowy
	Description: Plugin Test Flowy.
	Version: 1.0
	Author: Gary
	Author URI: https://github.com/githubigna/
*/


/**
 * Register all actions and filters for the plugin
 *
 * @link       uri
 * @since      1.0.0
 *
 * @package    Whatspro_Flowy
 * @subpackage Whatspro_Flowy/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Whatspro_Flowy
 * @subpackage Whatspro_Flowy/includes
 * @author     Apeiron GS <mail>
 */
class Whatspro_Flowy_Loader {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->actions = array();
		$this->filters = array();

	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             The name of the WordPress action that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the action is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             The name of the WordPress filter that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * A utility function that is used to register the actions and hooks into a single
	 * collection.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array                $hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @param    string               $hook             The name of the WordPress filter that is being registered.
	 * @param    object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         The priority at which the function should be fired.
	 * @param    int                  $accepted_args    The number of arguments that should be passed to the $callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		return $hooks;

	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		foreach ( $this->filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

		foreach ( $this->actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );
		}

	}

}
/**
* The admin-specific functionality of the plugin.
*
* @link uri
* @since 1.0.0
*
* @package Whatspro_Flowy
* @subpackage Whatspro_Flowy/admin
*/

/**
* The admin-specific functionality of the plugin.
*
* Defines the plugin name, version, and two examples hooks for how to
* enqueue the admin-specific stylesheet and JavaScript.
*
* @package Whatspro_Flowy
* @subpackage Whatspro_Flowy/admin
* @author Apeiron GS <mail>
*/
	class Whatspro_Flowy_Admin {

		/**
		* The ID of this plugin.
		*
		* @since 1.0.0
		* @access private
		* @var string $plugin_name The ID of this plugin.
		*/
		private $plugin_name;

		/**
		* The version of this plugin.
		*
		* @since 1.0.0
		* @access private
		* @var string $version The current version of this plugin.
		*/
		private $version;
	
		/**
		* Initialize the class and set its properties.
		*
		* @since 1.0.0
		* @param string $plugin_name The name of this plugin.
		* @param string $version The version of this plugin.
		*/
		public function __construct( $plugin_name, $version ) {
	
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	
		}
		/**
		* INDICE EN EL MENU DEL ADMINISTRADOR
		*
		* @since 1.0.0
		*/
	
		public function my_admin_menu(){
		add_menu_page( 'WhatsPro Admin - WordPress', 'WhatsPro admin', 'manage_options', 'whatsPro/admin',
		array($this, 'whatspro_flowy_admin_page'), null , 1);
		}
		/**
		* Trae la vista del iframe de whatspro
		*/
		public function whatspro_flowy_admin_page(){
		//return views
		require_once 'partials/whatspro-flowy-admin-display.php';
		}
        public function whatspro_flowy_settings_page(){
		//return views
		require_once 'partials/whatspro-flowy-admin-settings.php';
		}
        public function add_whatspro_settings_page()
        {
            add_options_page(
                'Whatspro Settings',
                'Whatspro',
                'manage_options',
                'whatspro/settings',
                array($this, 'whatspro_flowy_settings_page'),
                null ,
                1
            );
        }

	
	}
/**
* The runtime-specific functionality of the plugin.
*
* @link uri
* @since 1.0.0
*
* @package Whatspro_Flowy
* @subpackage Whatspro_Flowy/runtime
*/

/**
* The admin-specific functionality of the plugin.
*
* Defines the plugin name, version, and two examples hooks for how to
* enqueue the runtime-specific stylesheet and JavaScript.
*
* @package Whatspro_Flowy
* @subpackage Whatspro_Flowy/runtime
* @author Apeiron GS <mail>
	*/
	class WhatsproFlowyPlugin{
		/**
		 * The loader that's responsible for maintaining and registering all hooks that power
		 * the plugin.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      Whatspro_Flowy_Loader    $loader    Maintains and registers all hooks for the plugin.
		 */
		protected $loader;

		/**
		 * The unique identifier of this plugin.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
		 */
		protected $plugin_name;

		/**
		 * The current version of the plugin.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      string    $version    The current version of the plugin.
		 */
		protected $version;

		//Constructor
		function __construct(){
			$this->load_dependencies();
			$this->define_admin_hooks();
			$this->define_head_hooks();
			$this->run();
	
		}

		/**
		 * load dependencies
		 */
		private function load_dependencies() {
			$this->loader = new Whatspro_Flowy_Loader();
	
		}


		/**
		 * Run the loader to execute all of the hooks with WordPress.
		 *
		 * @since    1.0.0
		 */
		public function run() {
			$this->loader->run();
		}

		/**
		 * The name of the plugin used to uniquely identify it within the context of
		 * WordPress and to define internationalization functionality.
		 *
		 * @since     1.0.0
		 * @return    string    The name of the plugin.
		 */
		public function get_plugin_name() {
			return $this->plugin_name;
		}

		/**
		 * The reference to the class that orchestrates the hooks with the plugin.
		 *
		 * @since     1.0.0
		 * @return    Whatspro_Flowy_Loader    Orchestrates the hooks of the plugin.
		 */
		public function get_loader() {
			return $this->loader;
		}

		/**
		 * Retrieve the version number of the plugin.
		 *
		 * @since     1.0.0
		 * @return    string    The version number of the plugin.
		 */
		public function get_version() {
			return $this->version;
		}


		/**
		 * Register all of the hooks related to the admin area functionality
		 * of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function define_admin_hooks() {
	
			$plugin_admin = new Whatspro_Flowy_Admin( $this->get_plugin_name(), $this->get_version() );
	
	
			//adds admin menu items
			$this->loader->add_action( 'admin_menu', $plugin_admin, 'my_admin_menu' );
			$this->loader->add_action('admin_init',$this, 'register_setting_whatspro');
			$this->loader->add_action('admin_menu',$plugin_admin, 'add_whatspro_settings_page');

		}

		/**
		 * Register all of the hooks related to the admin area functionality
		 * of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function define_head_hooks() {
	
			//adds admin menu items
			$this->loader->add_action( 'wp_head',$this, 'addToEndOfPost' );

		}
	
		// Methods
		/**
		 * Metodo que imprime el script con el id del blog
		 */
		public function addToEndOfPost(){
			/**
			 * metodo que identifica el blog y devuelve el id
			 */
			$bId = get_current_blog_id();
            update_option( 'whatspro','111111111111');
            $parsedOptions =json_encode(get_option('whatspro'));
            $parsedOption =json_decode($parsedOptions);
			/**
			 * imprimir el script como string dentro del head
			 */
			echo '<script type="text/javascript" src="https://whatspro.flowy.com.ar/api/script/onLoad.js?store=' . $parsedOption .'" async></script>';
	
		
		}
		/**
		 * funcion que arma los settings para los accesos
		 */
		public function register_setting_whatspro(){
			register_setting( 'whatspro', 'whatspro');
			$id='385978712';

			update_option( 'whatspro',$id);
            $parsedOptions =json_encode(get_option('whatspro'));

			echo '<script>console.log(' .$parsedOptions. ')</script>';
		}

}

/* Exists if directly accessed */
if( ! defined( 'ABSPATH' ) ) {
	die;
}

// Define variable for path to this plugin file.
define( 'WP_DEBUG', true);
define( 'WTF_LOCATION', dirname( __FILE__ ) );
define( 'WTF_LOCATION_URL', plugins_url( __FILE__ ) );

if( class_exists( 'WhatsproFlowyPlugin' ) ){
	// $id = get_main_site_id();
	$id = '385978712';
	$whatsproPlugin = new WhatsproFlowyPlugin(  );
}
