<?php
get_header(); 
    while (have_posts()) {
        the_post(); 
        // Call the pageBanner function
        pageBanner(); 
        //create an associative array giving the pagebanner function parameters
        /* We could call pageBanner with an array to give it parameters. 
        pageBanner(array(
            'title' => 'Hello there this is the title',
            'subtitle' => 'hey hey',
            /* We could
            'photo' => 'https://images.pexels.com/photos/189349/pexels-photo-189349.jpeg'
        )); */
        ?>

        

            <div class="container container--narrow page-section">
                <?php
                    $theParent = wp_get_post_parent_id(get_the_ID());
                    if ($theParent){ ?>
                        <div class="metabox metabox--position-up metabox--with-home-link">
                            <p><a class="metabox__blog-home-link" href="<?php the_permalink($theParent
                            ); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo 
                            get_the_title($theParent); ?></a> <span class="metabox__main"><?php the_title
                            (); ?></span></p>
                        </div>
                <?php
                    }
                ?>
                
                <?php 
                $testArray = get_pages(array(
                    'child_of' => get_the_ID()
                )); 
                if ($theParent or $testArray) { ?>
                <div class="page-links">
                    <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></h2>
                    <ul class="min-list">
                        <?php 
                            if ($theParent) {
                                $findChildrenOF = $theParent;
                            } else {
                                $findChildrenOF = get_the_ID();
                            }
                            wp_list_pages(array(
                                'title_li' => NULL,
                                'child_of' => $findChildrenOF,
                                'sort_column' => 'menu_order'
                        )); ?>
                    </ul>
                </div>
                <?php } ?>
                

                <div class="generic-content">
                    <p><?php the_content(); ?></p>
                    
                </div>
            </div>
    <?php }
get_footer();
?>