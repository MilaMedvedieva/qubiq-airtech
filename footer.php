<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Qubiq_Airtech
 */


if (function_exists('get_field')) {
    $phone = get_field('footer_phone', 'options');
    $email = get_field('footer_email', 'options');
    $address = get_field('footer_address', 'options');
    $policy = get_field('footer_policy', 'options');
    $options = get_field('scripts_in_footer', 'options');
}


?>
    </main>
	<footer class="site-footer bg-gray-50" role="contentinfo">
        <div class="container py-4 px-4">
            <div class="sm:py-6">
                <div class="flex-col hidden md:block text-center sm:text-right mt-3 mb-3 sm:mt-0" role="navigation">
                    <?php footer_nav(); ?>
                </div>
                <div class="sm:flex sm:items-center">
                    <div class="md:mr-8  text-sm md:text-base text-black-50">
                        <p class="text-base md:font-medium mb-2 md:mb-5"> <?=$policy;?></p>
                        <address class="font-light not-italic">
                            <?=$address;?>
                        </address>
                    </div>
                    <div class="mt-4 sm:mt-11 text-sm md:text-base text-black-50 font-light">
                        <a href="tel:<?=$phone;?>" class="block"><?=$phone;?></a>
                        <a href="mailto:<?=$email;?>" class="block"><?=$email;?></a>
                    </div>
                </div>
            </div>
        </div>
	</footer>

<?php wp_footer(); ?>
<?php
    if(!empty($options)){
        echo $options;
    }
?>

</body>
</html>
