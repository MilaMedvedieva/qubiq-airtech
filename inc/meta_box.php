<?php

add_action( 'init', 'custom_taxonomy_produktserie' );
add_action( 'init', 'custom_taxonomy_produktmarken' );

function custom_taxonomy_produktserie()  {
    $labels = array(
        'name'              => 'Product Serie',
        'singular_name'     => 'Product Serie',
    );
    $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
);

register_taxonomy( 'produktserie', 'product', $args );
register_taxonomy_for_object_type( 'produktserie', 'product' );
}

function custom_taxonomy_produktmarken()  {
    $labels = array(
        'name'              => 'Produkt Marke',
        'singular_name'     => 'Produkt Marke',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );

    register_taxonomy( 'produktmarke', 'product', $args );
    register_taxonomy_for_object_type( 'produktmarke', 'product' );
}