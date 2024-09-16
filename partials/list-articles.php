<?php
if ( function_exists('get_field') )
{
    $title = get_sub_field('title');
    $articles  = get_sub_field('list');
    $column = get_sub_field('column');


}
?>
<?php if ( $articles ) : ?>
<section class="bg-white mb-4 md:mb-10 mt-7 md:mt-10 lg:mb-14 lg:mt-16">
    <div class="container px-4 mx-auto my-5">
        <?php if($title): ?>
        <div class="mb-6 md:mb-12">
            <h2 class="text-green-50 text-2xl md:text-3xl lg:text-4xl font-medium"><?php echo $title; ?></h2>
        </div>
        <?php endif; ?>
        <div class="grid grid-cols-1 md:grid-cols-<?php echo $column?> gap-1 md:gap-4 lg:gap-11">
        <?php foreach ( $articles as $key => $value ) :?>
        <?php $contact = $value['contact_information']; ?>
            <div class="card mb-4 lg:mb-7">
                <div class="mb-4 lg:mb-8 rounded bg-gray-50 overflow-hidden h-<?= ($column == '3')? '40' :'36'; ?> max-h-<?= ($column == '3')? '40' :'36'; ?> md:h-<?= ($column == '3')? '40' :'56'; ?> md:max-h-<?= ($column == '3')? '36' :'56'; ?> lg:h-<?= ($column == '3')? '40' :'64'; ?> lg:max-h-<?= ($column == '3')? '40' :'64'; ?>">
                    <?php if(!empty($value['image']['url'])) :?>
                        <img src="<?php echo $value['image']['sizes']['large'] ?>"
                             data-src="<?php echo $value['image']['url'] ?>"
                             class="blur-up lazyload h-full w-full object-cover"
                             width="100%"
                             height="100%"
                             alt="<?php echo $value['image']['alt'] ?>"
                             loading="lazy">
                    <?php endif; ?>
                </div>
                <div class="card-body">

                    <h3 class="text-green-50 text-lg lg:text-xl font-medium mb-3 lg:mb-6">
                        <?php echo  $value['title'] ?>
                    </h3>

                    <div class="text-black-10 text-base lg:text-lg font-light mb-3 md:mb-6">
                        <?php echo  $value['content'] ?>
                    </div>

                    <?php if(!empty($contact['phone']) || !empty($contact['e-mail'])): ?>
                    <div class="mb-3">
                        <a href="mailto:<?php echo  $contact['e-mail'];?>" class="transition duration-500 ease-in-out text-green-50 hover:text-black-50  text-base lg:text-lg  font-light">
                            <?php echo $contact['e-mail']; ?>
                        </a>
                        <span class="px-1 text-green-50  text-lg font-light">|</span>
                        <a href="tel:<?php echo $contact['phone'];?>" class="transition duration-500 ease-in-out text-green-50 hover:text-black-50  text-base lg:text-lg font-light">
                            <?php echo $contact['phone']; ?>
                        </a>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($value['link'] )): ?>
                     <a href="<?php echo  $value['link']['url'] ?>" class="transition duration-500 ease-in-out text-green-50  text-base lg:text-lg font-light text-link" data-hover="<?php echo  $value['link']['title'] ?>" target="<?php echo ($value['link']['target']) ? '_blank' : '_self';  ?>">
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