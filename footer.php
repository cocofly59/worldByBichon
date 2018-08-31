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


?>
<footer id="footer">
  <section>
    <h3>Social</h3>
    <ul class="icons alt">
      <li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
      <li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
      <li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
    </ul>
  </section>
  <!-- Dynamic styles -->
    <style type="text/css">

    #wrapper > .bg {

      background-image: url("../../images/overlay.png"), linear-gradient(0deg, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url("<?php echo $image; ?>");

    }

    </style>
  <?php wp_footer(); ?>
</footer>
