<?php
if ( function_exists('get_field') )
{
    $articles  = get_sub_field('list');

}
?>
<?php if ( $articles ) : ?>
    <section class="presse-block bg-white mb-10 mt-10 lg:mb-14 lg:mt-16">
        <div class="container px-4 mx-auto my-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4 lg:gap-11">
                <?php foreach ( $articles as $key => $value ) :?>
                    <div class="card flex mb-4 lg:mb-7 p-4 lg:p-8 flex-wrap w-full bg-gray-50">
                        <?php if(!empty($value['logo']['url'])) :?>
                        <div class="card-image mb-8 md:h-16 md:max-h-16">
                            <img src="<?php echo $value['logo']['sizes']['large'] ?>"
                                 data-src="<?php echo $value['logo']['url'] ?>"
                                 class="lazyload blur-up"
                                 width="100%"
                                 height="100%"
                                 alt="<?php echo $value['logo']['alt'] ?>"
                                 loading="lazy">
                        </div>
                        <?php endif; ?>
                        <div class="card-body md:pl-6 lg:pl-12 pb-3">
                            <?php if(!empty($value['date_published'] )): ?>
                                <span class="text-black-50 block text-sm lg:text-lg font-light mb-7 lg:mb-14">
                                     <?php echo  $value['date_published'] ?>
                                </span>
                            <?php endif; ?>
                            <?php if(!empty($value['link'] )): ?>
                                <a href="<?php echo  $value['link']['url'] ?>" class="transition duration-500 ease-in-out text-green-50  text-base lg:text-xl leading-5 lg:leading-7 font-medium hover:text-black-50" target="<?php echo ($value['link']['target'] ) ? '_blank' : '_self';  ?>">
                                    <?php echo  $value['link']['title'] ?>
                                </a>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif;?>
