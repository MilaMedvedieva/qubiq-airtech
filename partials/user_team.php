<?php
if ( function_exists('get_field') )
{
    $title = get_sub_field('title');
    $users_list  = get_sub_field('users');}
?>

<?php if ( $users_list ) : ?>
    <section class="bg-white mb-10 mt-10 lg:mb-14 lg:mt-16">
        <div class="container px-4 mx-auto my-5">
            <?php if($title): ?>
                <div class="mb-6 md:mb-12">
                    <h2 class="text-green-50 text-2xl lg:text-4xl font-medium"><?php echo $title; ?></h2>
                </div>
            <?php endif; ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-7 md:gap-11">
                <?php foreach ( $users_list as $key => $value ) :?>
                    <div class="card mb-1 md:mb-7">
                        <div class="mb-8 rounded overflow-hidden bg-gray-50 box-person h-full">
                            <?php if(!empty($value['photo']['url'])) :?>
                                <img src="<?php echo $value['photo']['sizes']['large'] ?>"
                                     data-src="<?php echo $value['photo']['url'] ?>"
                                     class="lazyload h-full w-full object-cover blur-up "
                                     width="100%"
                                     height="100%"
                                     alt="<?php echo $value['photo']['alt'] ?>"
                                     loading="lazy">
                            <?php endif; ?>
                        </div>
                        <div class="card-body">

                            <h3 class="text-green-50 text-xl font-medium mb-1">
                                <?php echo  $value['full_name'] ?>
                            </h3>
                            <p class="text-green-50 text-xl font-light mb-3">
                                <?php echo  $value['position'] ?>
                            </p>

                            <div class="post-content text-black-10 text-base lg:text-lg font-light mb-3 md:mb-6">
                                <?php echo  $value['desc'] ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif;?>
