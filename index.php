<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) { ?>
			<?php while ( have_posts() ) { the_post(); ?>

				<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

 					<div class="entry-content">
 						<?php the_content(); ?>
 					</div><!-- .entry-content -->
 				</section><!-- #post-## -->

			<?php } // end while have_posts() ?>
		<?php } // end if have_posts() ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
