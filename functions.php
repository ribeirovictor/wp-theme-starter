<?php

// Register the Javascript
function javascript_scripts()
{
  wp_deregister_script('jquery');
  wp_register_script('jquery', get_template_directory_uri() . '/assets/js/libs/jquery-3.4.1.js', array(), "3.4.1", true);
  wp_register_script('plugins-script', get_template_directory_uri() . '/assets/js/plugins.js', array('jquery'), false, true);
  wp_register_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'plugins-script'), false, true);

  wp_enqueue_script('main-script');

  wp_localize_script('my-script-handle', 'frontEndAjax', array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('ajax_nonce')
  ));
}
add_action('wp_enqueue_scripts', 'javascript_scripts');

// Register the CSS
function style_css()
{
  wp_register_style('style', get_template_directory_uri() . '/style.css', array(), filemtime(get_stylesheet_directory() . '/style.css'), false);
  wp_enqueue_style('style');
}
add_action('wp_enqueue_scripts', 'style_css');

// Remove block-library/style.min.css
function wpassist_remove_block_library_css()
{
  wp_dequeue_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'wpassist_remove_block_library_css');

// Activate SVG as upload format
function add_file_types_to_uploads($file_types)
{
  $new_filetypes = array();
  $new_filetypes['svg'] = 'image/svg+xml';
  $file_types = array_merge($file_types, $new_filetypes);
  return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

// Remove useless itens from header
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// Add support to Thumbnails
add_theme_support('post-thumbnails');

// Remove itens from ADMIN
function remove_menu_items()
{

  // remove_menu_page('themes.php');
  // remove_submenu_page('options-general.php', 'options-media.php');
  // remove_submenu_page('options-general.php', 'options-discussion.php');
  // remove_submenu_page('options-general.php', 'akismet-key-config');
  // remove_submenu_page('admin.php', 'wp_mailjet_options_campaigns_menu');

  //  remove_menu_page( 'tools.php' );

  //  remove_menu_page( 'edit.php' );

  // remove_menu_page('edit-comments.php');

  // remove_menu_page('upload.php');

  // remove_menu_page( 'plugins.php' );

  //  remove_menu_page( 'edit.php?post_type=acf-field-group' );

}
add_action('admin_menu', 'remove_menu_items', 999);

// Remove ./node_modules folder from All In One WP Export
add_filter('ai1wm_exclude_content_from_export', function ($exclude_filters) {
  $exclude_filters[] = 'themes/transatlantica/node_modules';
  return $exclude_filters;
});

// Custom Post Type - Product

//hook into the init action and call create_book_taxonomies when it fires
// add_action('init', 'create_topics_hierarchical_taxonomy', 0);

// //create a custom taxonomy name it topics for your posts

// function create_topics_hierarchical_taxonomy()
// {

//   // Product custom taxonomy and post type

//   $labels = array(
//     'name' => _x('Product Category', 'taxonomy general name'),
//     'singular_name' => _x('Product Category', 'taxonomy singular name'),
//     'search_items' =>  __('Search Product Categories'),
//     'all_items' => __('All Product Category'),
//     'parent_item' => __('Product Category parent'),
//     'parent_item_colon' => __('Product Category parent:'),
//     'edit_item' => __('Edit Product Category'),
//     'update_item' => __('Update Product Category'),
//     'add_new_item' => __('Add New Product Category'),
//     'new_item_name' => __('New Product Category'),
//     'menu_name' => __('Product Category'),
//   );

//   register_taxonomy('product_category', array('products'), array(
//     'hierarchical' => true,
//     'labels' => $labels,
//     'show_ui' => true,
//     'show_admin_column' => true,
//     'query_var' => true,
//     'rewrite' => array('slug' => 'product/category'),
//   ));
// }

function custom_post_type_news()
{
  register_post_type('news', array(
    'label' => 'Notícias',
    'description' => 'Notícias',
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'capability_type' => 'post',
    'map_meta_cap' => true,
    'has_archive' => true,
    'hierarchical' => false,
    'rewrite' => array('slug' => 'noticias', 'with_front' => true),
    'query_var' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    // 'taxonomies' => array('news_category'),

    'labels' => array(
      'name' => 'Notícias',
      'singular_name' => 'Notícia',
      'menu_name' => 'Notícias',
      'add_new' => 'Adicionar nova notícia',
      'add_new_item' => 'Adicionar nova notícia',
      'edit' => 'Editar',
      'edit_item' => 'Editar notícia',
      'new_item' => 'Nova notícia',
      'view' => 'Ver notícia',
      'view_item' => 'Ver notícia',
      'search_items' => 'Procurar notícia',
      'not_found' => 'Nenhuma notícia encontrada',
      'not_found_in_trash' => 'Nenhuma notícia encontrada na lixeira',
    )
  ));
}
add_action('init', 'custom_post_type_news');

add_action('acf/init', 'my_acf_init');
function my_acf_init() {
    
    // check function exists
    if( function_exists('acf_register_block') ) {
        
        // register a testimonial block
        acf_register_block(array(
            'name'              => 'full-page-video',
            'title'             => __('Vídeo em tela cheia'),
            'description'       => __('Mostra  vídeo em tela cheia.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'widgets',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'full-page-video', 'quote' ),
        ));
    }
}

function my_acf_block_render_callback( $block ) {
    
  // convert name ("acf/testimonial") into path friendly slug ("testimonial")
  $slug = str_replace('acf/', '', $block['name']);
  
  // include a template part from within the "template-parts/block" folder
  if( file_exists( get_theme_file_path("/acf/blocks/content-{$slug}.php") ) ) {
      include( get_theme_file_path("/acf/blocks/content-{$slug}.php") );
  }
}

// Custom menus
function register_my_menus() {
  register_nav_menus(
    array(
      'header' => __( 'Header' ),
      'footer' => __( 'Footer' )
     )
   );
 }
 add_action( 'init', 'register_my_menus' );