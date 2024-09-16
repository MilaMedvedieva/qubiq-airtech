<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>
    <section class="bg-white mb-14 mt-8 lg:mb-20">
        <div class="container px-4 mx-auto my-5">
            <div class="text-right text-green-50 text-2xl lg:text-4xl font-medium mb-8">
               <h1><?php single_post_title(); ?></h1>
            </div>
            <div class="text-black-50 text-base post-content lg:text-lg font-light leading-8">
                <?php
                    the_content();
                ?>
            </div>
        </div>
    </section>

<?php
get_footer();
