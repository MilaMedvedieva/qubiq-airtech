<?php
if ( function_exists('get_field') )
{
    $title = get_sub_field('title');
    $articles  = get_sub_field('list');
    $column = get_sub_field('column');


}
?>
<?php if ( $articles ) : ?>
    <section class="bg-white mb-10 mt-10 lg:mb-14 lg:mt-16">
        <div class="container px-4 mx-auto my-5">
            <?php if($title): ?>
                <div class="mb-6 md:mb-12">
                    <h2 class="text-green-50 text-2xl lg:text-4xl font-medium"><?php echo $title; ?></h2>
                </div>
            <?php endif; ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-4 lg:gap-11">
                <?php foreach ( $articles as $key => $value ) :?>
                    <div class="card mb-7">
                        <div class="mb-4 lg:mb-6 rounded bg-gray-50 overflow-hidden h-40 max-h-40">
                            <?php if(!empty($value['logo']['url'])) :?>
                                <img src="<?php echo $value['logo']['sizes']['large'] ?>"
                                     data-src="<?php echo $value['logo']['url'] ?>"
                                     class="lazyload blur-up h-full object-cover"
                                     width="100%"
                                     height="100%"
                                     alt="<?php echo $value['logo']['alt'] ?>"
                                     loading="lazy">
                            <?php endif; ?>
                        </div>
                        <h3 class="text-green-50 text-lg lg:text-xl font-medium mb-1 lg:mb-2">
                            <?php echo  $value['title'] ?>
                        </h3>
                        <?php if(!empty($value['download_file']['url'])): ?>
                        <?php
                            $filesize = filesize( get_attached_file( $value['download_file']['id'] ) );
                            $filesize = size_format($filesize, 1);
                            ?>
                            <a href="<?php echo  $value['download_file']['url'] ?>"
                               download="<?php echo  $value['download_file']['filename'] ?>"
                               class="transition duration-500 ease-in-out text-green-50 text-base lg:text-lg font-light text-link">
                                <?php echo $value['label_download'];?> (<?php echo $filesize;  ?>)
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif;?>
