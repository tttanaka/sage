<?php
/**
 * Custom Navigation Walker to display description in links
 * @var Nav_Description_Walker
 */
$walker = new Nav_Description_Walker; ?>

<footer class="wrap content-info">
  <div class="container">
    <?php //dynamic_sidebar('sidebar-footer'); ?>
    <div class="nav-footer">
      <h3>
        <?php
        // extract title from menu name
        echo __(Roots\Sage\Extras\nav_menu_title('footer_section1_navigation'), 'inkling');

        if (has_nav_menu('social_media_navigation')) :
          $args = [
            'theme_location'  => 'social_media_navigation',
            'container'       => false,
            'echo'            => false,
            'items_wrap'      => '%3$s',
            'depth'           => 0
          ];
          // strip all tags except: <a>
          echo strip_tags(wp_nav_menu($args), '<a>,<i>,<span>');

        endif;
      ?>
      </h3>
      <?php
      if (has_nav_menu('footer_section1_navigation')) :
        wp_nav_menu([
          'theme_location' => 'footer_section1_navigation',
          // 'menu_class' => 'nav',
          'walker' => $walker
        ]);
      endif;
      ?>
    </div>
    <div class="nav-footer">
      <h3><? echo __(Roots\Sage\Extras\nav_menu_title('footer_section2_navigation'), 'inkling'); ?></h3>
      <?php
      if (has_nav_menu('footer_section2_navigation')) :
        wp_nav_menu([
          'theme_location' => 'footer_section2_navigation',
          // 'menu_class' => 'nav',
          'walker' => $walker
        ]);
      endif;
      ?>
    </div>
  </div>
</footer>

<div class="wrap copyright">
  <div class="container">
    <span>&copy; <?php echo date('Y') . ' ' . get_bloginfo('name'); ?></span>
    <a href="http://www.future-ink.com/" rel="nofollow">San Diego Web Design</a>
  </div>
</div>
