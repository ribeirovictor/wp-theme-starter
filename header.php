<!DOCTYPE html>
<html lang="pt-br">
	<head>

  <?php 
    // Meta
    $fontLink = 'https://fonts.googleapis.com/css2?family=Lato:wght@400;700';
    include(locate_template( 'meta.php', false, false )); ?>

		<?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <!-- 
    .header--green 
      add to green header
  -->
  <header class="header">
    <a href="/" class="logo">
      <?php echo file_get_contents(  get_template_directory() . '/assets/img/logo/logo.svg'); ?>
    </a>
    <nav class="header__nav">
      <?php wp_nav_menu([ 
        'theme_location' => 'header', 
        // 'container_id' => 'main-nav',
        // 'menu_id' => 'menu-top-menu', 
        // 'menu_class' => 'dropdown'
        ]); ?>
    </nav>
    <a class="header__contact" href="/contato">Contato</a>
    <nav class="header__mobile">
      <button class="mobile-menu__button--open  mobile-menu--toggle">
        <?php echo file_get_contents(  get_template_directory() . '/assets/img/icons/hamburger.svg'); ?>
      </button>
    </nav>
  </header>
  <div class="header-spacing"></div>

  <div class="mobile-menu">
    <button class="mobile-menu__button--close mobile-menu--toggle">
        <?php echo file_get_contents(  get_template_directory() . '/assets/img/icons/close.svg'); ?>
      </button>
    <nav class="mobile-menu__links">
      <a class="" href="/">Home</a>
      <?php wp_nav_menu([ 
        'theme_location' => 'header', 
        // 'container_id' => 'main-nav',
        // 'menu_id' => 'menu-top-menu', 
        // 'menu_class' => 'dropdown'
        ]); ?>
      <a class="" href="/contato">Contato</a>
    </nav>
  </div>
  
  <div class="mobile-menu__backdrop"></div>
  <div class="header__spacing"></div>

