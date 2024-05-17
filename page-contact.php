<?php
  // Template name: Contato
  get_header();

  include(locate_template( 'pages/contact/form.php', false, false ));

  get_footer(); ?>
<style>
  .header {
    color: white
  }
  .header svg path {
    fill: white
  }
  .footer {
    margin-top: 0

  }
  .footer__call {
    display: none !important
  }
</style>