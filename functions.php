<?php
/* enqueue styles and scripts */
function my_assets() {

  /* theme's primary style.css file */
  wp_enqueue_style( 'main-css' , get_stylesheet_uri() );

  /* boostrap resources from theme files */
  wp_enqueue_style( 'min-css' , get_template_directory_uri() . '/assets/css/font-awesome.min.css' );

  wp_enqueue_script( 'breakpoint-min' , get_template_directory_uri() . '/assets/js/breakpoints.min.js');
  wp_enqueue_script( 'jquery-min' , get_template_directory_uri() . '/assets/js/jquery.min.js');
  wp_enqueue_script( 'browser-min' , get_template_directory_uri() . '/assets/js/browser.min.js');

  wp_enqueue_script( 'jquery-scrollex-min' , get_template_directory_uri() . '/assets/js/jquery.scrollex.min.js', array('jquery'));
  wp_enqueue_script( 'jquery-scrolly-min' , get_template_directory_uri() . '/assets/js/jquery.scrolly.min.js', array('jquery'));
  wp_enqueue_script( 'utils-js' , get_template_directory_uri() . '/assets/js/util.js' , array( 'jquery' ));
  wp_enqueue_script( 'main-js' , get_template_directory_uri() . '/assets/js/main.js' , array( 'jquery' ));

}
add_action( 'wp_enqueue_scripts' , 'my_assets' );
?>
