<?php
/* Template Name: Inner Text  */
get_header();
?>
    <section class="bg-white mb-7 md:mb-14 lg:mb-20 pt-4 lg:pt-8">
        <div class="container px-4 mx-auto my-5">
            <h1 class="text-right text-black-50 text-4xl lg:text-5xl font-medium mb-8">
                <?php echo the_title(); ?>
            </h1>
            <div class="text-black-10 post-content text-base md:text-xl lg:text-xl font-light leading-6 lg:leading-7">
                <?php echo the_content(); ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
