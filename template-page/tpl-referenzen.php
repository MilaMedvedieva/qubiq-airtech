<?php
/* Template Name: Referenzen  */
get_header();

global $wp_query;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$max_num_page =  $wp_query->max_num_pages;
$post_per_page = get_option('posts_per_page');

$terms_category = get_terms([
    'taxonomy' => 'produktkateogrie',
    'hide_empty' => false,
    'orderby' => 'name',
    'order' => 'DESC'
]);

$terms_einsatzgebiet = get_terms([
    'taxonomy' => 'einsatzgebiet',
    'hide_empty' => false
]);

$terms_mark = get_terms([
    'taxonomy' => 'mark',
    'hide_empty' => false
]);


$args = [
    'post_type' => 'referenzen',
    'posts_per_page' => $post_per_page,
    'orderby' 			=> 'date',
    'order'   			=> 'desc',
    'offset'			=> 0,
    'post_status' => 'publish',
];

$query = new WP_Query($args);
?>

    <section class="bg-white mb-10 pt-4 lg:pt-8 lg:mb-20">
        <div class="container px-4 mx-auto my-5">
            <h1 class="text-right text-black-50 text-4xl lg:text-5xl font-medium mb-8">
                <?php the_title(); ?>
            </h1>
        </div>
    </section>

    <?php if ( $query->have_posts() ) : ?>
    <section>
        <div class="container px-4 mx-auto my-5">
            <h4 class="text-2xl text-black-50 font-medium mb-7"><?php esc_html_e( 'Filtern' ); ?></h4>
            <form action="#" method="post" accept-charset="utf-8" class="text-base lg:text-lg text-black-50 font-light filter_referenzen" id="filter_referenzen">
                <div class="lg:flex items-center mb-3 lg:mb-7">
                    <label class="mr-2 mb-2 lg:pointer-events-none category-label">
                        <?php esc_html_e( 'nach Produktkateogrie' ); ?>
                        <span class="inline-block ml-1 lg:hidden caret"><svg width="10" height="13" viewBox="0 0 10 13" fill="none"><path d="M10 6.5L0.25 12.1292V0.870835L10 6.5Z" fill="#475D63"/></svg></span>
                    </label>
                    <div class="hidden lg:block category mt-4 lg:mt-0">
                        <?php
                        if ( isset($terms_category) && !empty($terms_category) ) {
                            foreach ($terms_category as $key => $value) {

                                    ?>
                                <label for="<?php echo $value->name ?>" class="inline-block mx-1 lg:mx-2 mb-2 transform -skew-x-12 <?php echo $value->name ?>">
                                    <input type="radio"  name="category"  id="<?php echo $value->name ?>"  value="<?php echo $value->term_id ?>" class="d-none hidden">
                                    <p class="cursor-pointer mb-0 inline-block rounded bg-gray-50 transition duration-500 ease-in-out">
                                       <span class="px-4 py-1 inline-block transform skew-x-12"><?php echo $value->name ?></span>
                                    </p>
                                </label>

                                <?php
                            }
                        }
                        ?>
                        <label for="all_catefory" class="inline-block mx-1 lg:mx-2 mb-2 mb-2 transform -skew-x-12">
                            <input class="d-none hidden" type="radio"  name="category"  id="all_catefory"  value="0" checked>
                            <p class="cursor-pointer mb-0 inline-block rounded bg-gray-50 transition duration-500 ease-in-out">
                               <span class="px-4 py-1 inline-block transform skew-x-12"><?php esc_html_e( 'Alle' ); ?></span>
                            </p>
                        </label>
                    </div>
                </div>
                <div class="lg:flex items-center mb-3 lg:mb-7">
                    <label class="mr-2 mb-2  lg:pointer-events-none einsatzgebiet-label">
                        <?php esc_html_e( 'nach Einsatzgebiet' ); ?>
                        <span class="inline-block ml-1 lg:hidden caret"><svg width="10" height="13" viewBox="0 0 10 13" fill="none"><path d="M10 6.5L0.25 12.1292V0.870835L10 6.5Z" fill="#475D63"/></svg></span>
                    </label>
                    <div class="einsatzgebiet hidden lg:block mt-4 lg:mt-0">
                        <?php
                        if ( isset($terms_einsatzgebiet) && !empty($terms_einsatzgebiet) ) {
                            foreach ($terms_einsatzgebiet as $key => $value) {
                                ?>
                                <label for="<?php echo $value->name ?>" class="inline-block mx-1 lg:mx-2  mb-2 transform -skew-x-12 <?php echo $value->name ?>">
                                    <input type="radio"  name="einsatzgebiet"  id="<?php echo $value->name ?>"  value="<?php echo $value->term_id ?>" class="d-none hidden">
                                    <p class="cursor-pointer mb-0 inline-block rounded bg-gray-50 transition duration-500 ease-in-out">
                                        <span class="px-4 py-1 inline-block transform skew-x-12"><?php echo $value->name ?></span>
                                    </p>
                                </label>
                                <?php
                            }
                        }
                        ?>
                        <label for="all_einsatzgebiet" class="inline-block mx-1 lg:mx-2 mb-2 transform -skew-x-12">
                            <input class="d-none hidden" type="radio"  name="einsatzgebiet"  id="all_einsatzgebiet"  value="0" checked>
                            <p class="cursor-pointer mb-0 inline-block rounded bg-gray-50 transition duration-500 ease-in-out">
                                <span class="px-4 py-1 inline-block transform skew-x-12"><?php esc_html_e( 'Alle' ); ?></span>
                            </p>
                        </label>
                    </div>
                </div>
                <div class="lg:flex items-center mb-3 lg:mb-7">
                    <label class="mr-2 mb-2 lg:pointer-events-none mark-label">
                        <?php esc_html_e( 'nach Mark' ); ?>
                        <span class="inline-block ml-1 lg:hidden caret"><svg width="10" height="13" viewBox="0 0 10 13" fill="none"><path d="M10 6.5L0.25 12.1292V0.870835L10 6.5Z" fill="#475D63"/></svg></span>
                    </label>
                    <div class="mark hidden lg:block mt-4 lg:mt-0">
                        <?php
                        if ( isset($terms_mark) && !empty($terms_mark) ) {
                            foreach ($terms_mark as $key => $value) {
                                $term = get_term($value);
                                $logo_image = get_field("logo", $term);
                                ?>
                                <label for="<?php echo $value->name ?>" class="inline-block mx-1 lg:mx-2 mb-2 transform -skew-x-12 <?php echo $value->name ?>">
                                    <input type="radio"  name="mark"  id="<?php echo $value->name ?>"  value="<?php echo $value->term_id ?>" class="d-none hidden">
                                    <p class="cursor-pointer mb-0 inline-block rounded bg-gray-50 transition duration-500 ease-in-out">
                                        <?php if(!empty($logo_image)):?>
                                            <img class="px-4 py-1 w-28 object-contain h-9 inline-block transform skew-x-12" src="<?=$logo_image; ?>" alt="<?php echo $value->name ?>">
                                        <?php else:?>
                                            <span class="px-4 py-1 inline-block transform skew-x-12"><?php echo $value->name ?></span>
                                        <?php endif;?>
                                    </p>
                                </label>
                                <?php
                            }
                        }
                        ?>
                        <label for="all_mark" class="inline-block mx-1 lg:mx-2 mb-2 transform -skew-x-12">
                            <input class="d-none hidden" type="radio"  name="mark"  id="all_mark"  value="0" checked>
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

    <section class="bg-white mb-0 mt-10 lg:mb-14 lg:mt-16">
       <div class="container px-4 mx-auto my-5">
           <div class="text-center mb-10 hidden preload">
               <span class="preloader-speeding-wheel"></span>
           </div>
           <?php if ( $query->have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-1 md:gap-4 lg:gap-11 render_this">
            <?php while ( $query->have_posts() ) {
                          $query->the_post();
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
           <?php
              }
              wp_reset_postdata();
            ?>
          </div>
           <?php else: ?>
             <p class="text-blue-50 text-base mt-10 text-center"><?php esc_html_e( 'Keine Referenzen Gefunden.' ); ?></p>
            <?php endif;?>
       </div>
    </section>

    <?php if ($query->have_posts()): ?>
        <section class="bg-white mb-10 mt-10 lg:mb-14 lg:mt-16 post_nav">
            <div class="container px-4 mx-auto my-5">
                <div class="text-center mb-10">
                    <input id="posts_offset_default" type="hidden" value="<?= $post_per_page;?>">
                    <div class="wrap_load_more">
                        <input id="posts_count" type="hidden" value="<?= $query->found_posts;?>">
                        <input id="posts_offset" type="hidden" value="<?= $post_per_page;?>">
                        <input id="posts_type" type="hidden" value="referenzen">
                        <?php if ( $query->found_posts > $post_per_page ): ?>
                            <a href="#" class="transition duration-500 ease-in-out text-green-50  text-lg font-light text-link post_load_more" >
                                <?php esc_html_e( 'Weitere Beiträge' ); ?>
                            </a>
                        <?php endif;?>
                    </div>
                    <div class="with_filter_load_more hidden">
                        <input id="posts_count_with_filter" type="hidden" value="<?= $query->found_posts;?>">
                        <input id="offset_with_filter" type="hidden" value="<?= $post_per_page; ?>">
                        <a href="#" class="transition duration-500 ease-in-out text-green-50  text-lg font-light text-link" id="post_load_more_with_filter" >
                            <?php esc_html_e( 'Weitere Beiträge' ); ?>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

<?php
get_footer();
?>