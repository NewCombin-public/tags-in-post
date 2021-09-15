<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://newcombin.com/
 * @since      1.0.0
 *
 * @package    Tags_In_Post
 * @subpackage Tags_In_Post/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tags_In_Post
 * @subpackage Tags_In_Post/public
 * @author     NewCombin <info@newcombin.com>
 */
class Tags_In_Post_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Show post tags: first highlithted tags and last added
	 *
	 * @since   1.0.0
	 * @param	mixed Shortcode arguments
	 * @return 	string
	 */
	public static function render_shortcode( $atts ) {
		global $post;

		$attributes = shortcode_atts( array(
			'tags_count' => 3,
		), $atts );

		$tags_highlighted = get_option('tags_in_post');
		$tags_highlighted = empty( $tags_highlighted ) ? array() : $tags_highlighted;

		$tags_to_show = array();
		$tags = get_the_tags( $post );
		if ( empty( $tags ) )
			return;

		// Add first the hightlighted tags, order desc ( last first )
		foreach ( $tags_highlighted as $tag_slug ) {
			if ( ( $index = array_search( $tag_slug, array_column( $tags, 'slug') ) ) !== false ) {
				array_unshift( $tags_to_show, $tags[ $index ] );
			}
		}
		// Order the array by tag count desc
		usort( $tags, function( $a, $b ) { return $b->count - $a->count; } );
		// Use default tags order
		foreach ( $tags as $tag ) {
			if ( ! in_array( $tag->slug, $tags_highlighted ) && ! in_array( $tag->slug, EXCLUDED_TAGS ) ) {
				// Add tag at the end of the new array
				array_push( $tags_to_show, $tag );
			}
		}

		// Get only the first xx tags
		$tags_to_show = array_slice( $tags_to_show, 0, $attributes['tags_count'] );
		
		if ( empty( $tags_to_show ) )
			return;

		// Render shortcode
		ob_start();
		include( 'partials/tags-in-post-public-display.php' );
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	/**
	 * Add the [tags_in_post] shortcode.
	 *
	 * @since   1.0.0
	 * @return	void
	 */
	function add_shortcode() {
		add_shortcode( 'tags_in_post', 'Tags_In_Post_Public::render_shortcode' );
	}
}
