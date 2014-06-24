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