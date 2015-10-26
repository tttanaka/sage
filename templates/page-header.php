<?php use Roots\Sage\Titles; ?>

<?php if (is_front_page()) { ?>

<?php } else { ?>

  <div class="page-header">
    <h1><?= Titles\title(); ?></h1>
  </div>

  <!-- <div class="page-header-subtitle">
    <h2><?= Titles\subtitle(); ?></h2>
  </div> -->

<?php } ?>
