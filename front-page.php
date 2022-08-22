
<?php


get_header();?>
    
    <div class="page-banner">
        
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg') ?>);"></div>
        <div class="page-banner__content container t-center c-white">
            <h1 class="headline headline--large">Welcome!</h1>
            <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
            <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong>you&rsquo;re interested in?</h3>
            <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
        </div>
    </div>

    <div class="full-width-split group">
        <div class="full-width-split__one">
            <div class="full-width-split__inner">
                <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>

                <!-- use custom queries and the WP_Query class inside a variable to grab the Event post type --> 
                <?php
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
                            )
                        )
                    ));
                    
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
                ?>
                
                <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn--blue">View All Events</a></p>
            </div>
        </div>
        <div class="full-width-split__two">
            <div class="full-width-split__inner">
                <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>
                <?php 
                    $homepagePosts = new WP_Query(array(
                        'posts_per_page' => 2
                    ));

                    while($homepagePosts->have_posts()) {
                        $homepagePosts->the_post(); ?>
                        <div class="event-summary">
                            <a href="<?php the_permalink(); ?>" class="event-summary__date event-summary__date--beige t-center">
                                <span class="event-summary__month"><?php the_time('M'); ?></span>
                                <span class="event-summary__day"><?php the_time('d'); ?></span>
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
                                 ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read 
                                    more</a></p>
                            </div>
                        </div>
                    <?php } wp_reset_postdata();
                ?>
                
                
                <p class="t-center no-margin"><a href="<?php echo site_url('/?page_id=38'); ?>" class="btn btn--yellow">View All Blog Posts</a></p>
            </div>
        </div>
    </div>

    <div class="hero-slider">
        <div data-glide-el="track" class="glide-track">
            <div class="glide__slides">
                <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/bus.jpg'); ?>">
                    <div class="hero-slider__interior container">
                        <div class="hero-slider__overlay">
                            <h2 class="headline headline--medium t-center">Free Transportation</h2>
                            <p class="t-center">All students have free unlimited bus fare.</p>
                            <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                        </div>
                    </div>
                </div>
                <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/apples.jpg'); ?>">
                    <div class="hero-slider__interior container">
                        <div class="hero-slider__overlay">
                            <h2 class="headline headline--medium t-center">An Apple a day</h2>
                            <p class="t-center">Our dentistry program recommends eating apples.</p>
                            <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                        </div>
                    </div>
                </div>
                <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/bread.jpg'); ?>">
                    <div class="hero-slider__interior container">
                        <div class="hero-slider__overlay">
                            <h2 class="headline headline--medium t-center">Free Food</h2>
                            <p class="t-center">Fictional University offers lunch plans for those in need.</p>
                            <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
        </div>
    </div>
<?php    
get_footer();
?>




