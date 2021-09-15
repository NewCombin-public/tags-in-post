<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://newcombin.com/
 * @since      1.0.0
 *
 * @package    Tags_In_Post
 * @subpackage Tags_In_Post/admin/partials
 */
?>
<div class="wrap">
    <h1><?php _e('Featured tags', 'tags-in-post' ); ?></h1>
    <p><?php _e('Select the tags that will have priority to display in the post. The last are priority.', 'tags-in-post' ); ?></p>
    <form method="post" name="tags-in-post" action="options.php">
    <?php
        settings_fields('tags-in-post');
        do_settings_sections('tags-in-post');

        $tags_saved = get_option( 'tags_in_post', array() );
    ?>
    <table class="form-table" role="presentation">
        <tbody>
        <tr>
            <th scope="row"><?php _e('Tags', 'tags-in-post' ); ?></th>
            <td>
                <select id="tags-in-post" name="tags_in_post[]" multiple style="max-width: 400px">
                <?php
                $tags = get_tags();
                foreach( $tags_saved as $tag_slug ) :
                    foreach( $tags as $tag ) :
                        if ( $tag_slug == $tag->slug ) : ?>
                            <option value="<?php echo $tag->slug ?>" selected><?php echo $tag->name ?></option>
                        <?php endif;
                    endforeach;
                endforeach;
                foreach ( $tags as $tag ) :
                    if ( ! in_array( $tag->slug, $tags_saved ) ) : ?>
                        <option value="<?php echo $tag->slug ?>"><?php echo $tag->name ?></option>
                    <?php endif;
                endforeach;
                ?>
                </select>
            </td>
        </tr>
        </tbody>
    </table>
    <?php submit_button( __( 'Save all changes', 'tags-in-post' ), 'primary', 'submit', TRUE ); ?>
    </form>
</div>