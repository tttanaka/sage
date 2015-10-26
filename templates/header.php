<header class="wrap header">
  <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>">
      <span class="brand-title"><?php bloginfo('name'); ?></span>
    </a>
    <div class="login">
      <?php
      if (has_nav_menu('login_navigation')) :
        $args = [
          'theme_location'  => 'login_navigation',
          'container'       => false,
          'echo'            => false,
          'items_wrap'      => '%3$s',
          'depth'           => 0
        ];
        // strip all tags except: <a><span>
        echo strip_tags(wp_nav_menu($args), '<a>,<span>');

      endif;
      ?>
    </div>
    <nav id="" class="nav-primary">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class'     => ''
        ]);
      endif;
      ?>
    </nav>
    <button class="toggle-nav">
      <span>toggle menu</span>
    </button>
  </div>
</header>
