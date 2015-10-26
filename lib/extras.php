<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Clean-up header
 */
// Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links_extra', 3);
 // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'feed_links', 2);
// Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'rsd_link');
// Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'wlwmanifest_link');
// Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
// Remove Emojis
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Remove Injected classes, ID's and Page ID's from Navigation <li> items
 */
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}
// Remove Navigation <li> injected classes
add_filter('nav_menu_css_class',  __NAMESPACE__ . '\\my_css_attributes_filter', 100, 1);
// Remove Navigation <li> injected ID
add_filter('nav_menu_item_id',  __NAMESPACE__ . '\\my_css_attributes_filter', 100, 1);
// Remove Navigation <li> Page ID's
add_filter('page_css_class',  __NAMESPACE__ . '\\my_css_attributes_filter', 100, 1);

/**
 * Remove the <div> surrounding the dynamic navigation to cleanup markup
 */
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}
// Remove surrounding <div> from WP Navigation
add_filter('wp_nav_menu_args', __NAMESPACE__ . '\\my_wp_nav_menu_args');

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}
add_filter('post_thumbnail_html', __NAMESPACE__ . '\\remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter('post_thumbnail_html', __NAMESPACE__ . '\\remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter('image_send_to_editor', __NAMESPACE__ . '\\remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'inkling') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}
add_filter('show_admin_bar', __NAMESPACE__ . '\\remove_admin_bar'); // Remove Admin bar

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}
add_filter('the_category', __NAMESPACE__ . '\\remove_category_rel_from_category_list'); // Remove invalid rel attribute

/**
 * Get Navigation Title
 * http://codex.wordpress.org/Function_Reference/wp_get_nav_menu_object
 */
function nav_menu_title($menu_name) {
  $locations = get_nav_menu_locations();
  $menu_id = $locations[ $menu_name ] ;
  $_menu_object = wp_get_nav_menu_object($menu_id);

  return $_menu_object->name;
}
