<?php
/*
 *Remove Admin bar
 */
add_filter('show_admin_bar', '__return_false'); 

/*
 *clean theme header load
 */
function headerCleanup() 
{
    remove_filter('wp_head', 'print_emoji_detection_script', 7);  // remove emojis
    remove_filter('wp_print_styles', 'print_emoji_styles');   // remove emojis
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

/*
 *hook css and script
 */
function hookAssets()
{
	wp_enqueue_style( 'develop-bootstrap', get_stylesheet_directory_uri() . '/asset/css/bootstrap.css', "", null ); // load custom define css
	wp_enqueue_style( 'develop-style', get_stylesheet_uri(), "", null ); // load default style.css
	wp_enqueue_script( 'develop-jquery', get_stylesheet_directory_uri() . '/asset/bower_vendor/jquery/jquery.min.js', "", null, true ); // load JS dependency
	wp_enqueue_script( 'develop-bootstrap-js', get_stylesheet_directory_uri() . '/asset/bower_vendor/bootstrap/dist/js/bootstrap.min.js', "", null, true ); // load JS dependency

}
add_action("wp_enqueue_scripts", "hookAssets");

/*
 *Modify excerpt length and more style
 */
function custom_excerpt_more($more) {
    return "";
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

function custom_excerpt_length($length) {
    return 80;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

 
/**
 * Customize the title for the home page, if one is not set.
 *
 * @param string $title The original title.
 * @return string The title to use.
 */
function wpdocs_hack_wp_title_for_home($title)
{
  if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
    $title = get_bloginfo("name") . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
}
add_filter( 'wp_title', 'wpdocs_hack_wp_title_for_home' );

/*
 *PHPmailer init
 */
function customPhpMailer(PHPMailer $phpmailer) 
{
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.gmail.com';
    $phpmailer->Username = ''; 
    $phpmailer->Password = ''; 
    $phpmailer->SMTPAuth = true; 
    $phpmailer->SMTPSecure = 'ssl';
    $phpmailer->Port = 465;
    $phpmailer->From = "";
    $phpmailer->FromName = "";
    $phpmailer->CharSet= "UTF-8";
    //$phpmailer->SMTPDebug = 2;
}
add_filter("phpmailer_init", "customPhpMailer");

/*
 *Send Email by HTML/Text
 */
function setContentType(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','setContentType' );

/*
 *Event Form CallBack
 */
function eventFormCallBack() 
{
  
    if (empty($_POST["contact"])) {
        $contact = "";
    } else {
        $contact = $_POST['contact'];
    }

    if (empty($_POST["date"])) {
        $date = "";
    } else {
        $date = $_POST['date'];
    }

    if (empty($_POST["destination"])) {
        $destination = "";
    } else {
        $destination = $_POST['destination'];
    }

    if (empty($_POST["name"])) {
        $name = "";
    } else {
        $name = $_POST['name'];
    }

    if (empty($_POST["person"])) {
        $person = "";
    } else {
        $person = $_POST['person'];
    }

    //Email send
    $to = "xlcoder166@gmail.com";
    $subject = "{$name} Travl Info 咨询信息";
    $message = "新的客户资讯,信息如下: <br> 客户姓名: {$name} <br> 客户联系方式: {$contact} <br> 客户出行人数: {$person} <br> 客户出行日期: {$date} <br> 客户出行目的地: {$destination} <br> 请及时联系客户. ";
    $send = wp_mail($to, $subject, $message);

    //Success Response Status
    $result = ["status" => ""];

    if(!$send) {
        $result["status"] = "error";
    } else {
        $result["status"] = "success";
    }

    print json_encode($result);
    //Change Default response status
    die();
}
add_filter('wp_ajax_event_form', 'eventFormCallBack');
add_filter('wp_ajax_nopriv_event_form', 'eventFormCallBack');
