<?php

get_header(); 
pageBanner(array(
    'title' => 'All Events',
    'subtitle' => 'See what is going on within our world.'
));
?>
    

<div class="container container--narrow page-section">
<?php while(have_posts()) {
    the_post(); 

        get_template_part('template-parts/content-event');
    }
echo paginate_links();
?>
<hr class="section-break">
<!-- Add a link to the past events page -->
<p>Looking for a recap of past events? <a href="<?php echo site_url('/?page_id=55'); ?>">Check out our 
    past events archive.</a></p>
</div>
<?php get_footer();

?>