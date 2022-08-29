<?php
get_header();
    while(have_posts()) {
        the_post(); 
        pageBanner();
        ?>
        

        <div class="container container--narrow page-section">
            
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('Campus'); ?>"
                ><i class="fa fa-home" aria-hidden="true"></i> All Campuses</a> <span class="
                metabox__main"><?php the_title(); ?></span></p>
            </div>
            
            <div class="generic-content"><?php the_content(); ?></div>
            <!-- grab the field map_location from acf and assign it to the variable $mapLocation -->
            <?php $mapLocation = get_field('map_location'); ?>
            
            <!-- output the campus in a map -->
            <div class="acf-map">
        
            <!-- give a div the class marker along with data-lat and data-long attributes  from the $mapLocation array -->
            <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng'] ?>">
                <!-- Anything within the marker div will show up as a pop up when you click on the pin in the map
                    Below we have the title which is a link to an individual campus -->
                <h3><?php the_title(); ?></h3>
                
                <!-- The address will also show in the pop up when you click on a pin in the map.  -->

                <?php echo $mapLocation['address']; ?>
            </div>
        </div>  
            <?php


            $relatedPrograms = new WP_Query(array(
                // Make the custom query show all programs per page
                'posts_per_page' => -1,
                // Grab the program post type and not post or page post type
                'post_type' => 'program',
                // determines the order in which posts show 
                'orderby' => 'title',
                // determines the order 
                'order' => 'ASC',
                //query the meta data of the custom post type Event
                'meta_query' => array(
                    // filters the query so that it returns the meta value related_programs
                    array(
                        // grabs the meta value we want
                        'key' =>'related_campus',
                        // Makes sure the value is the same as the next requirement
                        'compare' => 'LIKE',
                        // the value we are comparing the meta key with
                        'value' => '"' . get_the_ID() . '"'
                    )
                )
            ));

            if ($relatedPrograms->have_posts()) {
                echo '<hr class="section-break">';
                //
                echo '<h2 class="headline headline--medium">Programs Available At This Campus</h2>';
                
                // Start the unordered list showing off programs
                echo '<ul class="min-list link-list">';
                // show the post output from the variable $relatedPrograms 
                while ($relatedPrograms->have_posts()) {
                    $relatedPrograms->the_post(); ?>
                        <!-- Give each list item a class -->
                        <li>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                                        
                <?php }
                echo '</ul>';
            }

            wp_reset_postdata();  

                    // set variable names today to the current date
                    $today = date('Ymd');
                    
                    // Create a custom query to show upcoming events and assign it to the variable $homepageEvents
                    $homepageEvents = new WP_Query(array(
                        // Make the custom query show only 2 events per page
                        'posts_per_page' => 2,
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
                                // Compres the value of the meta key
                                'compare' => '>=',
                                // Compares meta key value to the value of the variable $today
                                'value' => $today,
                                // sets the type of camparison to numeric
                                'type' => 'numeric'
                            ), 
                            // filters the query so that it returns the meta value related_programs
                            array(
                                // grabs the meta value we want
                                'key' =>'related_programs',
                                // Makes sure the value is the same as the next requirement
                                'compare' => 'LIKE',
                                // the value we are comparing the meta key with
                                'value' => '"' . get_the_ID() . '"'
                            )
                        )
                    ));
                    
                    if ($homepageEvents->have_posts()) {
                        echo '<hr class="section-break">';
                        //
                        echo '<h2 class="headline headline--medium">Upcoming '. get_the_title().' Events</h2>';
                        // show the post output from the variable $homepageEvents 
                        while ($homepageEvents->have_posts()) {
                            $homepageEvents->the_post(); 
                            get_template_part('template-parts/content-event');    
                        }
                    }
                ?>
        </div>
    <?php }
get_footer();
?>