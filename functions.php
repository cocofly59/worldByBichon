<?php
/* enqueue styles and scripts */
function my_assets() {

  /* theme's primary style.css file */
  wp_enqueue_style( 'main-css' , get_stylesheet_uri() );

  /* boostrap resources from theme files */
  wp_enqueue_style( 'min-css' , get_template_directory_uri() . '/assets/css/font-awesome.min.css' );

  wp_deregister_script('jquery');
  wp_enqueue_script( 'jquery-min' , get_template_directory_uri() . '/assets/js/jquery.min.js');
  wp_enqueue_script( 'jquery-scrollex-min' , get_template_directory_uri() . '/assets/js/jquery.scrollex.min.js', array('jquery-min'), false, true);
  wp_enqueue_script( 'jquery-scrolly-min' , get_template_directory_uri() . '/assets/js/jquery.scrolly.min.js', array('jquery-min'), false, true);
  wp_enqueue_script( 'browser-min' , get_template_directory_uri() . '/assets/js/browser.min.js');
  wp_enqueue_script( 'breakpoint-min' , get_template_directory_uri() . '/assets/js/breakpoints.min.js');
  wp_enqueue_script( 'utils-js' , get_template_directory_uri() . '/assets/js/util.js' , array( 'jquery-min' ), false, true);
  wp_enqueue_script( 'main-js' , get_template_directory_uri() . '/assets/js/main.js' , array( 'jquery-min' ), false, true);

}
add_action( 'wp_enqueue_scripts' , 'my_assets' );

function displayFirstTarget($target, $isDisplayingCategories) {

if (getPageNumber() == 1):
  if ($isDisplayingCategories):
    $query_images_args = array(
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'post_status'    => 'inherit',
        'title'     => $target->name
    );

    $query_images = new WP_Query( $query_images_args );

    $images = array();
    foreach ( $query_images->posts as $image ) {
        $images[] = wp_get_attachment_url( $image->ID );
    }
?>
<article class="post featured">
  <header class="major">
    <h2><a href="<?php echo esc_url( get_category_link( $target->term_id ) ),"/page=1"; ?>"><?php echo $target->name; ?></a></h2>
    <p><?php echo $target->description; ?> </p>
  </header>
  <a href="<?php echo esc_url( get_category_link( $target->term_id ) ),"/page=1"; ?>" class="image main"><img src="<?php echo $images[0]; ?>" /></a>
  <ul class="actions special">
    <li><a href="<?php echo esc_url( get_category_link( $target->term_id ) ),"/page=1"; ?>" class="button large">Voir les articles</a></li>
  </ul>
</article>
<?php
  else:
    formatPost($target);
?>
<article class="post featured">
  <header class="major">
    <span class="date"><?php echo getMyDate($target); ?></span>
    <h2><a href="<?php echo get_page_link( $target->ID ); ?>"><?php echo $target->post_title; ?></a></h2>
    <?php echo getPostSummary($target, true); ?>
  </header>
  <a href="<?php echo get_page_link( $target->ID ); ?>" class="image main"><?php echo getFirstImage($target); ?></a>
  <ul class="actions special">
    <li><a href="<?php echo get_page_link( $target->ID ); ?>" class="button large">Lire</a></li>
  </ul>
</article>
<?php
  endif;
endif;
}

