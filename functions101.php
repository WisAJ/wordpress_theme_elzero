<?php
require('class-wp-bootstrap-navwalker.php');

/*  
    my functions in elzero theme 
*/

// add feature image support 
add_theme_support('post-thumbnails');


function elzero_add_style()
{
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/source/css/bootstrap.min.css');
    // if I use RTL bootstrab 
    // wp_enqueue_style('bootstrap-rtl-css', get_template_directory_uri() . '/source/css/bootstrap_rtl.min.css'); 
    wp_enqueue_style('fontawsome-css', get_template_directory_uri() . '/source/css/all.fonts.min.css');
    wp_enqueue_style('main', get_template_directory_uri() . '/source/css/main.css');
}

function elzero_add_script()
{
    // false at the end to make JS scripts at the end of page before </head> 
    // NOTICE: jquesry is already in WordPress!
    // wp_enqueue_script('jquery-js', get_template_directory_uri() . '/source/js/jquery.min.js', array(), false, true);
    // wp_enqueue_script('jquery');  // make before bootsape 
    // maybe bootsrap bundle do all stuff. if so I will delete bootstrap.js or just bootstrap is enough

    // remove registration from old jquery 
    wp_deregister_script('jquery');
    // add register script in the footer 
    wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), array(), false, true);
    // enque jquery in footer 
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/source/js/bootstrap.min.js', array('jquery'), false, true);
    // wp_enqueue_script('bootstrap-bundle-js', get_template_directory_uri() . '/source/js/bootstrap.bundle.min.js', array('jquery'), false, true); 
    wp_enqueue_script('main-js', get_template_directory_uri() . '/source/js/main.js', array(), false, true);

    // DECLAIMER: IN BOOTSTRAP4 THERE IS NO NEED FOR THESE JS FILES
    // these TWO js files to make style good in OLD browsers 
    wp_enqueue_script('html5shiv', get_template_directory_uri() . '/source/js/html5shiv.min.js'); // we need it in HEADER 
    wp_script_add_data('html5shiv', 'conditional', 'lt IE 9'); // conditional comment for less than IE 9

    wp_enqueue_script('respond', get_template_directory_uri() . '/source/js/respond.min.js'); // we need it in HEADER 
    wp_script_add_data('respond', 'conditional', 'lt IE 9'); // conditional comment for less than IE 9

}

/**
 * Add custom menu support 
 * by @watheq
 */
function elzero_register_custom_menu()
{
    // because we need multible menus 
    // register_nav_menu("bootstrap-menu", __("Navigation menu"));


    register_nav_menus(array(

        "bootstrap-menu" => "Navigation menu",
        "footer-menu" => "Footer menu",
    ));
}

/**
 * Adding navigation menu 
 * by @watheq
 */
function elzero_add_nav_menu()
{
    wp_nav_menu(array(
        "theme_location" => "bootstrap-menu",
        "menu_class" => "navbar-nav mr-auto",
        "container" => "false",
        "depth" => 2,
        "walker" => new wp_bootstrap_navwalker(),
    ));
}

/**
 * modifying excerpts length 
 * by @watheq
 * @return int length we want for excerpts 
 */
function elzero_change_excerpts_lenght($length)
{
    if (is_author()) {
        return 10;
    } else if (is_category()) {
        return 15;
    } else {
        return 20;
    }
}

/**
 * numbering pagination function 
 * by @watheq 
 */
function elzero_numbering_pagination()
{
    global $wp_query; // instance from WP_Query Class 

    $all_pages = $wp_query->max_num_pages;
    $current_page = max(1, get_query_var('paged'));

    if ($all_pages > 1) {
        return paginate_links(array(
            'base' => get_pagenum_link() . '%_%',
            'format' => 'page/%#%', // I deleted nut nothing happened
            'current' => $current_page,
            'mid_size' => 1,
            'end_size' => 1
        ));
    }
}


/**
 * modifying excerpts length 
 * by @watheq
 * @return int length we want for excerpts 
 */
function elzero_change_excerpts_more()
{
    return '...';
}


/**
 * Registering Sidebar Widget 
 * by @watheq
 * 
 */

function elzero_main_sidebar()
{

    register_sidebar(array(
        'name'          => 'Main Sidebar',
        'id'            => 'main-sidebar',    // ID should be LOWERCASE  ! ! !
        'description'   => 'this is main sidebar of elzero theme',
        'class'         => 'main-sidebar',
        'before_widget' => '<div class="widget-content"> ',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widge-title">',
        'after_title'   => '</h3>'
    ));
}

/**
 * Remove autho parapaphs that is defult in WP
 * by @watheq
 */
function elzero_remove_auto_p($content)
{

    remove_filter('the_conent', 'wpautop', 0); // make priotary (the lower the most) 
    return $content;
}



/*
    Add Actions 
    added by @watheq
*/

// action to include scripts (JS) and stlysheets (CSS)
add_action('wp_enqueue_scripts', 'elzero_add_style');
add_action('wp_enqueue_scripts', 'elzero_add_script');

// adding actions to the navigation menu 
add_action("init", "elzero_register_custom_menu");

// adding action for the main sidebar widget 
add_action('widgets_init', 'elzero_main_sidebar');



/**
 * Add filters
 * added by @watheq
 */

// change excerpt length
add_filter('excerpt_length', 'elzero_change_excerpts_lenght');
// change excerpt more eg. [...] to ''
add_filter('excerpt_more', 'elzero_change_excerpts_more');

// change auto <p> 
add_filter('the_content', 'elzero_remove_auto_p'); 
