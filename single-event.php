<?php
get_header();
    while(have_posts()) {
        the_post(); 
        pageBanner();
        ?>
        

        <div class="container container--narrow page-section">
            
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>"
                ><i class="fa fa-home" aria-hidden="true"></i> Events Home</a> <span class="
                metabox__main"><?php the_title(); ?></span></p>
            </div>
             <div class="generic-content">
                <?php the_content(); ?>
             </div>
             <?php
                // get the acf custom field related_programs
                $relatedPrograms = get_field('related_programs');
                // do the following only if $relatedPrograms exist
                if ($relatedPrograms) {
                    // Make a horizontal rule and give us space before the next content
                    echo '<hr class="section-break">';
                    echo '<h2 class="headline headline--medium">Related Program(s)</h2>';
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