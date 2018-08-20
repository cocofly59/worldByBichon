<!DOCTYPE HTML>
<!--
	Massively by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<?php get_header(); ?>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper" class="fade-in">

				<!-- Intro -->
					<?php if (is_home()): ?>
					<div id="intro">
						<h1>Welcome to <br />
						World by Bichon</h1>
						<p>Un site tenu par des bichons pour vous faire voyager!</p>
						<ul class="actions">
							<li><a href="#header" class="button icon solo fa-arrow-down scrolly">Continue</a></li>
						</ul>
					</div>
				<?php endif ?>

				<!-- Header -->
					<header id="header">
						<a href="<?php echo get_home_url(); ?>" class="logo">World by Bichon</a>
					</header>

				<!-- Nav -->
					<nav id="nav">
						<ul class="links">
							<?php if (is_home()): ?>
								<li class="active"><a href="<?php echo get_home_url(); ?>"> Home </a></li>
							<?php else: ?>
								<li><a href="<?php echo get_home_url(); ?>"> Home </a></li>
						  <?php endif ?>
							<?php
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
							<?php else: ?>
									<li><a href="<?php echo get_page_link( $page->ID ); ?>"> <?php echo $page->post_title; ?> </a></li>
							<?php
									endif;
								endforeach;
							endif;
							foreach ( $categories as $category ):
								if ($category->name != "Uncategorized" ):
									if ($category->term_id==get_query_var('cat')):
							?>
									 <li class="active"><a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"> <?php echo esc_html( $category->name ); ?> </a></li>
							<?php else: ?>
							    <li><a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"> <?php echo esc_html( $category->name ); ?> </a></li>
							<?php
									endif;
								endif;
							endforeach;
							?>
						</ul>
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						</ul>
					</nav>
					<?php
					if (is_singular("post")):
						$post=get_post();
					?>
					<div id="main">
						<!-- Post -->
							<section class="post">
								<header class="major">
									<span class="date"><?php echo $post->post_date;?></span>
									<h1><?php echo $post->post_title;?></h1>
									<p><?php echo $post->post_content;?><br /></p>
								</header>
								<div class="image main"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/pic01.jpg" alt="" /></div>
								<p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis. Praesent rutrum sem diam, vitae egestas enim auctor sit amet. Pellentesque leo mauris, consectetur id ipsum sit amet, fergiat. Pellentesque in mi eu massa lacinia malesuada et a elit. Donec urna ex, lacinia in purus ac, pretium pulvinar mauris. Nunc lorem mauris, fringilla in aliquam at, euismod in lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur sapien risus, commodo eget turpis at, elementum convallis enim turpis, lorem ipsum dolor sit amet nullam.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dapibus rutrum facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam tristique libero eu nibh porttitor fermentum. Nullam venenatis erat id vehicula viverra. Nunc ultrices eros ut ultricies condimentum. Mauris risus lacus, blandit sit amet venenatis non, bibendum vitae dolor. Nunc lorem mauris, fringilla in aliquam at, euismod in lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In non lorem sit amet elit placerat maximus. Pellentesque aliquam maximus risus. Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis. Praesent rutrum sem diam, vitae egestas enim auctor sit amet. Pellentesque leo mauris, consectetur id ipsum.</p>
							</section>
							<?php
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
						<!-- Post -->
							<section class="post">
								<header class="major">
									<h1><?php echo $post->post_title;?></h1>
									<p><?php echo $post->post_content;?><br /></p>
								</header>
								<div class="image main"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/pic01.jpg" alt="" /></div>
								<p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis. Praesent rutrum sem diam, vitae egestas enim auctor sit amet. Pellentesque leo mauris, consectetur id ipsum sit amet, fergiat. Pellentesque in mi eu massa lacinia malesuada et a elit. Donec urna ex, lacinia in purus ac, pretium pulvinar mauris. Nunc lorem mauris, fringilla in aliquam at, euismod in lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur sapien risus, commodo eget turpis at, elementum convallis enim turpis, lorem ipsum dolor sit amet nullam.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dapibus rutrum facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam tristique libero eu nibh porttitor fermentum. Nullam venenatis erat id vehicula viverra. Nunc ultrices eros ut ultricies condimentum. Mauris risus lacus, blandit sit amet venenatis non, bibendum vitae dolor. Nunc lorem mauris, fringilla in aliquam at, euismod in lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In non lorem sit amet elit placerat maximus. Pellentesque aliquam maximus risus. Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis. Praesent rutrum sem diam, vitae egestas enim auctor sit amet. Pellentesque leo mauris, consectetur id ipsum.</p>
							</section>
							<!-- <php
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
							?> -->
					</div>
					<?php
					elseif (is_home()):
						$args = array(
							'numberposts' => 10
						);
						$latest_posts = get_posts( $args );
					?>
					<div id="main">
						<article class="post featured">
							<header class="major">
								<span class="date"><?php echo $latest_posts[0]->post_date; ?></span>
								<h2><a href="<?php echo get_page_link( $latest_posts[0]->ID ); ?>"><?php echo $latest_posts[0]->post_title; ?></a></h2>
								<?php echo $latest_posts[0]->post_content; ?>
							</header>
							<a href="<?php echo get_page_link( $latest_posts[0]->ID ); ?>" class="image main"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/pic01.jpg"="" /></a>
							<ul class="actions special">
								<li><a href="<?php echo get_page_link( $latest_posts[0]->ID ); ?>" class="button large">Full Story</a></li>
							</ul>
						</article>
						<section class="posts">
							<?php
							foreach ($latest_posts as $index => $post) {

								if ($index > 0 ) {?>
								<article>
									<header>
										<span class="date"><?php echo $post->post_date; ?></span>
										<h2><a href="<?php echo get_page_link( $post->ID ); ?>"><?php echo $post->post_title; ?><br /></a></h2>
									</header>
									<a href="<?php echo get_page_link( $post->ID ); ?>" class="image fit"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/pic02.jpg"="" /></a>
									<?php echo $post->post_content; ?>
									<ul class="actions special">
										<li><a href="<?php echo get_page_link( $post->ID ); ?>" class="button">Full Story</a></li>
									</ul>
								</article>
							<?php } } ?>
						</section>

						<!-- Footer -->
							<footer>
								<div class="pagination">
									<!--<a href="#" class="previous">Prev</a>-->
									<a href="#" class="page active">1</a>
									<a href="#" class="page">2</a>
									<a href="#" class="page">3</a>
									<span class="extra">&hellip;</span>
									<a href="#" class="page">8</a>
									<a href="#" class="page">9</a>
									<a href="#" class="page">10</a>
									<a href="#" class="next">Next</a>
								</div>
							</footer>
						</div>
					<?php
					else:
						$parent_category_id=get_query_var('cat');
						$parent_category = get_term( $parent_category_id, 'category' );
						$categories=get_categories(
								array( 'parent' => $parent_category_id,
							 				 'hide_empty' => 0)
						);
					?>
					<div id="main">
						<article class="post featured">
					    <header class="major">
					      <h2><?php echo $parent_category->name; ?></h2>
					      <p><?php echo $parent_category->description;  ?></p>
					    </header>
					  </article>
					<?php
						if ($parent_category->parent):
							$args = array(
								'numberposts' => 10,
								'category' => $parent_category_id
							);
							$latest_posts = get_posts( $args );
							if (count($latest_posts)>0):
					?>
					<article class="post featured">
						<header class="major">
							<span class="date"><?php echo $latest_posts[0]->post_date; ?></span>
							<h2><a href="<?php echo get_page_link( $latest_posts[0]->ID ); ?>"><?php echo $latest_posts[0]->post_title; ?></a></h2>
							<?php echo $latest_posts[0]->post_content; ?>
						</header>
						<a href="<?php echo get_page_link( $latest_posts[0]->ID ); ?>" class="image main"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/pic01.jpg"="" /></a>
						<ul class="actions special">
							<li><a href="<?php echo get_page_link( $latest_posts[0]->ID ); ?>" class="button large">Full Story</a></li>
						</ul>
					</article>
					<section class="posts">
						<?php
						foreach ($latest_posts as $index => $post) {

							if ($index > 0 ) {?>
							<article>
								<header>
									<span class="date"><?php echo $post->post_date; ?></span>
									<h2><a href="<?php echo get_page_link( $post->ID ); ?>"><?php echo $post->post_title; ?><br /></a></h2>
								</header>
								<a href="<?php echo get_page_link( $post->ID ); ?>" class="image fit"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/pic02.jpg"="" /></a>
								<?php echo $post->post_content; ?>
								<ul class="actions special">
									<li><a href="<?php echo get_page_link( $post->ID ); ?>" class="button">Full Story</a></li>
								</ul>
							</article>
						<?php } } ?>
					</section>
					<?php
						endif;
					else:
						if (count($categories)>0):
						?>
						<article class="post featured">
							<header class="major">
								<h2><a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>"><?php echo $categories[0]->name; ?></a></h2>
								<p><?php echo $categories[0]->description; ?> </p>
							</header>
							<ul class="actions special">
								<li><a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="button large">Full Story</a></li>
							</ul>
						</article>
						<section class="posts">
							<?php
							foreach ($categories as $index => $category):
								if ($index > 0 ):?>
								<article>
									<header>
										<h2><a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo $category->name; ?><br /></a></h2>
										<p><?php echo $category->description; ?></p>
									</header>

									<ul class="actions special">
										<li><a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="button">Full Story</a></li>
									</ul>
								</article>
							<?php
								endif;
							endforeach;
							if (count($categories) > 1 && count($categories)%2 == 0):
					 		?>
							<article>
							</article>
							<?php
							endif;
							?>
						</section>
					<?php
					endif
					?>
						<!-- Footer -->
						  <footer>
						    <div class="pagination">
						      <!--<a href="#" class="previous">Prev</a>-->
						      <a href="#" class="page active">1</a>
						      <a href="#" class="page">2</a>
						      <a href="#" class="page">3</a>
						      <span class="extra">&hellip;</span>
						      <a href="#" class="page">8</a>
						      <a href="#" class="page">9</a>
						      <a href="#" class="page">10</a>
						      <a href="#" class="next">Next</a>
						    </div>
						  </footer>
						<?php
						endif;
					 	?>
					</div>
					<?php
					endif
					?>
					<!-- Footer -->
					<?php get_footer(); ?>
				<!-- Copyright -->
					<div id="copyright">
						<ul><li>&copy; worldbybichon</li><li>Design: <a href="https://html5up.net">HTML5 UP</a></li></ul>
					</div>

			</div>

		<!-- Scripts -->
			<?php wp_footer(); ?>
	</body>
</html>
