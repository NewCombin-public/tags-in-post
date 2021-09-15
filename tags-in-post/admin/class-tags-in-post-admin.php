<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://newcombin.com/
 * @since      1.0.0
 *
 * @package    Tags_In_Post
 * @subpackage Tags_In_Post/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tags_In_Post
 * @subpackage Tags_In_Post/admin
 * @author     NewCombin <info@newcombin.com>
 */
class Tags_In_Post_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		$screen = get_current_screen();
		if ( ! is_object( $screen ) )
			return;

		if ( 'configuracion_page_tags-in-post' === $screen->id ) { 
			wp_enqueue_style( 'choices', 'https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tags-in-post-admin.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		$screen = get_current_screen();
		if ( ! is_object( $screen ) )
			return;

		if ( 'configuracion_page_tags-in-post' === $screen->id ) { 
			wp_enqueue_script( 'choices', 'https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tags-in-post-admin.js', array( 'jquery' ), $this->version, false );
		}
	}

	/**
	 * Register a the menu page
	 *
	 * @since    1.0.0
	 * @return void
	 */
	function add_menu_page() {
		if ( empty ( $GLOBALS['admin_page_hooks']['configuracion'] ) ) {
			add_menu_page(
				__( 'Configuration', 'tags-in-post' ),
				__( 'Configuration', 'tags-in-post' ),
				'manage_options',
				'configuracion',
				array( $this, 'display_plugin_setup_page' ),
				'dashicons-admin-tools'
			);
		}

		add_submenu_page(
			'configuracion',
			__( 'Featured Tags', 'tags-in-post' ),
			__( 'Featured Tags', 'tags-in-post' ),
			'manage_options',
			'tags-in-post',
			array( $this, 'display_plugin_setup_page' ),
		);

		remove_submenu_page( 'configuracion', 'configuracion');
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {
		$settings_link = array( '<a href="' . admin_url( 'admin.php?page=' . $this->plugin_name ) . '">' . __( 'Settings', 'tags-in-post' ) . '</a>', );
		return array_merge(  $settings_link, $links );
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_setup_page() {
		include_once( 'partials/' . $this->plugin_name . '-admin-display.php' );
	}
}
