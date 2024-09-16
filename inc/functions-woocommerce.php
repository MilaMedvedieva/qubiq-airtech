<?php


/* Remove "Default Sorting" Dropdown @ WooCommerce Shop & Archive Page*/
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

/* Remove "woocommerce_before_main_content"  Shop & Archive Page*/
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10,0);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20,0);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10,0);

/* Remove "add to cart"  Shop & Archive Page*/
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_filter('woocommerce_sale_flash', 'woo_hide_sale_flash');


add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_description', 4 );
add_filter('loop_shop_columns', 'qubiq_loop_shop_columns');

add_action( 'template_redirect', 'woocommerce_redirection' );

/*Change number of products that are displayed per page (shop page)*/
add_filter( 'loop_shop_per_page', 'woocommerce_loop_shop_per_page', 20 );

/*Remove related products output*/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// woocommerce_single_product_summary
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );



/* Add a custom product data tab */
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
/* Rename and reordered product data tabs */
add_filter( 'woocommerce_product_tabs', 'woo_rename_reordered_tabs', 98 );

//Remove single_product_image
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'woo_remove_product_thumbnail_link' );

add_filter( 'woocommerce_product_description_heading', '__return_null' );
/* Show the product description in the product loop. */
if ( ! function_exists( 'woocommerce_template_loop_product_description' ) ) {
    function woocommerce_template_loop_product_description() {
        echo '<div itemprop="description" class="woocommerce-loop-product__desc">' .  get_the_excerpt() . '</div>';
    }
}

function qubiq_loop_shop_columns() {
    global $woocommerce;

    // Default Value also used for categories and sub_categories
    $columns = 2;

    // Product List
    if ( is_product_category() ) :
        $columns = 2;
    endif;

    //Related Products
    if ( is_product() ) :
        $columns = 4;
    endif;

    //Cross Sells
    if ( is_checkout() ) :
        $columns = 4;
    endif;

    return $columns;


}

function woocommerce_get_product_lazy_image_html( $product ) {
    global $product;
    $id = $product->get_id();
    $image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'medium' );
    $image_full  = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'woocommerce_single' );

    if ( $image_thumb || $image_full )
    {
        ob_start();
        ?>
        <img src="<?php echo $image_thumb[0] ?>"
             data-src="<?php echo $image_full[0] ?>"
             class="w-100 m-0 blur-up lazyload"
             width="335" height="335"
             alt="<?php echo $product->get_title(); ?>"
             loading="lazy"
        >
        <?php
        return ob_get_clean();
    }

    return false;

}


function woocommerce_redirection(){
    // Here set the Url redirection
    $url_shop = get_permalink( wc_get_page_id( 'shop' ) );
    $url_checkout = get_permalink( wc_get_page_id( 'checkout' ) );


    if( is_cart() ){
        wp_safe_redirect( $url_shop );
        exit();
    }
}


function woocommerce_loop_shop_per_page( $cols ) {
    $cols = 10;
    return $cols;
}

function woo_rename_reordered_tabs( $tabs ) {
    //priority
//    $tabs['description']['priority'] = 5;
//    $tabs['videos']['priority'] = 10;
//    $tabs['uberblick']['priority'] = 15;
//    $tabs['additional_information']['priority'] = 20;

    //title
    $tabs['additional_information']['title'] = __( 'Technische Daten' );
    return $tabs;

}
function woo_new_product_tab( $tabs ) {

    // Adds the new tab
    if(get_field('produkte_videos')){
        $tabs['video'] = array(
            'title' 	=> __( 'Videos', 'woocommerce' ),
            'priority' 	=> 10,
            'callback' 	=> 'woo_custom_tab_videos'
        );
    }

    if(get_field('produkte_uberblick')){
        $tabs['uberblick'] = array(
            'title' 	=> __( 'Überblick', 'woocommerce' ),
            'priority' 	=> 15,
            'callback' 	=> 'woo_custom_tab_uberblick'
        );
    }

    return $tabs;


}
function woo_custom_tab_uberblick(){
     $prod_id = get_the_ID();
     $uberblick = get_field( 'produkte_uberblick', get_the_ID());
     echo $uberblick;
 }
function woo_custom_tab_videos() {
    $prod_id = get_the_ID();
    $videos = get_field( 'produkte_videos', get_the_ID());
    foreach ($videos as $item){
        echo $item['video'];
    }
}

function woo_remove_product_thumbnail_link( $html ) {
    return strip_tags( $html, '<div><img>' );
}

function woo_hide_sale_flash()
{
    return false;
}

