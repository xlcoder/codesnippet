<?php
//Page
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$page_query = new WP_Query([
    'post_type' => 'post',
    "posts_per_page" => 10,
    "paged" => $paged
]);


while ($page_query->have_posts()) : $page_query->the_post();
    get_template_part("content");
endwhile;
?>

<?php 
    //Pagination
    if (function_exists("custom_pagination")) {
        custom_pagination($page_query->max_num_pages,"",$paged);
    } 

    wp_reset_postdata()
?>

<?php
//Archive
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$categories = get_the_category();
$cat = $categories[0]->term_id;

$page_query = new WP_Query([
    'post_type' => 'post',
    "posts_per_page" => 10,
    "cat" => $cat,
    "paged" => $paged
]);


while ( $page_query->have_posts() ) : $page_query->the_post();
    get_template_part("content");
endwhile;
?>

<?php
//Relate Post
$categories = get_the_category();
$cat = $categories[0]->term_id;

$args = [
    "post_type" => "post",
    "cat" => $cat,
    "posts_per_page" => 3
];

$the_query = new WP_Query($args);

if ($the_query->have_posts()) {
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        get_template_part("content", "relate");
    }  
}

wp_reset_postdata();
?>





<?php
//Category
$categories = get_categories();

$output = '';

if($categories) {
    $output = "<ul class=\"contact-footer\">";

    foreach($categories as $category) {
        $output .= '<li><a href="' . get_category_link( $category->term_id ). '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">' . $category->cat_name. '</a> (' . $category->count . ')</li>';
    }

    $output .= "</ul>";
}
echo $output;

?>
