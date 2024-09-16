<?php
add_action('wp_ajax_filter_referenzen_ajax', 'filter_referenzen_ajax');
add_action('wp_ajax_nopriv_filter_referenzen_ajax', 'filter_referenzen_ajax');

add_action('wp_ajax_post_load_more', 'post_load_more');
add_action('wp_ajax_nopriv_post_load_more', 'post_load_more');

add_action('wp_ajax_post_load_more_with_filter', 'post_load_more_with_filter');
add_action('wp_ajax_nopriv_post_load_more_with_filter', 'post_load_more_with_filter');

add_action('wp_ajax_filter_category_ajax', 'filter_category_ajax');
add_action('wp_ajax_nopriv_filter_category_ajax', 'filter_category_ajax');

add_action('wp_ajax_filter_produktmarke_ajax', 'filter_produktmarke_ajax');
add_action('wp_ajax_nopriv_filter_produktmarke_ajax', 'filter_produktmarke_ajax');


//referenzen begin
function post_load_more(){
    $offset        = array_key_exists('offset', $_POST) ? $_POST['offset'] : false;
    $post_type     = array_key_exists('post_type', $_POST) ? $_POST['post_type'] : false;
    $post_per_page = get_option('posts_per_page');
    $args = [
        'post_type' 		=> $post_type,
        'posts_per_page' => $post_per_page,
        'orderby' 			=> 'date',
        'order'   			=> 'desc',
        'offset'			=> $offset,
        'post_status' => 'publish',
    ];
    $query = new WP_Query($args);

    $new_offset = $offset + $post_per_page;
    ob_start();
    ?>
    <?php  if ( $query->have_posts() ) :  while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php
        $post_id = get_the_ID();
        $img   = get_the_post_thumbnail_url( $post_id, 'full' );
        ?>
        <div class="card mb-7">
            <div class="mb-8 rounded bg-gray-50  overflow-hidden h-40 max-h-40 md:h-56 md:max-h-56 lg:h-72 lg:max-h-72">
                <?php if(!empty($img)) :?>
                    <img src="<?php echo $img ?>"
                         data-src="<?php echo $img ?>"
                         class="lazyload blur-up h-full object-cover"
                         width="100%"
                         height="100%"
                         alt="<?php the_title(); ?>"
                         loading="lazy">
                <?php endif; ?>
            </div>

            <div class="card-body">
                <h3 class="text-green-50 text-lg lg:text-xl font-medium mb-3 lg:mb-6">
                    <?php the_title();?>
                </h3>
                <div class="post-content text-black-50 text-base lg:text-lg font-light mb-3 md:mb-6">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p class="text-blue-50 text-base mt-10"><?php esc_html_e( 'Nichts gefunden.' ); ?></p>
    <?php endif; ?>

    <?php
    $return = ob_get_clean();

    echo json_encode( array('status' 		=> 200,
        'render' 		=> $return,
        'new_offset' 	=> $new_offset ) );
    die;
}

function post_load_more_with_filter(){
    $offset        = array_key_exists('offset', $_POST) ? $_POST['offset'] : false;
    $post_type     = array_key_exists('post_type', $_POST) ? $_POST['post_type'] : false;
    $post_per_page = get_option('posts_per_page');

    $category         = array_key_exists('category', $_POST) ? $_POST['category'] : false;
    $einsatzgebiet    = array_key_exists('einsatzgebiet', $_POST) ? $_POST['einsatzgebiet'] : false;
    $mark             = array_key_exists('mark', $_POST) ? $_POST['mark'] : false;

    if ( $category != 0) {
        $category_args = array(
            'taxonomy' => 'produktkateogrie',
            'field' => 'id',
            'terms' => $category
        );
    }

    if ( $einsatzgebiet != 0) {
        $einsatzgebiet_args = array(
            'taxonomy' => 'einsatzgebiet',
            'field' => 'id',
            'terms' => $einsatzgebiet
        );
    }
    if ( $mark != 0) {
        $mark_args = array(
            'taxonomy' => 'mark',
            'field' => 'id',
            'terms' => $mark
        );
    }


    $args = [
        'post_type' 		=> $post_type,
        'posts_per_page'    => $post_per_page,
        'orderby' 			=> 'date',
        'order'   			=> 'desc',
        'offset'			=> $offset,
        'post_status' => 'publish',
        'tax_query' => array(
            'relation' => 'AND',
            $category_args,
            $einsatzgebiet_args,
            $mark_args
        ),
    ];
    $query = new WP_Query($args);
    $new_offset = $offset + $post_per_page;
    $post_count = $query->post_count;
    ob_start();
    ?>
    <?php  if ( $query->have_posts() ) :  while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php
        $post_id = get_the_ID();
        $img   = get_the_post_thumbnail_url( $post_id, 'full' );
        ?>
        <div class="card mb-7">
            <div class="mb-8 rounded bg-gray-50  overflow-hidden h-40 max-h-40 md:h-56 md:max-h-56 lg:h-72 lg:max-h-72">
                <?php if(!empty($img)) :?>
                    <img src="<?php echo $img ?>"
                         data-src="<?php echo $img ?>"
                         class="lazyload blur-up h-full object-cover"
                         width="100%"
                         height="100%"
                         alt="<?php the_title(); ?>"
                         loading="lazy">
                <?php endif; ?>
            </div>

            <div class="card-body">
                <h3 class="text-green-50 text-lg lg:text-xl font-medium mb-3 lg:mb-6">
                    <?php the_title();?>
                </h3>
                <div class="post-content text-black-50 text-base lg:text-lg font-light mb-3 md:mb-6">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p class="text-blue-50 text-base mt-10"><?php esc_html_e( 'Nichts gefunden.' ); ?></p>
    <?php endif; ?>

    <?php
    $return = ob_get_clean();

    echo json_encode( array('status' 		=> 200,
        'render' 		=> $return,
        'post_count'   => $post_count,
        'new_offset' 	=> $new_offset ) );
    die;
}

