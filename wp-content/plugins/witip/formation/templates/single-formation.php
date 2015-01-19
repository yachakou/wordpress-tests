<?php

// Ceci est en quelques sortes la "vue" pour une formation, c'est ici qu'on personalisera l'affichage.

/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->

			Champ perso : <?php echo get_post_meta( get_the_ID(), 'date_debut', true); ?>

		</article><!-- #post-## -->


		<?php
			// End the loop.
			endwhile;
		?>


		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
