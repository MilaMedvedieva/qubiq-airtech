<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Qubiq_Airtech
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

    <?php wp_head(); global $SVG; ?>

    <?php
    if (function_exists('get_field')) {
        $options_h = get_field('scripts_in_head', 'options');
    }


    if (!empty($options_h)) {
        echo $options_h;
    }

    ?>
</head>

<body <?php body_class(); ?>>


	<header class="site-header  z-50 fixed">
        <div class="bg-white py-4 md:py-5">
            <div class="container px-4 mx-auto md:flex md:items-center">
                <div class="flex justify-between items-center">
                    <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>" class="d-flex">
                        <img src="/wp-content/uploads/2021/10/Produktlogos_Qubiq.svg" alt="<?php bloginfo('name'); ?>" width="108px" height="17px">
                    </a>
                </div>
                <nav role="navigation" class="mobile_menu text-white p-5">
                    <div class="mobile_menu_scroll mt-11 pb-11">
                        <div><?php theme_nav(); ?></div>
                        <div class="menu_footer"> <?php secondary_header_nav(); ?></div>
                    </div>
                </nav>
                <div class="hidden main-menu md:flex flex-col md:flex-row md:ml-auto mt-3 md:mt-0">
                    <nav role="navigation" >
                        <?php theme_nav(); ?>
                    </nav>
                </div>
                <div class="md:hidden">
                    <span class="menuBtn">
                        <span class="lines"></span>
                    </span>
                </div>
            </div>
        </div>
	</header>


    <main id="primary" class="site-main">

