<?php
if ( function_exists('get_field') )
{
    $contact_form = get_sub_field('contact_form');
    $information  = get_sub_field('information');

}
?>

<section class="contact-form bg-white mb-9  mt-4 lg:mt-8 lg:mb-20">
    <div class="container px-4 mx-auto my-5">
        <div class="items-baseline hidden"></div>
        <div class="flex flex-wrap">
            <div class="wrap-form mb-4">
                <?php echo do_shortcode('[contact-form-7 id="'.$contact_form.'"]'); ?>
            </div>
            <div class="wrap-information  md:pl-7 lg:pl-20 text-green-50  text-base lg:text-lg leading-8 lg:leading-8">
                <?php echo $information; ?>
            </div>
        </div>
    </div>
</section>

