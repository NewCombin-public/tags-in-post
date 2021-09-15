<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @link       https://newcombin.com/
 * @since      1.0.0
 *
 * @package    Tags_In_Post
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option('tags_in_post');