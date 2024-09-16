<?php
if ( function_exists('get_field') )
{
    $items  = get_sub_field('items');


}
?>
<?php if ( $items ) : ?>

<section class="bg-white">
    <div class="container mx-auto w100">
        <div class="home-slider relative">
            <?php foreach( $items as $image ): ?>
                <div class="image">
                    <?php  echo wp_get_attachment_image( $image['id'], 'full' ); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>