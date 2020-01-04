<?php

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'bulan' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'bulan' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'bulan' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'bulan' ) ); ?></div>
		</nav>
		<?php endif;  ?>

		<ol class="commentlist">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'callback'    => 'bulan_comment'
				) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'bulan' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'bulan' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'bulan' ) ); ?></div>
		</nav>
		<?php endif; ?>

	<?php endif; ?>

	<?php
	
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'bulan' ); ?></p>
	<?php endif; ?>

	<?php comment_form(
		array(
			'comment_notes_after' => false,
			'title_reply'         => __( 'Leave a Comment', 'bulan' ),
			'comment_field'       =>  '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . __( 'Comment', 'bulan' ) . '">' . '</textarea></p>',
		)
	); ?>

</div>
