<?php
get_header();
    while(have_posts()) {
        the_post(); 
        pageBanner(); 
        ?>

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