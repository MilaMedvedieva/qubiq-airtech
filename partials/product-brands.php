<?php
if ( function_exists('get_field') )
{
    $brands_list = get_sub_field('brands');
}

if(isset($brands_list) and !empty($brands_list)):
?>

    <section class="bg-gray-50  py-1">
    <div class="container  mx-auto">
        <div class="md:mx-12">
            <div class="grid grid-cols-3 gap-1 mx-1 mx-5 md:mx-12 produktlogos">
            <?php foreach ( $brands_list as $key => $value ) :?>
                <figure class="rounded bg-white   transition duration-500 ease-in-out transform -skew-x-12">
                    <a href="<?= $value['url'];?>" class="transform skew-x-12 flex items-center h-14 sm:h-32 justify-center">

                        <img src="<?= $value['image'];?>"
                             data-src="<?= $value['image'];?>"
                             class="blur-up lazyload"
                             width="100%"
                             height="100%"
                             alt=""
                             loading="lazy">
                    </a>
                </figure>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>