function displayTarget($target, $isDisplayingCategories) {
if ($isDisplayingCategories):
  $query_images_args = array(
      'post_type'      => 'attachment',
      'post_mime_type' => 'image',
      'post_status'    => 'inherit',
      'title'     => $target->name
  );

  $query_images = new WP_Query( $query_images_args );

  $images = array();
  foreach ( $query_images->posts as $image ) {
      $images[] = wp_get_attachment_url( $image->ID );
  }
?>
<article>
  <header>
    <h2><a href="<?php echo esc_url( get_category_link( $target->term_id ) ),"/page=1"; ?>"><?php echo $target->name; ?><br /></a></h2>
    <p><?php echo $target->description; ?></p>
  </header>
  <a href="<?php echo esc_url( get_category_link( $target->term_id ) ),"/page=1"; ?>" class="image main"><img src="<?php echo $images[0]; ?>" /></a>
  <ul class="actions special">
    <li><a href="<?php echo esc_url( get_category_link( $target->term_id ) ),"/page=1"; ?>" class="button">Voir les articles</a></li>
  </ul>
</article>
<?php
else:
  formatPost($target);
?>
<article>
  <header>
    <span class="date"><?php echo getMyDate($target); ?></span>
    <h2><a href="<?php echo get_page_link( $target->ID ); ?>"><?php echo $target->post_title; ?><br /></a></h2>
  </header>
  <a href="<?php echo get_page_link( $target->ID ); ?>" class="image fit"><?php echo getFirstImage($target); ?></a>
  <?php echo getPostSummary($target); ?>
  <ul class="actions special">
    <li><a href="<?php echo get_page_link( $target->ID); ?>" class="button">Lire</a></li>
  </ul>
</article>
<?php
endif;
}

function displayEmptyTargets() {
?>
  <article class="post featured">
    <header class="major">
      <h2>Désolé! <br/> Il n'y a pour l'instant aucun article dans cette section!</h2>
      <p>Le premier article arrivera bientôt.</p>
    </header>
  </article>
<?php
}

function displayEmptyArticle() {
  ?>
  <article>
  </article>
  <?php
}

function getPageNumber() {

  $current_url = $_SERVER['REQUEST_URI'];
  $to_find="/page=";
  $index = strpos($current_url, $to_find);
  $pageNumber = 0;
  if ($index !== false) {
    $pageNumber = intval(substr($current_url, $index + strlen($to_find) ));
  } elseif (is_home()) {
    $pageNumber = 1;
  }

  return $pageNumber;
}

function getCategoryId($url="") {
  if ($url=="") {
    $url=$_SERVER['REQUEST_URI'];
  }
  $to_find1="/?cat=";
  $index = strpos($url, $to_find1);
  $to_find2="/page=";
  $indexEnd = strpos($url, $to_find2);
  $catId = 0;
  if ($index !== false) {
    $catId = intval(substr($url, $index+strlen($to_find1)), $indexEnd);
  }
  return $catId;
}

function displayTargets($targetByPage=10) {
  $isDisplayingCategories = false;
  if (is_my_home()) {
    $allTargets = get_posts(array(
      'numberposts' => -1
    ));

    $targets = array();
    foreach ($allTargets as $key => $value) {
      $isUncategorized = false;
      $categories = get_the_category($value->ID) ;
      foreach ($categories as $keyCategory => $category) {
         if ($category->name == "Uncategorized") {
           $isUncategorized = true;
         }
      }
      if (!$isUncategorized) {
        array_push($targets, $value);
      }
    }
    $homePost = get_posts( array("title" => "home") );
    if (count($homePost) == 1) {
      formatPost($homePost[0]);
      ?>
      <article class="post featured">
        <?php echo $homePost[0]->post_content;  ?>
      </article>
      <?php
    }
  } else {
    $parent_category_id=getCategoryId();
    $parent_category = get_term( $parent_category_id, 'category' );
    if ($parent_category->parent) {
      $args = array(
        'category' => $parent_category_id
      );
      $targets = get_posts( $args );
    } else {
      $isDisplayingCategories = true;
      $targets = get_categories(
          array( 'parent' => $parent_category_id,
                 'hide_empty' => 0)
      );
    }
    ?>
    <article class="post featured">
      <header class="major">
        <h2><?php echo $parent_category->name; ?></h2>
        <p><?php echo $parent_category->description;  ?></p>
      </header>
    </article>
    <?php
  }
  if (count($targets) == 0) {
    displayEmptyTargets();
  } else {
    displayFirstTarget($targets[0], $isDisplayingCategories);
    ?>
    <section class="posts">
      <?php
    for ($index=(getPageNumber()-1)*$targetByPage + ((getPageNumber()==1)?1:0);
         $index < getPageNumber()*$targetByPage ;
         $index++) {
      if ($index < count($targets)) {
        displayTarget($targets[$index], $isDisplayingCategories);
      }
    }
    $numberPages = getNumberOfPagesForMenu($targetByPage);
    if (   $numberPages>0
        && (
               (getPageNumber() < $numberPages && $targetByPage%2==((getPageNumber()==1)?0:1))
            || (getPageNumber() == $numberPages && (count($targets) - ($numberPages-1)*$targetByPage)%2==((getPageNumber()==1)?0:1))
           )
        ) {
      displayEmptyArticle();
    }
      ?>
    </section>
    <?php

  }
}

