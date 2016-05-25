<?php function pwd_settings_admin_action() {
   if ( !current_user_can( 'manage_options' ) )
   {
      wp_die( 'You are not allowed to be on this page.' );
   }
   if (!wp_verify_nonce($retrieved_nonce)){
    //set analytics
     update_option('google_analytics', $_POST['google_analytics']);


     //set favicon
     $favicon_original = $_POST['favicon'];
     if(strpos($favicon_original, '32x32') == false) {
      $favicon = str_replace( '.png', '-32x32.png', $favicon_original);
    } else {
      $favicon = $favicon_original;
    }
     update_option('favicon', $favicon);

     //login image
     update_option('login', $_POST['login']);
  }


   wp_redirect(  admin_url( 'admin.php?page=pwdtoolbox') );
 exit;

}

function PWD_anaylitics_html(){
  $google_analytics = get_option('google_analytics');


  if(isset($google_analytics)){
    echo "<script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create','".$google_analytics."', 'auto');
      ga('send', 'pageview');

    </script>";
    }
  }
add_action('wp_head', 'PWD_anaylitics_html');

add_image_size('favicon-16', 16, 16, true);
add_image_size('favicon-32', 32, 32, true);
add_image_size('favicon-152', 152, 152, true);

function PWD_favicon_html(){
  $favicon_url = get_option('favicon');
    echo '<link rel="shortcut icon" href="'.$favicon_url.'">';
}
add_action('wp_head', 'PWD_favicon_html');
add_action( 'admin_head', 'PWD_favicon_html' );

function pwd_login_css() { 
  $login_logo = get_option('login');
  if( $login_logo !== '#' ) {
    $logo_size = get_string_between($login_logo, 'x', '.png');
  ?>
    <style type="text/css">
        #login, .login {
          padding:0 !important;
        }
        #login h1, .login h1 {
          width:300px;
          margin:0;
          margin-top:50px;
              margin-left:10px;
        }
        

         #login h1 a, .login h1 a {
             background-image: url(<?php echo get_option('login'); ?>);
            padding-bottom: 30px;
            background-size: 100% auto;
            background-position: bottom center;
            width:300px;
            height:<?php echo $logo_size ?>px;
            min-height:100px;
            padding:0;
            margin:0;
            margin-bottom:10px;
         }
     </style>
 <?php 
  }
}
add_action( 'login_enqueue_scripts', 'pwd_login_css' );
function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
} ?>