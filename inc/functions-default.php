<?php
if ( function_exists('add_theme_support') ) {

    // Add woocommerce Theme Support

    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-slider' );

    //Add Thumbnail Theme support
    add_theme_support('post-thumbnails');
    add_image_size('small', 300, '', true);
    add_image_size('medium', 600, '', true);
    add_image_size('large', 1000, '', true);
    add_image_size('large2', 1500, '', true);
    add_image_size('large3', 1920, '', true);

}

// Remove Wordpress emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

function add_slug_to_body_class($classes){
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}


function filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

