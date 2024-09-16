<?php

if (function_exists('register_sidebar')){

    register_sidebar(array(
        'name' => __('Sidebar for Referenzez', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'sidebar',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}
