<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" <?php hybrid_attr( 'content' ); ?>>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					
					$comment = get_theme_mod( 'bulan-page-comment' );

					
					if ( $comment ) :
						
						if ( comments_open() || '0' != get_comments_number() ) :
							comments_template();
						endif;
					endif;
				?>

			<?php endwhile;  ?>

		</main>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
