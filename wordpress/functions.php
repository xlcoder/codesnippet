// Remove Admin bar
add_filter('show_admin_bar', '__return_false'); 

//clean theme header load
function headerCleanup() 
{
    remove_filter( 'wp_head', 'print_emoji_detection_script', 7 );  // remove emojis
    remove_filter( 'wp_print_styles', 'print_emoji_styles' );   // remove emojis
    remove_filter('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
    remove_filter('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
    remove_filter('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
    remove_filter('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
    remove_filter('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
    remove_filter('wp_head', 'rel_canonical');
    remove_filter('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_filter("wp_head", "ls_meta_generator",9); //delete layerslider meta generator
}
add_filter('after_setup_theme', 'headerCleanup');

//hook css and script
function hookAssets()
{
	  wp_enqueue_style( 'theme-style', get_stylesheet_uri() ); // load default style.css
	  wp_enqueue_style( 'reset', get_stylesheet_directory_uri() . '/reset.css' ) ); // load custom define css

	  wp_enqueue_script( 'owl-carousel', get_stylesheet_directory_uri() . '/owl.carousel.js', array( 'jquery' ) ); // load JS dependency
    wp_enqueue_script( 'theme-scripts', get_stylesheet_directory_uri() . '/website-scripts.js', array( 'owl-carousel', 'jquery' ), '1.0', true ); // load custom define JS, default false is in head
}
add_filter("wp_enqueue_script", "hookScriptAndCss")

//Modify excerpt length and more style
function custom_excerpt_more( $more ) {
    return "";
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

function custom_excerpt_length( $length ) {
    return 80;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

