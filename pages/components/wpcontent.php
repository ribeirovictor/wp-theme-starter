<div class="container">
  <section class="wpcontent">
    <?php if (is_single()) : ?>
      <div class="wpcontent__single">
        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>" alt="Imagem da notícia <?php the_title_attribute(); ?>">
        <h1>
          <?php the_title(); ?>
        </h1>
      </div>
    <?php endif; ?>
    <?php the_content(); ?>
  </section>
</div>