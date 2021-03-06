<?php function PWD_toolbox_options(){

    // HEADER

    ?>
<div class="wrap">
  <div class ="pwd_toolset_wrap">
  <div class="container">
    <div class="row">
      <div class="twelve columns text-center">
        <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . '/images/PWD-theme-options.png' ?>">
      </div>
    </div>
  </div>
<section id="menu">
  <div class="container">
    <div class="row">
      <div class="text-center pwd_toolset_navbar">
        <a href="#" class="menu-link is-active" name="settings">Settings</a>
        <a href="#" class="menu-link" name="videos">Instructional Videos</a>
      </div>
    </div>
  </div>
</section>

<?php

    //PAGES
    include( plugin_dir_path(dirname(__FILE__)) . 'pages/settings.php');
    include( plugin_dir_path(dirname(__FILE__)) . 'pages/videos.php');
    include( plugin_dir_path(dirname(__FILE__)) . 'pages/image-sizes.php');
    include( plugin_dir_path(dirname(__FILE__)) . 'pages/custom-css.php');
    include( plugin_dir_path(dirname(__FILE__)) . 'pages/cpt.php');
    include( plugin_dir_path(dirname(__FILE__)) . 'pages/maintenance-mode.php');

    //FOOTER

?>
<section id="admin-menu">
  <div class="container">
    <div class="row">
      <div class="twelve columns pwd_toolset_admin_nav">
        <p>For developer use only: &nbsp;
        <a href="#" class="menu-link" name="image-sizes">Image Sizes</a>
        <a href="#" class="menu-link" name="custom-css">Custom CSS</a>
        <a href="#" class="menu-link" name="cpt">Custom Post Types</a>
        <a href="#" class="menu-link" name="maintenance">Maintenance Mode</a>
      </div>
    </div>
  </div>
</section>
</div><!--pwd_toolset_wrap-->
</div>
<?php
}
//enqueue menu scripts
function pwd_enqueue_admin_scripts($hook) {
      if ( 'toplevel_page_pwdtoolbox' != $hook ) {
        return;
    }

  wp_enqueue_script( 'admin_menu_scripts', plugin_dir_url(dirname(__FILE__)) . '/js/admin-menu.js');
}
add_action( 'admin_enqueue_scripts', 'pwd_enqueue_admin_scripts' );

//enqueue menu css
add_action('admin_head', 'pwd_toolset_styling');

function pwd_toolset_styling($hook) {
  wp_enqueue_style( 'pwd_toolset_css' , plugin_dir_url(dirname(__FILE__)) . '/style.css' );
}?>
