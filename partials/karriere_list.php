<?php
if ( function_exists('get_field') )
{
    $small_heading = get_sub_field('small_heading');
    $karriere_list  = get_sub_field('list');

}
?>
<section class="bg-white  mb-10 mt-10 lg:mb-20 lg:mt-16">
    <div class="container px-4 mx-auto my-5">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-4 lg:gap-11">
            <?php foreach ( $karriere_list as $key => $value ) :?>
                <?php $subtitle = get_field('subtitle',$value->ID); ?>
                <article class="bg-gray-50 p-2.5 article_karriere">
                    <a href="<?php echo get_permalink( $value->ID );?>" target="_self">
                        <span class="block text-black-50 font-light font-lg mb-5"><?php echo $small_heading;?></span>
                        <h2 class="text-green-50 mb-5  text-xl md:text-2xl lg:text-4xl font-medium">
                            <?php echo $value->post_title; ?>
                        </h2>
                        <h3 class="text-green-50 text-xl"><?php echo $subtitle; ?></h3>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>