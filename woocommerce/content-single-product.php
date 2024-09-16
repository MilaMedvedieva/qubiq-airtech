<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

$current_tax_id = '';
$current_tax_name = '';
$current_cat_title ='';
if( isset($_GET['current']) && !empty($_GET['current'])  ){
    $current_tax_id = $_GET["current"];
    $current_cat_title = get_term( $current_tax_id )->name;
    $current_tax_name = get_term( $current_tax_id )->taxonomy;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
    <!--current category-->
    <?php if(isset($current_tax_id) and (!empty($current_tax_id))): ?>
        <div class="bg-white  mb-8 pt-4 lg:pt-8">
            <div class="container px-4 mx-auto my-5">
                <?php if ( $current_cat_title ): ?>
                    <h2 class="text-right text-black-50 text-4xl lg:text-5xl font-medium mb-8 woocommerce-products-header__title page-title">
                        <a href="<?php echo get_term_link(intval($current_tax_id))?>"><?php echo $current_cat_title; ?></a>
                    </h2>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="bg-white  mb-8 pt-4 lg:pt-8">
            <div class="container px-4 mx-auto my-5">
                <h2 class="text-right text-black-50 text-lg lg:text-2xl  font-medium mb-8"> <?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( '', '', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?></h2>
            </div>
        </div>
    <?php endif; ?>
    <!--title-->
    <div class="bg-white mb-10 mt-8 lg:mb-20">
        <div class="container px-4 mx-auto my-5">
            <?php  wc_get_template( 'single-product/title.php' ) ?>
        </div>
    </div>
    <!--gallery-->
    <div>
        <div class="container container-gallery  mx-auto my-1 lg:my-5 relative" style="position:relative;">
            <?php

            /**
             * Hook: woocommerce_before_single_product_summary.
             *
             * @hooked woocommerce_show_product_sale_flash - 10
             * @hooked woocommerce_show_product_images - 20
             */
            do_action('woocommerce_before_single_product_summary');

            ?>
        </div>
    </div>

    <div class="product_info">
        <div class="container px-4 mx-auto my-5 mt-5 lg:mt-10">
            <div class="flex flex-wrap w-full justify-between">
                <div class="go_back mb-5 lg:mb-0">
                    <a  href="javascript: history.go(-1)" class="transition duration-500 ease-in-out text-green-50  text-lg font-light text-link">← zurück zur Übersicht</a>
                </div>
                <div class="short_desc mb-3 lg:mb-0">
                    <?php  wc_get_template( 'single-product/short-description.php' ) ?>
                </div>
                <div class="link_download text-center">
                    <?php
                        $product_ID  = $product->get_id();
                        $files_download = get_field('list-files-download',$product_ID);
                        if(!empty($files_download)):
                         foreach ($files_download as $value) {
                            if(!empty($value['file']['url'])): ?>
                                <?php
                                $filesize = filesize( get_attached_file( $value['file']['id'] ) );
                                $filesize = size_format($filesize, 1);
                                ?>
                                <a href="<?php echo  $value['file']['url'] ?>"
                                   download="<?php echo  $value['file']['filename'] ?>"
                                   class="transition inline-block mb-2 w-full text-center duration-500 ease-in-out text-green-50 bg-gray-50 px-5 py-4 text-lg font-medium link-download">
                                    <?php echo $value['text'];?>
                                </a>
                            <?php endif;
                        }
                        endif;
                    ?>
                </div>
            </div>

        </div>
    </div>
    <!-- summary, tabs-->
    <div class="container px-4 mx-auto my-5">
        <div class="flex flex-wrap w-full">
            <div class="summary entry-summary">
                <?php
                /**
                 * Hook: woocommerce_single_product_summary.
                 *
                 * @hooked woocommerce_template_single_title - 5
                 * @hooked woocommerce_template_single_rating - 10
                 * @hooked woocommerce_template_single_price - 10
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 * @hooked WC_Structured_Data::generate_product_data() - 60
                 */
                do_action( 'woocommerce_single_product_summary' );
                ?>
            </div>
            <div class="tabs_content">
                <?php
                /**
                 * Hook: woocommerce_after_single_product_summary.
                 *
                 * @hooked woocommerce_output_product_data_tabs - 10
                 * @hooked woocommerce_upsell_display - 15
                 * @hooked woocommerce_output_related_products - 20
                 */
                do_action( 'woocommerce_after_single_product_summary' );
                ?>
            </div>
        </div>
    </div>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
