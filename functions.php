<?php
// create the function pageBanner and give it the $args array parameter 
function pageBanner($args = NULL) {
    // if there is no title set for $args
    if (!isset($args['title'])) {
        // set the title for $args
        $args['title'] = get_the_title(); 
    }
    // if there is no subtitle for $args
    if (!isset($args['subtitle'])) {
        // set the subtitle for args from the acf page_banner_subtitle
        $args['subtitle'] = get_field('page_banner_subtitle');
    }
    //if there is no photo set in $args
    if (!isset($args['photo'])) {
        // check if we have a page_banner_background_image chosen through acf, we are not 
        //on an archive page, and we are not on the home page
        if (get_field('page_banner_background_image') AND !is_archive() AND !is_home() ) {
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
        // set the photo for array

    }
    ?>
    <div class="page-banner">
            <div class="page-banner__bg-image" style="background-image: url(<?php 
                // use the custom field created in acf to bring in the image using the acf method get_field
                /*
                $pageBannerImage = 
                get_field('page_banner_background_image'); echo $pageBannerImage['sizes']['pageBanner'];*/
                
                //We will use the $args array to grab the photo value
                echo $args['photo'];
                ?>);"></div>
            <div class="page-banner__content container container--narrow">
            <!-- You can use the following print_r to see the data behind something. in this case we use it to see that
            $pageBannerImage is returned as an array and thats why we can use echo $pageBannerImage['url'] -->
            <?php //print_r($pageBannerImage); ?>    
            <h1 class="page-banner__title"><?php echo $args['title'] ?> </h1>
                <div class="page-banner__intro">
                    <!-- pull in the meta field from one of the custom fields created in acf 
                    <p><?php //the_field('page_banner_subtitle') ?></p>-->
                    <!-- instead of doing the above code we will echo the subtitle from the $args variable -->
                    <p><?php echo $args['subtitle']; ?></p>
                </div>
            </div>
        </div>
    <?php
}




add_action('wp_enqueue_scripts', 'university_files');

function university_features() {
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerLocationOne', 'Footer Location One');
    register_nav_menu('footerLocationTwo', 'Footer Location Two');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 400, 260, true); 
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
}
add_action('after_setup_theme', 'university_features');




// function controlling the new post type events
function university_post_types() {
    
    // function that registers a new post type Campus
    register_post_type('campus', array(
        /*
        //rewrite the slug from campus to campuses
        'rewrite' => array('slug' => 'cmapuses'),
        */
        // adds support to edit the excerpt and custom fields. Title and editor are default but still must be included
    'supports' => array('title', 'editor', 'excerpt'/*, 'custom-fields'*/),
        // wordpress will enable an archive page for campusess
        'has_archive' => true,
        //makes the post visible to users
        'public' => true,
        // Makes the editing custom post type ui use the new block editor
       'show_in_rest' => true, 
        //controls the labels and ui of the wordpress admin
        'labels' => array(
            //makes the proper name show up in the wordpress admin
            'name' => 'Campuses',
            //Makes the adding new event page in the wordpress admin show add new event instead of add new post
            'add_new_item' => 'Add New Campus',
            // Changes the wording from post to event when editing events
            'edit_item' => 'Edit Campus',
            //Changes the wording in the wordpress admin from all posts to all events
            'all_items' => 'All Campuses',
            // 
            'singular_name' => 'Campus'
        ),
        // gives you a choice of dashicons to show up in the wordpress admin
        'menu_icon' => 'dashicons-location-alt'
    ));
    
    
    
    // function that registers a new post type
    register_post_type('event', array(
        /*
        //rewrite the slug from event to events
        'rewrite' => array('slug' => 'events'),
        */
        // adds support to edit the excerpt and custom fields. Title and editor are default but still must be included
    'supports' => array('title', 'editor', 'excerpt'/*, 'custom-fields'*/),
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

    register_post_type('program', array(
        /*
        //rewrite the slug from program to programs
        'rewrite' => array('slug' => 'programs'),
        */
        // adds support to edit the excerpt and custom fields. Title and editor are default but still must be included
        'supports' => array('title', 'editor', 'excerpt'/*, 'custom-fields'*/),
        // wordpress will enable an archive page for programs
        'has_archive' => true,
        //makes the post visible to users
        'public' => true,
        // Makes the editing custom post type ui use the new block editor
       'show_in_rest' => true, 
        //controls the labels and ui of the wordpress admin
        'labels' => array(
            //makes the proper name show up in the wordpress admin
            'name' => 'Programs',
            //Makes the adding new program page in the wordpress admin show add new program instead of add new post
            'add_new_item' => 'Add New Program',
            // Changes the wording from post to program when editing programs
            'edit_item' => 'Edit Program',
            //Changes the wording in the wordpress admin from all posts to all programs
            'all_items' => 'All Programs',
            // 
            'singular_name' => 'Program'
        ),
        // gives you a choice of dashicons to show up in the wordpress admin
        'menu_icon' => 'dashicons-awards'
    ));

    register_post_type('professor', array(
        // adds support to edit the excerpt and custom fields. Title and editor are default but still must be included
        'supports' => array('title', 'editor', 'thumbnail'),
        //makes the post visible to users
        'public' => true,
        // Makes the editing custom post type ui use the new block editor
       'show_in_rest' => true, 
        //controls the labels and ui of the wordpress admin
        'labels' => array(
            //makes the proper name show up in the wordpress admin
            'name' => 'Professors',
            //Makes the adding new professor page in the wordpress admin show add new professor instead of add new post
            'add_new_item' => 'Add New Professor',
            // Changes the wording from post to professor when editing professors
            'edit_item' => 'Edit Professor',
            //Changes the wording in the wordpress admin from all posts to all professors
            'all_items' => 'All Professors',
            // 
            'singular_name' => 'Professor'
        ),
        // gives you a choice of dashicons to show up in the wordpress admin
        'menu_icon' => 'dashicons-welcome-learn-more'
    ));
}
// use add_action hook to initialize the new post type Events
add_action('init', 'university_post_types');

//Function to adjust the way queries are performed
function university_adjust_queries($query) {
    // Make sure the function does not affect the admin page, it only works on the post type Program, and it is the main query for the page
    if (!is_admin() AND is_post_type_archive('program') AND is_main_query()) {
        //Setting the query order, set to title
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        // Setting the number of posts per page, setting it to -1 will show all posts
        $query->set('posts_per_page', -1);
    }
    
    if(! is_admin() AND is_post_type_archive('event') and $query->is_main_query()){
        // set variable names today to the current date
        $today = date('Ymd');
        // Set the query to event_date
        $query->set('meta_key', 'event_date');
        // determines the order in which posts show
        $query->set('orderby', 'meta_value_num');
        // determines the order
        $query->set('order', 'ASC');
        // makes sure that only upcoming dates show up by comparing the event_date to the current date
        $query->set('meta_query', array(
            array(
                //Meta key
                'key' => 'event_date',
                // Compres the value of the meta key
                'compare' => '>=',
                // Compares meta key value to the value of the variable $today
                'value' => $today,
                // sets the type of comparison to numeric
                'type' => 'numeric'
            )
            ));
    }
}
// Changes the behavior of wordpess when fetching posts
add_action('pre_get_posts', 'university_adjust_queries');


// targets acf to tell it we have the google map api key
add_filter('acf/fields/google_map/api', 'universityMapKey');




?>