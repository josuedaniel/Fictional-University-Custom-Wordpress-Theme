<?php

get_header(); 
pageBanner(array(
    'title' => 'All Programs',
    'subtitle' => 'There is something for everyone. Have a look around.'
));
?>
    

<div class="container container--narrow page-section">
    <!-- output the programs in a list -->
    <ul class="link-list min-list">
        <?php 
        // Wordpress Loop
        while(have_posts()) {
            the_post(); ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></li>
        <?php }
        echo paginate_links();
        ?>
        
    </ul>
</div>
<?php get_footer();

?>