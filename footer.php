<?php
/**
 * The footer for the theme Massively.
 *
 * Displays all of the <footer> section
 *
 * @package Massively
 */

 $image = "";

 if (is_singular("post") || is_singular("page")) {
   $parent_category_id=getCategoryId();
   $parent_category = get_term( $parent_category_id, 'category' );
   $query_images_args = array(
       'post_type'      => 'attachment',
       'post_mime_type' => 'image',
       'post_status'    => 'inherit',
       'title'     => $post->post_title." (background)"
   );
   $query_images = new WP_Query( $query_images_args );
   if (count($query_images->posts) == 1) {
     $image = wp_get_attachment_url($query_images->posts[0]->ID);
   } else {
     $query_images_args = array(
         'post_type'      => 'attachment',
         'post_mime_type' => 'image',
         'post_status'    => 'inherit',
         'title'     => "home"
     );
      $query_images = new WP_Query( $query_images_args );
      if (count($query_images->posts) == 1) {
        $image = wp_get_attachment_url($query_images->posts[0]->ID);
      } else {
        $image = get_template_directory_uri()."/images/bg.jpg";
      }
   }
 } else {
   if (is_my_home()) {
     $query_images_args = array(
         'post_type'      => 'attachment',
         'post_mime_type' => 'image',
         'post_status'    => 'inherit',
         'title'     => "home"
     );
      $query_images = new WP_Query( $query_images_args );
      if (count($query_images->posts) == 1) {
        $image = wp_get_attachment_url($query_images->posts[0]->ID);
      } else {
        $image = get_template_directory_uri()."/images/bg.jpg";
      }
   } else {
     $parent_category_id=getCategoryId();
     $parent_category = get_term( $parent_category_id, 'category' );
     $query_images_args = array(
         'post_type'      => 'attachment',
         'post_mime_type' => 'image',
         'post_status'    => 'inherit',
         'title'     => $parent_category->name." (background)"
     );
      $query_images = new WP_Query( $query_images_args );
      if (count($query_images->posts) == 1) {
        $image = wp_get_attachment_url($query_images->posts[0]->ID);
      } else {
        $query_images_args = array(
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'post_status'    => 'inherit',
            'title'     => "home"
        );
         $query_images = new WP_Query( $query_images_args );
         if (count($query_images->posts) == 1) {
           $image = wp_get_attachment_url($query_images->posts[0]->ID);
         } else {
           $image = get_template_directory_uri()."/images/bg.jpg";
         }
      }
  }
}

$facebook = get_posts( array("title" => "facebook") );
$instagram = get_posts( array("title" => "instagram") );
$twitter = get_posts( array("title" => "twitter") );

?>
<footer id="footer">
  <section>
    <h3>Social</h3>
    <ul class="icons alt">
      <ul class="icons">
<?php
  if (count($twitter) == 1):
?>
        <li><a target="_blank" href="<?php echo $twitter[0]->post_content; ?>" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
<?php
  endif;
  if (count($facebook) == 1):
?>
        <li><a target="_blank" href="<?php echo $facebook[0]->post_content; ?>" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
<?php
  endif;
  if (count($instagram) == 1):
?>
        <li><a target="_blank" href="<?php echo $instagram[0]->post_content; ?>" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
<?php
  endif;
?>
    </ul>
  </section>
  <!-- Dynamic styles -->
    <style type="text/css">

    #wrapper > .bg {

      background-image: url("<?php echo get_template_directory_uri()."/images/overlay.png"; ?>"), linear-gradient(0deg, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url("<?php echo $image; ?>");

    }

    </style>
  <?php wp_footer(); ?>
</footer>
