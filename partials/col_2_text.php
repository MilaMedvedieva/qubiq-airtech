<?php
if ( function_exists('get_field') )
{
    $text_left = get_sub_field('content_left');
    $text_right  = get_sub_field('content_right');

}
?>

<section class="bg-white <?php echo (is_front_page()) ? 'mb-10 mt-10 lg:mb-14 lg:mt-16 ':'mb-14 mt-8 lg:mb-20' ?>">
    <div class="container px-4 mx-auto my-5">
        <div class="grid post-content grid-cols-1 md:grid-cols-2 gap-1 md:gap-11">
            <div class="text-black-10 text-base font-light leading-5">
                <div><?php echo $text_left; ?></div>
            </div>
            <div class="text-black-10 text-base font-light leading-5">
                <div><?php echo $text_right; ?></div>
            </div>
        </div>
    </div>
</section>
