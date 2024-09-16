<?php
//referenzen
add_action('init', 'create_referenzen' );
add_action('init', 'create_tax_category_referenzen');
add_action('init', 'create_tax_einsatzgebiet_referenzen');
add_action('init', 'create_tax_mark_referenzen');

add_action('init', 'create_karriere' );

function create_referenzen(){
    register_post_type('referenzen',
        array(
            'labels' => array(
                'name'          => __('Referenzen'),
                'singular_name' => __('Referenzen'),
                'menu_name'     => __('Referenzen'),
            ),
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'hierarchical' => false,
            'has_archive' => false,
            'menu_icon'  => 'dashicons-list-view',
            'supports' => array('title', 'editor', 'thumbnail'),
        ));
}

function create_tax_category_referenzen(){
    $labels = array(
        'name'              => 'Produkt Kateogrie Referenzen',
        'singular_name'     => 'Produkt Kateogrie Referenzen',
    );
    $args = array(
        'label'                 => '',
        'labels'                => $labels,
        'description'           => '',
        'public'                => true,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'hierarchical'          => false,
        'has_archive'           => false,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        'capabilities'          => array(),
        'meta_box_cb'           => 'post_categories_meta_box',
        'show_admin_column'     => true,
    );
    register_taxonomy('produktkateogrie', array('referenzen'), $args );
}

function create_tax_einsatzgebiet_referenzen(){
    $labels = array(
        'name'              => 'Einsatzgebiet Referenzen',
        'singular_name'     => 'Einsatzgebiet Referenzen',
    );
    $args = array(
        'label'                 => '',
        'labels'                => $labels,
        'description'           => '',
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'hierarchical'          => false,
        'has_archive'           => false,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        'capabilities'          => array(),
        'meta_box_cb'           => 'post_categories_meta_box',
        'show_admin_column'     => true,
    );
    register_taxonomy('einsatzgebiet', array('referenzen'), $args );
}

function create_tax_mark_referenzen(){
    $labels = array(
        'name'              => 'Mark Referenzen',
        'singular_name'     => 'Mark Referenzen',
    );
    $args = array(
        'label'                 => '',
        'labels'                => $labels,
        'description'           => '',
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'hierarchical'          => false,
        'has_archive'           => false,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        'capabilities'          => array(),
        'meta_box_cb'           => 'post_categories_meta_box',
        'show_admin_column'     => true,
    );
    register_taxonomy('mark', array('referenzen'), $args );
}

function create_karriere(){
    register_post_type('karriere',
        array(
            'labels' => array(
                'name'          => __('Karriere'),
                'singular_name' => __('Karriere'),
            ),
            'public' => true,
            'menu_icon'  => 'dashicons-hammer',
            'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
            'has_archive' => false,
            'supports' => array('title', 'editor'),
        ));
}

