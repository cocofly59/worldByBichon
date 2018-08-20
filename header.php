<?php
/**
 * The header for the theme Massively.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Massively
 */
?>
<head>
  <title>World by Bichon <?php if ( is_singular("post") ){ echo "it is a post.";} elseif (is_home()){echo "it is home.";} elseif (is_singular('page')) { echo "it is a page";} else { echo "it is nothing";}?></title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <noscript><link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/noscript.css" /></noscript>
  <?php wp_head(); ?>
</head>
