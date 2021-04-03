<?php

// Include custom navwalker
require_once('wp-bootstrap-navwalker.php');


//   add featured image to the theme; Looks like I already have it.
// add_theme_support( 'post-thumbnails' );



function elzero_add_styles() {


    wp_enqueue_style( 'bootsrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style( 'fontawesome-css', get_template_directory_uri() . '/css/all.min.css');
    wp_enqueue_style( 'main-css', get_template_directory_uri() . '/css/main.css');
}

function elzero_add_scripts() {
    //  remove registered jquery, because it shows up in the head, by "deregister"
    //  register jquery again and then enqueue it.
    //  bootstrap 5 , does not need jquery that is why I took it off.

    // wp_deregister_script( 'jquery' ); 
    // wp_register_script( 'jquery', includes_url('/js/jquery/jquery') , false , '', true); 
    //    wp_enqueue_script( 'jquery');

   wp_enqueue_script( 'bootsrap-js', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), false, true);
   wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array(), false, true);
}

//  wp_enqueue_scripts ....this is a function that runs both scripts and styles, it is a hook!!
//  not that every thing inside add_action is a function without the sign ().
//  to make the script goes to the bottom of the body, true must be at the end of the wp_enqueue_script, if it is false, it will go up in the head tag.


// 1-  creating menu on the theme;

function register_my_menu() {
    register_nav_menus(array (
         'bootsrap-menu' => 'Navigation Bar' ,
         'footer-menu' => 'Footer Menu'
     ) );
  }



// 3-  showing the menu on the page,  this function is to be called in the header.php
// 4- you must use 'theme location' if you want to use more than one menu and customize them.
  function bootstrap_menu() {
    wp_nav_menu(array(
        'theme_location'      => 'bootsrap-menu',
        'menu_class'             => "navbar-nav ms-auto mb-2 mb-lg-0 ",
        'container'                  => false,
        'depth'                         => 2,
        "walker"                    => new bootstrap_5_wp_nav_menu_walker()
    ) );
  }


//  This function serve as edit function to modify the native Excerpt(), the same function under it, 
//  is_Author means if the page is author page, then return ... ro ...

// add_filter( 'excerpt_length', function( $length ) { return 15; } );

function custom_excerpt_length( $length ) {
    if (is_author()) {
      return 10;
    } else if (is_category('uncat')) {
      return 15;
    } else {
  return 25;
}
}
add_filter( 'excerpt_length','custom_excerpt_length');


function excerpt_dots_length($more) {
  return '&hellip;';
}
add_filter( 'excerpt_more','excerpt_dots_length');


 
add_action( 'wp_enqueue_scripts', 'elzero_add_styles' );
add_action( 'wp_enqueue_scripts', 'elzero_add_scripts' );
add_action( 'init', 'register_my_menu' );  // 2- showing the menu on the theme setting page.


/**
 * numbering pagination function 
 * by @watheq 
 */

function numbering_pagination() {
    global $wp_query; // instance from WP_Query Class ... made global can be used anywhere

    $all_pages = $wp_query->max_num_pages;
    $current_page = max(1, get_query_var('paged')); // get_guery_var gives the current page.
  
    if ($all_pages > 1) {
        return paginate_links( array(

            'base'                => get_pagenum_link() . '%_%',
            'format'            => 'page/%#%', 
            'current'           => $current_page,
            'prev_next'     => true,
            'next_text' =>             '»',
            'prev_text' =>             '«',
            'mid_size'       => 1,
            'end_size'       => 1
        ));
    }
}

// Add main sidebar

function main_sidebar( ) {

  register_sidebar( array(

    'name'           => 'Main Sidebar',
    'id'             => "main-sidebar",
    'description'    => 'main sidebar',
    'class'          => 'main_sidebar',
    'before_widget'  => '<div  class="widget-content">',
    'after_widget'   => "</div>\n",
    'before_title'   => '<h2 class="widget-title">',
    'after_title'    => "</h2>\n",
    'before_sidebar' => '',
    'after_sidebar'  => '',

  ));
}

add_action( 'widgets_init', 'main_sidebar' );

//  end of sidebar



//  Remove autho parapaphs that is defult in WP
// function remove_auto_p($content) {
//     remove_filter('the_conent', 'wpautop', 0); // make priotary (the lower the most) 
//     return $content; }
// add_filter('the_content', 'remove_auto_p'); 


// Remove visit store form the control panel
// function remove_admin_bar_links() {
//   global $wp_admin_bar;
//   $wp_admin_bar->remove_menu('view-site');  // Remove the view site link
//   $wp_admin_bar->remove_menu('view-store'); // Remove the view store link
//   $wp_admin_bar->remove_menu('site-name');  // Remove the site name menu
// }    
// add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

