<?php
get_header();
    while(have_posts()) {
        the_post(); ?>
        <div class="page-banner">
            <div class="page-banner__bg-image" style="background-image: url(<?php $pageBannerImage = 
                // use the custom field created in acf to bring in the image using the acf method get_field
                get_field('page_banner_background_image'); echo $pageBannerImage['sizes']['pageBanner']; ?>)"></div>
            <div class="page-banner__content container container--narrow">
            <!-- You can use the following print_r to see the data behind something. in this case we use it to see that
            $pageBannerImage is returned as an array and thats why we can use echo $pageBannerImage['url'] -->
            <?php //print_r($pageBannerImage); ?>    
            <h1 class="page-banner__title"><?php the_title(); ?> </h1>
                <div class="page-banner__intro">
                    <!-- pull in the meta field from one of the custom fields created in acf -->
                    <p><?php the_field('page_banner_subtitle') ?></p>
                </div>
            </div>
        </div>

        <div class="container container--narrow page-section">
            
            
             <div class="generic-content">
                <div class="row group">
                    <div class="one-third">
                        <?php the_post_thumbnail('professorPortrait'); ?>
                    </div>
                    <div class="two-thirds">
                        <?php the_content(); ?>
                    </div>
                </div>
             </div>
             <?php
                // get the acf custom field related_programs
                $relatedPrograms = get_field('related_programs');
                // do the following only if $relatedPrograms exist
                if ($relatedPrograms) {
                    // Make a horizontal rule and give us space before the next content
                    echo '<hr class="section-break">';
                    echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';
                    // Created an unordered list to display out programs
                    echo '<ul class="link-list min-list">';
                    // list each program as a link to its own program page
                    foreach ($relatedPrograms as $program) { ?>
                        <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>
                    <?php }
                    echo '</ul>';
                }
             ?>
        </div>
    <?php }
get_footer();
?>