function findPostId($posts, $ID) {
  foreach ($posts as $index => $post) {
    if ($post->ID == $ID) {
      return $index;
    }
  }
}

function findCategoriesId($categories, $ID) {
  foreach ($categories as $index => $category) {
    if ($category->term_id == $ID) {
      return $index;
    }
  }
}

function displayPagination($targetByPage=10) {
  $prevUrl = wp_get_referer();
  $parent_category_id = getCategoryId($prevUrl);
  if (is_singular("post")):
    $currentPost = get_post();
    if ($parent_category_id == 0) {
      $posts = get_posts();
    } else {
      $args = array(
        'category' => $parent_category_id
      );
      $posts = get_posts( $args );
    }
    $index = findPostId($posts, $currentPost->ID);
    $numPage = getPageNumber();

    if (count($posts) == 1):
  ?>
  <!-- Nothing to do -->
  <?php
    elseif ($index==0):
  ?>
  <footer>
    <div class="pagination">
      <a href="<?php echo get_page_link($posts[$index + 1]->ID); ?>" class="next">Suiv</a>
    </div>
  </footer>
  <?php
    elseif ($index==count($posts)-1):
  ?>
  <footer>
    <div class="pagination">
      <a href="<?php echo get_page_link($posts[$index - 1]->ID); ?>" class="previous">Préc</a>
    </div>
  </footer>
  <?php
    else:
  ?>
  <footer>
    <div class="pagination">
      <a href="<?php echo get_page_link($posts[$index - 1]->ID); ?>" class="previous">Préc</a>
      <a href="<?php echo get_page_link($posts[$index + 1]->ID); ?>" class="next">Suiv</a>
    </div>
  </footer>
  <?php
    endif;
  else:
    $numberPages = getNumberOfPagesForMenu($targetByPage);
    $numPage = getPageNumber();
    $current_category_id = getCategoryId();
    if ($numberPages == 0):
      /* Do nothing */

    elseif ($numPage<$numberPages):
  ?>
  <footer>
    <div class="pagination">
      <a href="<?php echo (is_my_home()?get_my_home_url():get_category_link($current_category_id)),"/page=",$numPage+1; ?>" class="next">Suiv</a>
    </div>
  </footer>
  <?php
    elseif ($numberPages>1 && $numPage==$numberPages):
  ?>
  <footer>
    <div class="pagination">
      <a href="<?php echo (is_my_home()?get_my_home_url():get_category_link($current_category_id)),"/page=",$numPage-1; ?>" class="previous">Préc</a>
    </div>
  </footer>
  <?php
    elseif ($numPage != 1 && $numPage <$numberPages):
  ?>
  <footer>
    <div class="pagination">
      <a href="<?php echo (is_my_home()?get_my_home_url():get_category_link($current_category_id)),"/page=",$numPage-1; ?>" class="previous">Préc</a>
      <a href="<?php echo (is_my_home()?get_my_home_url():get_category_link($current_category_id)),"/page=",$numPage+1; ?>" class="next">Suiv</a>
    </div>
  </footer>
  <?php
    endif;
  ?>

  <!--footer>
    <div class="pagination">
      <a href="#" class="page active">1</a>
      <a href="#" class="page">2</a>
      <a href="#" class="page">3</a>
      <span class="extra">&hellip;</span>
      <a href="#" class="page">8</a>
      <a href="#" class="page">9</a>
      <a href="#" class="page">10</a>
      <a href="#" class="next">Bouh</a>
    </div>
  </footer-->
  <?php
  endif;
}

