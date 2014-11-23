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

// Add Custom Post Type
add_action('init', 'cptui_register_my_cpt_resource');
function cptui_register_my_cpt_resource() {
register_post_type('resource', array(
'label' => 'Resources',
'description' => '',
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'capability_type' => 'post',
'map_meta_cap' => true,
'hierarchical' => false,
'rewrite' => array('slug' => 'resource', 'with_front' => true),
'query_var' => true,
'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes','post-formats'),
'labels' => array (
  'name' => 'Resources',
  'singular_name' => 'Resource',
  'menu_name' => 'Resources',
  'add_new' => 'Add Resource',
  'add_new_item' => 'Add New Resource',
  'edit' => 'Edit',
  'edit_item' => 'Edit Resource',
  'new_item' => 'New Resource',
  'view' => 'View Resource',
  'view_item' => 'View Resource',
  'search_items' => 'Search Resources',
  'not_found' => 'No Resources Found',
  'not_found_in_trash' => 'No Resources Found in Trash',
  'parent' => 'Parent Resource',
)
) ); }