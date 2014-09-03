<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
// add_image_size( 'wpbs-featured', 780, 300, true );
add_image_size( '400-square', 400, 400, true );

// Add RSS feed links to <head> for posts and comments.
add_theme_support( 'automatic-feed-links' );

// Adds Style to WYSIWYG
add_editor_style( 'editor.css' );

add_filter( 'fb_meta_tags', 'remove_og_tags' );
function remove_og_tags( $meta_tags )
{
  $meta_tags['http://ogp.me/ns#image'] = null;
  return $meta_tags;
}

add_filter('wpseo_pre_analysis_post_content', 'mysite_opengraph_content');
function mysite_opengraph_content($val) {
return '';
} 

function modify_attachment_link( $markup, $id, $size, $permalink ) {
    global $post;
    if ( ! $permalink ) {
        $markup = str_replace( '<a href', '<a title="'.$att_title.'" data-gallery class="'. $size .'attachment-' . $size . '" href', $markup );
    }
    return $markup;
}
add_filter( 'wp_get_attachment_link', 'modify_attachment_link', 10, 4 );