function getNumberOfPagesForMenu($targetByPage) {
  if (is_my_home()) {
    $targets = get_posts();
  } else {
    $current_category_id = getCategoryId();
    $current_category = get_term( $current_category_id, 'category' );
    if ($current_category->parent) {
      $targets = get_posts( array(
        'category' => $current_category_id
      ) );
    } else {
      $targets = get_categories(
          array( 'parent' => $current_category_id,
                 'hide_empty' => 0)
      );
    }
  }
  return ceil(count($targets)/$targetByPage);
}

function is_my_home() {
  $answer = false;
  if (is_home()) {
    $answer = true;
  } else {
    $current_url = $_SERVER['REQUEST_URI'];
    $to_find="/?my_home";
    $index = strpos($current_url, $to_find);
    $pageNumber = 0;
    if ($index !== false) {
        $answer = true;
    }
  }
  return $answer;
}

function get_my_home_url() {
  return get_home_url(). "/?my_home";
}

function getFirstParagraph($post, $removeIt=false) {
  preg_match("@<p>(.{10,})</p>@", $post->post_content, $matches);
  if ($removeIt) {
    $indexBegin = strpos($post->post_content, $matches[0]);
    $post->post_content = str_replace($matches[0], "", $post->post_content);
  }
  return $matches[1];
}

function getPostSummary($post, $isFirstParagraph=false, $removeFirstParagraphe=false) {
  $sizeMax = 150;
  $text = getFirstParagraph($post, $removeFirstParagraphe);
  if (!$isFirstParagraph && strlen($text) > $sizeMax) {
    $text = substr($text, 0, $sizeMax-3 )."...";
  }
  return "<p>".$text."</p>";
}

function getFirstImage($post, $removeIt=false, $onlyUrl=false) {
  $found = preg_match('@<span class="image fit">(.*)</span>@', $post->post_content, $matches);
  preg_match('@src *= *"(?<src>[^"]*)"@', $matches[1], $src);
  preg_match('@href *= *"(?<href>[^"]*)"@', $matches[1], $href);
  $foundCaption = preg_match('@<span class="overlay"><span class="captionText">[^<^>]*</span></span>@',
              $matches[0],
              $caption);
  $answer = $src["src"];
  if (!$onlyUrl) {
    if ($found != 0) {
      if ($removeIt) {
        $post->post_content = str_replace($matches[0], "", $post->post_content);
        $answer= '<img src="'.$src["src"].'" />';
        $answer = '<a href="'.$href["href"].'">'.$answer.'</a>';
        if ($foundCaption) {
          $answer .= $caption[0];
        }
      } else {
        $answer= '<img src="'.$src["src"].'" />';
      }
    }
  }
  return $answer;
}

