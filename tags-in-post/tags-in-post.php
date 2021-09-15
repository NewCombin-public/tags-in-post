<?php
/**
 * The plugin bootstrap file
 *
 * @link              https://newcombin.com/
 * @since             1.0.0
 * @package           Tags_In_Post
 *
 * @wordpress-plugin
 * Plugin Name:       Tags in post
 * Plugin URI:        https://newcombin.com/
 * Description:       This plugin add a shortcode that add a tag cloud with configured prefered tags.
 * Version:           1.0.0
 * Author:            NewCombin
 * Author URI:        https://newcombin.com/
 * Text Domain:       tags-in-post
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'TAGS_IN_POST_VERSION', '1.0.0' );
define( 'EXCLUDED_TAGS', array( 
	'editor1', 'editor2', 'editor3', 'editor4', 'editor5', 'editor6', 'editor7',
	'principal1', 'principal2', 'principal3', 'principal4', 'principal5', 'principal6', 'principal7',
	'lomas1', 'lomas2', 'lomas3', 'lomas4', 'lomas5', 'lomas6',
	'branded-content', 'proximo-webinar'
));

/**
 * Register settings
 */
register_setting( 'tags-in-post', 'tags_in_post' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tags-in-post.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_tags_in_post() {

	$plugin = new Tags_In_Post();
	$plugin->run();

}
run_tags_in_post();
