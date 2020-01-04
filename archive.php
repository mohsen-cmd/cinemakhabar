<?php get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" <?php hybrid_attr( 'content' ); ?>>

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header>

				<?php  ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php get_template_part( 'loop', 'nav' );  ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main>
	</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
