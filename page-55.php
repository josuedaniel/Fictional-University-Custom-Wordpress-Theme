<?php


get_header(); 
pageBanner(array(
    'title' => 'Past Events',
    'subtitle' => 'A recap of our past events.'
));
?>
    

<div class="container container--narrow page-section">
<?php 
    // set variable names today to the current date
    $today = date('Ymd');
                    
    // Create a custom query to show past events and assign it to the variable $pastEvents
    $pastEvents = new WP_Query(array(
        //Gets us the page number of the reults in the archive events page
        'paged' => get_query_var('paged', 1),
        // Grab the event post type and not post or page post type
        'post_type' => 'event',
        // tell wordpress the name of the custom field we want to use in the orderby key
        'meta_key' => 'event_date',
        // determines the order in which posts show 
        'orderby' => 'meta_value_num',
        // determines the order 
        'order' => 'ASC',
        //query the meta data of the custom post type Event
        'meta_query' => array(
            array(
                //Meta key
                'key' => 'event_date',
                // Compres the value of the meta key less than 
                'compare' => '<',
                // Compares meta key value to the value of the variable $today
                'value' => $today,
                // sets the type of camparison to numeric
                'type' => 'numeric'
            )
        )
    ));
    
    // Wordpress loop, make sure its only looking in the variable $pastEvents
    while($pastEvents->have_posts()) {
        $pastEvents->the_post(); 
        get_template_part('template-parts/content-event');    
    }
// Make sure the pagination pulls from the $pastEvents 
echo paginate_links(array(
    'total' => $pastEvents->max_num_pages
));
?>
</div>
<?php get_footer();

?>