function filter_referenzen_ajax(){


    $post_type     = array_key_exists('post_type', $_POST) ? $_POST['post_type'] : false;
    $post_per_page = get_option('posts_per_page');

    $category         = array_key_exists('category', $_POST) ? $_POST['category'] : false;
    $einsatzgebiet    = array_key_exists('einsatzgebiet', $_POST) ? $_POST['einsatzgebiet'] : false;
    $mark             = array_key_exists('mark', $_POST) ? $_POST['mark'] : false;

    if ( $category != 0) {
        $category_args = array(
            'taxonomy' => 'produktkateogrie',
            'field' => 'id',
            'terms' => $category
        );
    }

    if ( $einsatzgebiet != 0) {
        $einsatzgebiet_args = array(
            'taxonomy' => 'einsatzgebiet',
            'field' => 'id',
            'terms' => $einsatzgebiet
        );
    }
    if ( $mark != 0) {
        $mark_args = array(
            'taxonomy' => 'mark',
            'field' => 'id',
            'terms' => $mark
        );
    }
    $args  = [
        'post_type' 		=> $post_type,
        'posts_per_page'    => $post_per_page,
        'orderby' 			=> 'date',
        'order'   			=> 'desc',
        'offset'			=> 0,
        'post_status' => 'publish',
        'tax_query' => array(
            'relation' => 'AND',
            $category_args,
            $einsatzgebiet_args,
            $mark_args
        ),
    ];
    $query = new WP_Query( $args );
    $query_all = new WP_Query([
        'post_type' 		=> $post_type,
        'posts_per_page'    => -1,
        'orderby' 			=> 'date',
        'order'   			=> 'desc',
        'offset'			=> 0,
        'post_status' => 'publish',
        'tax_query' => array(
            'relation' => 'AND',
            $category_args,
            $einsatzgebiet_args,
            $mark_args
        ),
    ]);
    $post_count = $query_all->post_count;
    ob_start(); ?>

    <?php if ( $query->have_posts() ) :  while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php
            $post_id = get_the_ID();
            $img   = get_the_post_thumbnail_url( $post_id, 'full' );
        ?>
        <div class="card mb-7">
            <div class="mb-8 rounded bg-gray-50  overflow-hidden h-40 max-h-40 md:h-56 md:max-h-56 lg:h-72 lg:max-h-72">
                <?php if(!empty($img)) :?>
                    <img src="<?php echo $img ?>"
                         data-src="<?php echo $img ?>"
                         class="lazyload blur-up h-full object-cover"
                         width="100%"
                         height="100%"
                         alt="<?php the_title(); ?>"
                         loading="lazy">
                <?php endif; ?>
            </div>

            <div class="card-body">
                <h3 class="text-green-50 text-lg lg:text-xl font-medium mb-3 lg:mb-6">
                    <?php the_title();?>
                </h3>
                <div class="post-content text-black-50 text-base lg:text-lg font-light mb-3 md:mb-6">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p class="text-blue-50 text-base mt-10"><?php esc_html_e( 'Nichts gefunden.' ); ?></p>
    <?php endif; ?>
    <?php
    $return = ob_get_clean();
    echo json_encode( array('status' 		=> 200,
        'render' 		=> $return,
        'post_count'   => $post_count) );
    die;
}

//referenzen end



