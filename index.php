<!DOCTYPE HTML>
<!--
	Massively by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<?php
	get_header();
?>
	<body class="is-preload">
		<!-- Wrapper -->
		<div id="wrapper" class="fade-in">
			<!-- Intro -->
<?php
  if (is_my_home()):
    $subtitle = get_posts( array("title" => "subtitle") );
?>
			<div id="intro">
				<h1>
					<?php echo get_bloginfo( 'name' ); ?>
				</h1>
				<p>
					<?php echo $subtitle[0]->post_content; ?>
				</p>
				<ul class="actions">
					<li><a href="#header" class="button icon solo fa-arrow-down scrolly">Continue</a></li>
				</ul>
			</div>
<?php
  endif;
?>
			<!-- Header -->
			<header id="header">
				<a href="<?php echo get_home_url(); ?>" class="logo"><?php echo get_bloginfo( 'name' ); ?></a>
			</header>
			<!-- Nav -->
			<nav id="nav">
				<ul class="links">
<?php
	if (is_my_home()):
?>
					<li class="active"><a href="<?php echo get_home_url(); ?>"> Accueil </a></li>
<?php
	else:
?>
					<li><a href="<?php echo get_home_url(); ?>"> Home </a></li>
<?php
	endif;
	$pages = get_pages();
	$categories = get_categories(array(
	    'hide_empty'       => 0,
	    'orderby'          => 'name',
	    'selected'         => $category->parent,
	    'hierarchical'     => true,
	    'show_option_none' => __('None'),
			'parent'  => 0
	) );
	if (is_array($pages)):
		foreach ($pages as $page):
			if (is_singular("page") && $page->ID==get_page(get_the_ID())->ID):
?>
					<li class="active"><a href="<?php echo get_page_link( $page->ID ); ?>"> <?php echo $page->post_title; ?> </a></li>
<?php
			else:
?>
					<li><a href="<?php echo get_page_link( $page->ID ); ?>"> <?php echo $page->post_title; ?> </a></li>
<?php
			endif;
		endforeach;
	endif;
	foreach ( $categories as $category ):
		if ($category->name != "Uncategorized" ):
			if ($category->term_id == getCategoryId()):
?>
        <li class="active"><a href="<?php echo esc_url( get_category_link( $category->term_id ) ),"/page=1"; ?>"> <?php echo esc_html( $category->name ); ?> </a></li>
<?php
			else:
?>
        <li><a href="<?php echo esc_url( get_category_link( $category->term_id ) ),"/page=1"; ?>"> <?php echo esc_html( $category->name ); ?> </a></li>
<?php
			endif;
		endif;
	endforeach;
  $facebook = get_posts( array("title" => "facebook") );
  $instagram = get_posts( array("title" => "instagram") );
  $twitter = get_posts( array("title" => "twitter") );
?>
      </ul>
			<ul class="icons">
<?php
  if (count($twitter) == 1):
?>
				<li><a href="<?php echo $twitter[0]->post_content; ?>" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
<?php
  endif;
  if (count($facebook) == 1):
?>
				<li><a href="<?php echo $facebook[0]->post_content; ?>" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
<?php
  endif;
  if (count($instagram) == 1):
?>
				<li><a href="<?php echo $instagram[0]->post_content; ?>" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
<?php
  endif;
?>
			</ul>
		</nav>
<?php
	if (is_singular("post")):
?>
    <div id="main">
<?php
		  displayPost($post);
		  displayPagination();
		if ( comments_open() || get_comments_number() ) :
      comments_template();
		endif;
?>
    </div>
<?php
	elseif (is_singular("page")):
		$post=get_page(get_the_ID());
?>
    <div id="main">
<?php
      displayPost($post, true);
?>
    </div>
<?php
  else:
?>
    <div id="main">
<?php
  $targetByPage=10;
      displayTargets($targetByPage);
      displayPagination($targetByPage);
?>
    </div>
<?php
  endif;
    get_footer(); ?>
    <!-- Copyright -->
    <div id="copyright">
      <ul>
        <li>&copy; worldbybichon</li>
        <li>Design: <a href="https://html5up.net">HTML5 UP</a></li>
      </ul>
    </div>
  </div>

<!-- Scripts -->
<?php wp_footer(); ?>
  </body>
</html>
