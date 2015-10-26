<?php

namespace Roots\Sage\Titles;

/**
 * Page titles
 */
function title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      return get_the_title(get_option('page_for_posts', true));
    } else {
      return __('Latest Posts', 'sage');
    }
  } elseif (is_archive()) {
    return get_the_archive_title();
  } elseif (is_search()) {
    return sprintf(__('Search Results for %s', 'sage'), get_search_query());
  } elseif (is_404()) {
    return __('Not Found', 'sage');
  } else {
    return get_the_title();
  }
}

/**
 * Page subtitles
 */
// function subtitle() {
//   if ( is_page_template('template-locations.php') ) {
//     return __('Proudly Serving the ' . get_the_title() . ' Area', 'inkling');
//   } else {
//     return get_field('page_subtitle_header');
//   }
// }
