<?php

get_header(); 
pageBanner(array(
    'title' => 'Our Campuses',
    'subtitle' => 'We have several conveniently located campuses.'
));
?>
    

<div class="container container--narrow page-section">
    <!-- output the campuses in a map -->
    <div class="acf-map">
        <?php 
        // Wordpress Loop
        while(have_posts()) {
            the_post(); 
            // grab the field map_location from acf and assign it to the variable $mapLocation
            $mapLocation = get_field('map_location');
            //print_r($mapLocation); Just a test to see the data returned by $mapLocation. It's an array. 
            
            ?>
            <!-- give a div the class marker along with data-lat and data-long attributes  from the $mapLocation array -->
            <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng'] ?>"></div>

        <?php }
        echo paginate_links();
        
        ?>
    </div>   
    
</div>
<?php 


get_footer();

?>