function formatPost($post) {
  $content = array();

  $post->post_content = preg_replace("@&nbsp;@", "", $post->post_content);
  $post->post_content = preg_replace("@<div> *</div>@", "", $post->post_content);
  $copyContent = $post->post_content;
  /* format images */
  $found = preg_match("@.*<img.*@",
                      $post->post_content,
                      $matches);
  while ($found == 1) {
    preg_match('@src *= *"(?<src>[^"]*)"@',
                $matches[0],
                $src);
    $foundCaption = preg_match('@([^<^>]*)\[/caption\]@',
                $matches[0],
                $caption);
    $answer= '<img src="'.$src["src"].'" />';
    $found = preg_match("@(.*)(?>-[0-9]{1,}x[0-9]{1,})\.([a-zA-Z]+)@",$src["src"], $secondMatches);
    if ($found == 1 ) {
      $href = $secondMatches[1].".".$secondMatches[2];
    } else {
      $href = $src["src"];
    }
    $answer = '<a href="'.$href.'">'.$answer.'</a>';
    if ($foundCaption == 1) {
      $answer .= '<span class="overlay"><span class="captionText">'.$caption[1].'</span></span>';
    }
    $answer = '<span class="image fit">'.$answer.' </span>';
    $content[strpos($copyContent, $matches[0])] = $answer;
    $post->post_content = str_replace($matches[0], "\n", $post->post_content);
    $found = preg_match("@.*<img.*@",
                        $post->post_content,
                        $matches);
  }
  /* format instagram post */
  $found = preg_match("@<blockquote(?>.|\n|(?>instagram-media))*</blockquote>@",
                      $post->post_content,
                      $matches);
  $post->post_content = str_replace("<script async defer src=\"//www.instagram.com/embed.js\"></script>",
                                    "",
                                    $post->post_content);

  while ($found == 1) {
    $answer = "<center>".$matches[0]."</center>"."<script async defer src=\"//www.instagram.com/embed.js\"></script>";
    $content[strpos($copyContent, $matches[0])] = $answer;
    $post->post_content = str_replace($matches[0], "\n", $post->post_content);
    $found = preg_match("@<blockquote(?>.|\n|(?>instagram-media))*</blockquote>@",
                        $post->post_content,
                        $matches);
  }
  /* format youtube's videos */
  $found = preg_match('@<iframe(.*(?>youtube).*)width="[0-9]*" height="[0-9]*"(.*)</iframe>@',
                      $post->post_content,
                      $matches);
  while ($found == 1) {
    $post->post_content = str_replace($matches[0], "", $post->post_content);
    $answer = '<div class="resp-container"><iframe class="resp-iframe" '.$matches[1].$matches[2].'></iframe></div>';
    $content[strpos($copyContent, $matches[0])] = $answer;
    $found = preg_match('@<iframe(.*(?>youtube).*)width="[0-9]*" height="[0-9]*"(.*)</iframe>@',
                        $post->post_content,
                        $matches);
  }
  /* format list */
  $found = preg_match("@(?<text><ul>([^<]|<[^u]|<l[^l]|<ul[^>])*(|<|<u|<ul)</ul>)@",
                      $post->post_content,
                      $matches);
  while ($found == 1) {
    $answer= '<p>'.$matches["text"].'</p>';
    $content[strpos($copyContent, $matches[0])] = str_replace("</div>", "", $answer);
    $post->post_content = str_replace($matches[0], "\n", $post->post_content);
    $found = preg_match("@(?<text><ul>([^<]|<[^u]|<l[^l]|<ul[^>])*(|<|<u|<ul)</ul>)@",
                        $post->post_content,
                        $matches);
  }
  /* format  text */
  $post->post_content = preg_replace("@<div>@", "", $post->post_content);
  $post->post_content = preg_replace("@</div>@", "", $post->post_content);

  $found = preg_match("@(?<text>.+)@",
                      $post->post_content,
                      $matches);
  while ($found == 1) {
    $answer= '<p>'.$matches["text"].'</p>';
    $content[strpos($copyContent, $matches[0])] = $answer;
    $post->post_content = str_replace($matches[0], "", $post->post_content);
    $found = preg_match("@(?<text>.+)@",
                        $post->post_content,
                        $matches);
  }
  $post->post_content = "";
  ksort($content);
  foreach ($content as $key => $value) {
    $post->post_content .= $value.'
    ';
  }

}

function getMyDate($post) {
  $englishMonths = array(
    "@0([0-9]{1} \w+ [0-9]{4})@",
    "@January@",
    "@February@",
    "@March@",
    "@April@",
    "@May@",
    "@June@",
    "@July@",
    "@August@",
    "@September@",
    "@October@",
    "@November@",
    "@December@",
  );

  $frenchMonths = array(
    "$1",
    "Janvier",
    "Fevrier",
    "Mars",
    "Avril",
    "Mai",
    "Juin",
    "Juillet",
    "Août",
    "Septembre",
    "Octobre",
    "Novembre",
    "Decembre",
  );

  $date = strftime("%d %B %G",strtotime($post->post_date));
  $date = preg_replace($englishMonths, $frenchMonths, $date);
  return $date;
}

function displayPost($post, $isPage=false) {
  ?>
  <section class="post">
    <header class="major">
      <?php
      formatPost($post);
      if (!$isPage):
      ?>
      <span class="date"><?php
      echo getMyDate($post);
      ?>
    </span>
      <?php
      endif;
      ?>
      <h1><?php echo $post->post_title;?></h1>
      <?php echo getPostSummary($post, true, true); ?>
    </header>
    <div class="image main"><?php echo getFirstImage($post, true); ?> </div>

  <?php
    echo $post->post_content;
  ?>
  </section>


  <?php
}
?>
