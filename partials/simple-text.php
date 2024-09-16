<?php
if ( function_exists('get_field') )
{
    $title = get_sub_field('title');
    $text_align  = get_sub_field('text_align');
    $content = get_sub_field('content');
    $heading = get_sub_field('heading');

}
?>

<section class="bg-white <?php echo (is_front_page()) ? ' mb-7 md:mb-10 pt-7 md:mt-10 lg:mb-14 lg:mt-16 ':'mb-14 pt-4 lg:pt-8 lg:mb-20' ?>">
    <div class="container px-4 mx-auto my-5">
        <<?=$heading?> class="text-<?php echo $text_align; ?> text-black-50 text-2xl md:text-4xl lg:text-5xl font-medium mb-5 md:mb-8">
            <?php echo $title; ?>
        </<?=$heading?>>
        <div class="text-black-50 text-lg md:text-xl lg:text-2xl font-light leading-6 md:leading-8">
            <?php echo $content; ?>
        </div>
    </div>
</section>
