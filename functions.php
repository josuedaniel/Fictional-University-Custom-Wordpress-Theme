<?php
function university_files() {
    wp_enqueue_script('main-university-javascript', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style('custom-google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap');
    wp_enqueue_style('font-awesome', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css' );
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css')); 
}   


add_action('wp_enqueue_scripts', 'university_files');

function university_features() {
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerLocationOne', 'Footer Location One');
    register_nav_menu('footerLocationTwo', 'Footer Location Two');
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'university_features');

// function controlling the new post type events
function university_post_types() {
    // function that registers a new post type
    register_post_type('event', array(
        /*
        //rewrite the slug from event to events
        'rewrite' => array('slug' => 'events'),
        */
        // wordpress will enable an archive page for events
        'has_archive' => true,
        //makes the post visible to users
        'public' => true,
       // Makes the editing custom post type ui use the new block editor
       'show_in_rest' => true, 
        //controls the labels and ui of the wordpress admin
        'labels' => array(
            //makes the proper name show up in the wordpress admin
            'name' => 'Events',
            //Makes the adding new event page in the wordpress admin show add new event instead of add new post
            'add_new_item' => 'Add New Event',
            // Changes the wording from post to event when editing events
            'edit_item' => 'Edit Event',
            //Changes the wording in the wordpress admin from all posts to all events
            'all_items' => 'All Events',
            // 
            'singular_name' => 'Event'
        ),
        // gives you a choice of dashicons to show up in the wordpress admin
        'menu_icon' => 'dashicons-calendar'
    ));
}
// use add_action hook to initialize the new post type Events
add_action('init', 'university_post_types');

?>