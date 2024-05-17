<?php
  // Template name: Página inicial
  get_header();

  // include(locate_template( 'pages/home/presentation.php', false, false ));

  ?>

<?php 
  $directoryFolder = get_template_directory();
  $directoryArray = $directoryFolder.split('/');

  print_r($directoryArray);
  ?>

  <?php


  get_footer(); ?>
