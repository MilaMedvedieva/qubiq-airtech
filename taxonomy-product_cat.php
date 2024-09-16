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
    <section class="bg-white mb-10 pt-4 lg:pt-8 lg:mb-12">
        <div class="container px-4 mx-auto my-5">
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                <h1 class="text-right text-left text-black-50 text-2xl md:text-4xl lg:text-5xl mb-4 lg:mb-8 font-medium woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
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

<?php
global $wp_query;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$max_num_page =  $wp_query->max_num_pages;
$post_per_page = get_option('posts_per_page');


$terms_einsatzgebiet = get_terms([
    'taxonomy' => 'product_tag',
    'hide_empty' => false
]);

$ID_category = get_queried_object()->term_id;
$series_category = [];
$category_args = array(
    'taxonomy'      => 'product_cat',
    'field'         => 'term_id',
    'terms'         => $ID_category,
);
$query = new WC_Product_Query(array(
    'limit' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status'       => 'publish',
    'tax_query' => array(
        'relation' => 'AND',
        $category_args
    )
));

$products = $query->get_products();

if (!empty($products)) {
    foreach ($products as $product) {
       $get_series =  wp_get_post_terms( $product->get_id(), 'produktserie', array( 'fields' => 'all' ) );
       foreach ($get_series as $item){
            $serie_ID = $item->term_id;
            array_push($series_category, $serie_ID);
            $series_category= array_unique($series_category);
       }
    }
}
?>
    <?php if(!empty($series_category)): ?>
    <section>
        <div class="container px-4 mx-auto my-5">
            <input id="current_category_product_id" type="hidden" value="<?= $ID_category;?>">
            <form action="#" method="post" accept-charset="utf-8" class="text-base lg:text-lg text-black-50 font-light filter_product_category" id="filter_product_category">
                <div class="mb-7">
                    <label>
                        <strong><?php esc_html_e( 'Filtern' ); ?> </strong>
                        <?php esc_html_e( 'nach Einsatzgebiet' ); ?>
                    </label>
                    <div class="einsatzgebiet inline-block mt-3">
                        <?php
                        if ( isset($terms_einsatzgebiet) && !empty($terms_einsatzgebiet) ) {
                            foreach ($terms_einsatzgebiet as $key => $value) {
                                ?>
                                <label for="<?php echo $value->name ?>" class="inline-block mx-2 mb-2 transform -skew-x-12 <?php echo $value->name ?>">
                                    <input type="radio"  name="einsatzgebiet"  id="<?php echo $value->name ?>"  value="<?php echo $value->term_id ?>" class="d-none hidden">
                                    <p class="cursor-pointer mb-0 inline-block rounded bg-gray-50 transition duration-500 ease-in-out">
                                        <span class="px-4 py-1 inline-block transform skew-x-12"><?php echo $value->name ?></span>
                                    </p>
                                </label>
                                <?php
                            }
                        }
                        ?>
                        <label for="all_einsatzgebiet" class="inline-block mx-2 mb-2 transform -skew-x-12">
                            <input class="d-none hidden" type="radio"  name="einsatzgebiet"  id="all_einsatzgebiet"  value="0" checked>
                            <p class="cursor-pointer mb-0 inline-block rounded bg-gray-50 transition duration-500 ease-in-out">
                                <span class="px-4 py-1 inline-block transform skew-x-12"><?php esc_html_e( 'Alle' ); ?></span>
                            </p>
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn-form hidden"><?php esc_html_e( 'Filtern' ); ?></button>
            </form>

        </div>
    </section>
    <?php endif; ?>
    <section class="bg-white mb-10 mt-10 lg:mb-14 lg:mt-16">
        <div class="container px-4 mx-auto my-5">
            <div class="text-center mb-10 hidden preload">
                <span class="preloader-speeding-wheel"></span>
            </div>
            <?php if(!empty($series_category)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-1 md:gap-4 lg:gap-11 render_filter_category">
                <?php foreach ($series_category as $serie) :?>
                    <?php
                        $term = get_term($serie);
                        $term_slug = $term->slug;
                        $term_tax = $term->taxonomy;
                        $term_name = $term->name;
                        $term_desc = $term->description;
                        $term_link = get_term_link($serie);
                        $term_image = get_field( "image", $term );
                        $term_title = get_field( "title", $term );
                    ?>
                    <div class="card mb-7 lg:mb-1">
                        <div class="mb-4 lg:mb-8 rounded bg-gray-50  overflow-hidden h-36 max-h-36 md:h-56 md:max-h-56 lg:h-72 lg:max-h-72">
                            <?php if(!empty($term_image)): ?>
                                <a href="/<?=$term_tax?>/<?=$term_slug?>?current=<?=$ID_category?>" class="block h-full opacity-7 transform scale-110 transition ease-in-out duration-300 hover:opacity-1 hover:scale-100">
                                    <img src="<?php echo $term_image['sizes']['large'] ?>"
                                         data-src="<?php echo $term_image['url'] ?>"
                                         class="lazyload blur-up object-cover"
                                         width="100%"
                                         height="100%"
                                         alt="<?php echo $term_image['alt'] ?>"
                                         loading="lazy">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <a href="/<?=$term_tax?>/<?=$term_slug?>?current=<?=$ID_category?>">
                                <h3 class="text-green-50 text-lg lg:text-xl font-medium mb-2 lg:mb-3 lg:mb-6 transition duration-500 ease-in-out hover:text-blue-100">
                                    <?php echo (!empty($term_title)) ? $term_title : $term_name ; ?>
                                </h3>
                            </a>

                            <div class="text-black-10 text-base lg:text-lg font-light mb-3 lg:mb-6">
                                <?php echo $term_desc ?>
                            </div>

                            <?php if(!empty($term_link)): ?>
                                <a href="/<?=$term_tax?>/<?=$term_slug?>?current=<?=$ID_category?>" class="transition duration-500 ease-in-out text-green-50  text-base lg:text-lg font-light text-link">
                                   <?php _e('Zu den Produkten der Serie'); ?>
                                </a>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="mb-3 md:mb-6">
                <?php echo do_action( 'woocommerce_no_products_found' ); ?>
            </div>
            <?php endif;?>
        </div>
    </section>
<?php

//if ( woocommerce_product_loop() ) {
//
//	/**
//	 * Hook: woocommerce_before_shop_loop.
//	 *
//	 * @hooked woocommerce_output_all_notices - 10
//	 * @hooked woocommerce_result_count - 20
//	 * @hooked woocommerce_catalog_ordering - 30
//	 */
//	do_action( 'woocommerce_before_shop_loop' );
//
//	woocommerce_product_loop_start();
//
//	if ( wc_get_loop_prop( 'total' ) ) {
//		while ( have_posts() ) {
//			the_post();
//
//			/**
//			 * Hook: woocommerce_shop_loop.
//			 */
//			do_action( 'woocommerce_shop_loop' );
//
//			wc_get_template_part( 'content', 'product' );
//		}
//	}
//
//	woocommerce_product_loop_end();
//
//	/**
//	 * Hook: woocommerce_after_shop_loop.
//	 *
//	 * @hooked woocommerce_pagination - 10
//	 */
//	do_action( 'woocommerce_after_shop_loop' );
//} else {
//	/**
//	 * Hook: woocommerce_no_products_found.
//	 *
//	 * @hooked wc_no_products_found - 10
//	 */
//	do_action( 'woocommerce_no_products_found' );
//}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
