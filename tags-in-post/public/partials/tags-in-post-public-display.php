<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://newcombin.com/
 * @since      1.0.0
 *
 * @package    Tags_In_Post
 * @subpackage Tags_In_Post/public/partials
 */
?>
<aside id="areatag" class="area-tags">
    <span id="tagsid"><?php _e( 'Tags:', '' ); ?></span> 
    <?php foreach( $tags_to_show as $tag ) : ?>
        <span>
            <a class="btn btn-outline-primary" href="<?php echo site_url('tag/') . $tag->slug; ?>/">
                <?php echo $tag->name; ?>
            </a>
        </span>
    <?php endforeach ?>
</aside>