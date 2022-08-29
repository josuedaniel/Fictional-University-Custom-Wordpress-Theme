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
            <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng'] ?>">
                <!-- Anything within the marker div will show up as a pop up when you click on the pin in the map
                    Below we have the title which is a link to an individual campus -->
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php 
                // The address will also show in the pop up when you click on a pin in the map. 
                echo $mapLocation['address']; ?>
            </div>

        <?php } ?>
    </div>   
    
</div>
<?php 


get_footer();

?>