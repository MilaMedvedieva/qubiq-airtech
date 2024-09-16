<?php get_header(); ?>
<section class="bg-white mb-10 mt-10 lg:mb-14 lg:mt-16">
    <div class="container px-4 mx-auto my-5">
        <h1 class="text-right text-black-50 text-4xl lg:text-9xl font-medium mb-8">
            <?php _e('404', 'html5blank'); ?>
        </h1>

        <div class="text-center my-9 wrap_404">
            <a href="<?php echo site_url() ?>" class="transition duration-500 ease-in-out text-green-50  text-lg font-light text-link">
                <?php _e('Zurück zur Startseite', 'html5blank'); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