//category
function filter_category_ajax(){

    $category        = array_key_exists('cat_id', $_POST) ? $_POST['cat_id'] : false;
    $einsatzgebiet   = array_key_exists('einsatzgebiet', $_POST) ? $_POST['einsatzgebiet'] : false;

    $series_category = [];

    if ( $category != 0) {
        $category_args = array(
            'taxonomy' => 'product_cat',
            'field' => 'id',
            'terms' => $category
        );
    }

    if ( $einsatzgebiet != 0) {
        $einsatzgebiet_args = array(
            'taxonomy' => 'product_tag',
            'field' => 'id',
            'terms' => $einsatzgebiet
        );
    }

    $query = new WC_Product_Query(array(
        'limit' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status'       => 'publish',
        'tax_query' => array(
            'relation' => 'AND',
            $category_args,
            $einsatzgebiet_args
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
    ob_start(); ?>
    <?php if(!empty($series_category)): ?>
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
                <div class="mb-8 rounded bg-gray-50 overflow-hidden h-36 max-h-36 md:h-56 md:max-h-56 lg:h-72 lg:max-h-72">
                    <?php if(!empty($term_image)): ?>
                        <a href="/<?=$term_tax?>/<?=$term_slug?>?current=<?=$category?>" class="block h-full opacity-7 transform scale-110 transition ease-in-out duration-300 hover:opacity-1 hover:scale-100">
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
                    <a href="/<?=$term_tax?>/<?=$term_slug?>?current=<?=$category?>">
                        <h3 class="text-green-50 text-lg lg:text-xl font-medium mb-2 lg:mb-3 lg:mb-6 transition duration-500 ease-in-out hover:text-blue-100">
                            <?php echo (!empty($term_title)) ? $term_title : $term_name ; ?>
                        </h3>
                    </a>

                    <div class="text-black-10 text-base lg:text-lg font-light mb-3 lg:mb-6">
                        <?php echo $term_desc ?>
                    </div>

                    <?php if(!empty($term_link)): ?>
                        <a href="/<?=$term_tax?>/<?=$term_slug?>?current=<?=$category?>" class="transition duration-500 ease-in-out text-green-50  text-base lg:text-lg font-light text-link">
                            <?php _e('Zu den Produkten der Serie'); ?>
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="mb-3 md:mb-6">
            <?php echo do_action( 'woocommerce_no_products_found' ); ?>
        </div>
    <?php endif;?>

    <?php
    $return = ob_get_clean();
    $output = array(
        'status' 		=> 200,
        'render' 		=> $return,
    );

    echo json_encode( $output );

    die;
}

//produktmarke
function filter_produktmarke_ajax(){

    $category        = array_key_exists('category', $_POST) ? $_POST['category'] : false;
    $einsatzgebiet   = array_key_exists('einsatzgebiet', $_POST) ? $_POST['einsatzgebiet'] : false;
    $current_tax_id   = array_key_exists('current_tax_id', $_POST) ? $_POST['current_tax_id'] : false;

    $series_category = [];

    if ( $category != 0) {
        $category_args = array(
            'taxonomy' => 'product_cat',
            'field' => 'id',
            'terms' => $category
        );
    }

    if ( $current_tax_id != 0) {
        $mark_args = array(
            'taxonomy' => 'produktmarke',
            'field' => 'id',
            'terms' => $current_tax_id
        );
    }

    if ( $einsatzgebiet != 0) {
        $einsatzgebiet_args = array(
            'taxonomy' => 'product_tag',
            'field' => 'id',
            'terms' => $einsatzgebiet
        );
    }

    $query = new WC_Product_Query(array(
        'limit' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status'       => 'publish',
        'tax_query' => array(
            'relation' => 'AND',
            $category_args,
            $einsatzgebiet_args,
            $mark_args
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
    ob_start(); ?>
    <?php if(!empty($series_category)): ?>
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
            <div class="card mb-7">
                <div class="mb-8 rounded bg-gray-50 overflow-hidden h-40 max-h-40 md:h-56 md:max-h-56 lg:h-72 lg:max-h-72">
                    <?php if(!empty($term_image)): ?>
                        <a href="/<?=$term_tax?>/<?=$term_slug?>?current=<?=$current_tax_id?>"
                           class="block h-full opacity-7 transform scale-110 transition ease-in-out duration-300 hover:opacity-1 hover:scale-100">
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

                    <a href="/<?=$term_tax?>/<?=$term_slug?>?current=<?=$current_tax_id?>">
                        <h3 class="text-green-50 text-lg lg:text-xl font-medium mb-3 lg:mb-6 transition duration-500 ease-in-out hover:text-blue-100">
                            <?php echo (!empty($term_title)) ? $term_title : $term_name ; ?>
                        </h3>
                    </a>

                    <div class="text-black-10 text-base lg:text-lg font-light mb-3 md:mb-6">
                        <?php echo $term_desc ?>
                    </div>

                    <?php if(!empty($term_link)): ?>
                        <a href="/<?=$term_tax?>/<?=$term_slug?>?current=<?=$current_tax_id?>" class="transition duration-500 ease-in-out text-green-50  text-base lg:text-lg font-light text-link">
                            <?php esc_html_e( 'Zu den Produkten der Serie' ); ?>
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="mb-3 md:mb-6">
            <?php echo do_action( 'woocommerce_no_products_found' ); ?>
        </div>
    <?php endif;?>

    <?php
    $return = ob_get_clean();
    $output = array(
        'status' 		=> 200,
        'render' 		=> $return,
    );

    echo json_encode( $output );

    die;
}

