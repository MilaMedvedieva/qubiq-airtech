<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>

<?php
    $current_tax_id = '';
    $current_tax_name = '';
    $current_cat_title ='';
    if( isset($_GET['current']) && !empty($_GET['current'])  ){
        $current_tax_id = $_GET["current"];
        $current_cat_title = get_term( $current_tax_id )->name;
        $current_tax_name = get_term( $current_tax_id )->taxonomy;
    }

    $ID_serie = get_queried_object()->term_id;
    $series_category = [];
    $args = array(
        'post_type' => 'product',
        'limit' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'tax_query' => array(
            array(
                'taxonomy'      => $current_tax_name,
                'field'         => 'term_id',
                'terms'         => $current_tax_id,
                'operator'      => 'AND'
            ),
            array(
                'taxonomy'      => 'produktserie',
                'field'         => 'term_id',
                'terms'         => $ID_serie,
                'operator'      => 'AND'
            )
        )
    );

    $term = get_term($ID_serie);
    $second_title = get_field( "title", $term);
?>

    <!--current category-->
    <?php if(isset($current_tax_id) and (!empty($current_tax_id))): ?>
    <section class="bg-white pt-4 lg:pt-8">
        <div class="container px-4 mx-auto">
            <?php if ( $current_cat_title ): ?>
                <h2 class="text-right text-left text-black-50 text-2xl md:text-4xl lg:text-5xl mb-4 lg:mb-8 font-medium woocommerce-products-header__title page-title">
                    <?php echo $current_cat_title; ?>
                </h2>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <!--tile Serie-->
    <section class="bg-white mb-10 pt-4 lg:pt-8 lg:mb-12">
        <div class="container px-4 mx-auto my-5">
            <?php if(!empty($second_title)): ?>
                <h1 class="text-left text-green-50 text-xl md:text-2xl lg:text-3xl font-medium mb-4 lg:mb-8 woocommerce-products-header__title page-title"><?php echo $second_title; ?></h1>
            <?php else: ?>
                <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                    <h1 class="text-left text-green-50 text-xl md:text-2xl lg:text-3xl font-medium mb-4 lg:mb-8 woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
                <?php endif; ?>
            <?php endif; ?>
            <div class="text-black-50 text-lg md:text-xl lg:text-2xl font-light leading-6 md:leading-8">
                <?php
                /**
                 * Hook: woocommerce_archive_description.
                 *
                 * @hooked woocommerce_taxonomy_archive_description - 10
                 * @hooked woocommerce_product_archive_description - 10
                 */
                do_action( 'woocommerce_archive_description' );
                ?>
            </div>
        </div>
    </section>

    <section class="bg-white mb-5 mt-10 lg:mb-14 lg:mt-16">
         <div class="container px-4 mx-auto my-5">
           <!-- list product -->
             <?php if (!empty($current_tax_id)): ?>
             <ul class="products columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?>">
                 <?php
                 $loop = new WP_Query( $args );
                 if ( $loop->have_posts() ) {
                     while ( $loop->have_posts() ) : $loop->the_post();
                         wc_get_template_part( 'content', 'product' );
                     endwhile;
                 } else {
                     echo do_action( 'woocommerce_no_products_found' );
                 }
                 wp_reset_postdata();
                 ?>
             </ul>
             <?php else:
                 if ( woocommerce_product_loop() ) {

                     /**
                      * Hook: woocommerce_before_shop_loop.
                      *
                      * @hooked woocommerce_output_all_notices - 10
                      * @hooked woocommerce_result_count - 20
                      * @hooked woocommerce_catalog_ordering - 30
                      */
                    // do_action( 'woocommerce_before_shop_loop' );

                     woocommerce_product_loop_start();

                     if ( wc_get_loop_prop( 'total' ) ) {
                         while ( have_posts() ) {
                             the_post();

                             /**
                              * Hook: woocommerce_shop_loop.
                              */
                             do_action( 'woocommerce_shop_loop' );

                             wc_get_template_part( 'content', 'product' );
                         }
                     }

                     woocommerce_product_loop_end();

                     /**
                      * Hook: woocommerce_after_shop_loop.
                      *
                      * @hooked woocommerce_pagination - 10
                      */
                     do_action( 'woocommerce_after_shop_loop' );
                 } else {
                     /**
                      * Hook: woocommerce_no_products_found.
                      *
                      * @hooked wc_no_products_found - 10
                      */
                     do_action( 'woocommerce_no_products_found' );
                 }endif; ?>
        </div>
    </section>

<?php  get_footer( 'shop' );
