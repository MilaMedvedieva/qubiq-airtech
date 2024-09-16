<?php
if ( function_exists('get_field') )
{
    $map = get_sub_field('map');

}
?>

<section class="map-block bg-white <?php echo (is_front_page()) ? 'mb-10 mt-10 lg:mb-14 lg:mt-16 ':'mb-14 mt-8 lg:mb-20' ?>">
    <div class="mx-auto my-5">
        <div class="text-black-50 text-xl lg:text-2xl font-light leading-8">
            <?php echo $map; ?>
        </div>
    </div>
</section>
