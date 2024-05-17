<?php
/**
 * Block Name: Vídeo em tela cheia
 *
 * This is the template that displays the testimonial block.
 */

// Load value.
$iframe = get_field('full-page-video');

// Use preg_match to find iframe src.
preg_match('/src="(.+?)"/', $iframe, $matches);
$src = $matches[1];

// Add extra parameters to src and replace HTML.
$params = array(
    'controls'  => 0,
    'hd'        => 1,
    'autohide'  => 1
);
$new_src = add_query_arg($params, $src);
$iframe = str_replace($src, $new_src, $iframe);

// Add extra attributes to iframe HTML.
$attributes = 'frameborder="0"';
$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

// Display customized HTML.
echo $iframe;
?>

<style type="text/css">
    #<?php echo $id; ?> {
        background: <?php the_field('background_color'); ?>;
        color: <?php the_field('text_color'); ?>;
    }
</style>