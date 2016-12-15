<?php
/*
 * Method 1 Auto Relate Post  
 */
?>

<?php 
    $postId = get_post()->ID;
    $categories = get_the_category($postId);

    if ($categories) {
        $category_ids = [];
        foreach ($categories as $individual_category) {
            $category_ids[] = $individual_category->term_id;
        }
    }

    $args = [
        'category_in' => $category_ids,
        'post_not_in' => array($post->ID),
        'posts_per_page'=> 2, // Number of related posts that will be shown.
        'ignore_sticky_posts'=>1
    ];

    $myQuery = new WP_Query($args);

    if ($myQuery->have_posts()) :
?>

    <div id="related_posts"><h3>Related Posts</h3>

    <?php while ( $myQuery->have_posts() ) : $myQuery->the_post(); ?>
        <div class="col-md-3">
            <div class="thumbnail text-center">
                <?php the_post_thumbnail('thumbnail');?>

                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            </div>
        </div>
    <?php endwhile; ?>

<?php 
    wp_reset_postdata();
    endif;
?>       
<?php
/*
 *Method 2 Post 2 Post Plugin
 */
?>
<?php
    function post_type_connections() {
        p2p_register_connection_type( array(
            'name' => 'accessory', // unique name
            'from' => 'post',
            "to" => "post",
            "title" => array( "to" => "Accessory To", "from" => "Accessory From" )
        ) );
    }
    add_action( 'p2p_init', 'post_type_connections' );
?>

<?php
    $connected = new WP_Query( array(
      'connected_type' => 'system',
      'connected_items' => get_queried_object(),
      'nopaging' => true,
    ) );
    
    if ( $connected->have_posts() ) :
?>

<h3 class="sgr-accessory" >Recommended System:</h3>

<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
    <div class="col-md-3">
        <div class="thumbnail text-center">
            <?php the_post_thumbnail('thumbnail');?>

            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        </div>
    </div>
<?php endwhile; ?>

<?php 
// Prevent weirdness
    wp_reset_postdata();
    endif;
?>
