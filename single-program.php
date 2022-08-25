<?php
get_header();
    while(have_posts()) {
        the_post(); ?>
        <div class="page-banner">
            <div class="page-banner__bg-image" style="background-image: url(<?php echo 
            get_theme_file_uri('/images/ocean.jpg'); ?>"></div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title"><?php the_title(); ?> </h1>
                <div class="page-banner__intro">
                    <p>DON'T FORGET TO REPLACE ME LATER</p>
                </div>
            </div>
        </div>

        <div class="container container--narrow page-section">
            
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"
                ><i class="fa fa-home" aria-hidden="true"></i> All Programs</a> <span class="
                metabox__main"><?php the_title(); ?></span></p>
            </div>
            
            <div class="generic-content"><?php the_content(); ?></div>

            <?php


            $relatedProfessors = new WP_Query(array(
                // Make the custom query show only 2 events per page
                'posts_per_page' => -1,
                // Grab the event post type and not post or page post type
                'post_type' => 'professor',
                // determines the order in which posts show 
                'orderby' => 'title',
                // determines the order 
                'order' => 'ASC',
                //query the meta data of the custom post type Event
                'meta_query' => array(
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

            if ($relatedProfessors->have_posts()) {
                echo '<hr class="section-break">';
                //
                echo '<h2 class="headline headline--medium">'. get_the_title().' Professors</h2>';
                
                // Start the unordered list showing off professor cards
                echo '<ul class="professor-cards">';
                // show the post output from the variable $relatedProfessors 
                while ($relatedProfessors->have_posts()) {
                    $relatedProfessors->the_post(); ?>
                        <!-- Give each list item a class -->
                        <li class="professor-card__list-item">
                            <a href="<?php the_permalink(); ?>" class="professor-card">
                                <img src="<?php the_post_thumbnail_url('professorLandscape') ?>" alt="" class="professor-card__image">
                                <span class="professor-card__name"><?php the_title(); ?></span>
                            </a>
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
                            $homepageEvents->the_post(); ?>
                            
                            <div class="event-summary">
                                <a href="<?php the_permalink(); ?>" class="event-summary__date t-center">
                                    <span class="event-summary__month"><?php 
                                        //show the custom chosen event_date through acf's get_field and format it to up as M
                                        $eventDate = new DateTime(get_field('event_date'));
                                        echo $eventDate->format('M')
                                        
                                    ?></span>
                                    <span class="event-summary__day"><?php 
                                        //show the custom chosen event_date through acf's get_field and format it to up as d                                    
                                        echo $eventDate->format('d')
                                    ?></span>
                                </a>
                                <div class="event-summary__content">
                                    <h5 class="event-summary__title headline headline--tiny"><a href="<?php 
                                    the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                    <!-- get the custom excerpt or the trimmed first 18 words --> 
                                    <p><?php if (has_excerpt()) {
                                        echo get_the_excerpt();
                                    } else {
                                        echo wp_trim_words(get_the_content(), 18);
                                    }
                                    ?><a href="<?php the_permalink(); ?>" class="nu gray">
                                    Learn more</a></p>
                                </div>
                            </div>
                        <?php }
                    }
                ?>
        </div>
    <?php }
get_footer();
?>