<?php

get_header(); 
pageBanner(array(
    'title' => 'All Events',
    'subtitle' => 'See what is going on within our world.'
));
?>
    

<div class="container container--narrow page-section">
<?php while(have_posts()) {
    the_post(); ?>
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
            <p><?php echo wp_trim_words(get_the_content(), 18); ?><a href="<?php the_permalink(); ?>" 
                class="nu gray">
            Learn more</a></p>
        </div>
    </div>
<?php }
echo paginate_links();
?>
<hr class="section-break">
<!-- Add a link to the past events page -->
<p>Looking for a recap of past events? <a href="<?php echo site_url('/?page_id=55'); ?>">Check out our 
    past events archive.</a></p>
</div>
<?php get_footer();

?>