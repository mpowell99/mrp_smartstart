<?php
/**
 * The comments template
 *
 * @package MRP-SmartStart
 * @since 1.0
 * @version 1.0
 */

?>

<section id="comments">
	<h6 class="section-title">Comments (<?php comments_number( '0', '1', '%' ); ?>)</h6>
	<ol class="comments-list">
        <?php
            $comments = get_comments( array(
				'post_id' => get_the_ID(),
				'status' => 'approve',
			));
            foreach( $comments as $key => $comment ) {
        ?>

		<li class="comment">
			<article>
				<!-- <img src="" alt="Image" class="avatar"> -->
				<?php echo get_avatar( $comment->comment_author_email, 54 ); ?>
				<div class="comment-meta">
					<h5 class="author">
                        <?php
                            if ( $comment->comment_author_url ) {
                                echo '<a href="'.esc_url( $comment->comment_author_url ).'">'.$comment->comment_author.'</a>';
                            } else {
                                echo $comment->comment_author;
                            }
                        ?>
						-
						<?php
							$comment_reply_args = array( 'depth' => 1, 'max_depth' => 2 );
							comment_reply_link( $comment_reply_args, $comment->ID, get_the_ID() );
						?>
					</h5>
					<p class="date"><?php comment_date( 'F d, Y', $comment->ID ); ?></p>
				</div><!-- end .comment-meta -->

				<div class="comment-body">
					<?php echo $comment->comment_content; ?>
				</div><!-- end .comment-body -->
			</article>
		</li>

        <?php
            }
        ?>
	</ol>
</section>

	<?php
		$comment_field = '<p class="textarea-block"><label for="comment-message"><strong>Your Comment</strong> (required)</label><textarea name="comment" id="comment-message" cols="88" rows="6" required></textarea></p>';


		$fields =  array(
			'author' => '<p class="input-block"><label for="comment-name"><strong>Name</strong> (required)</label><input type="text" name="author" value="" id="comment-name" required></p>',

			'email' => '<p class="input-block"><label for="comment-email"><strong>Email</strong> (required)</label><input type="email" name="email" value="" id="comment-email" required></p>',

			'url' => '<p class="input-block"><label for="comment-url"><strong>Website</strong></label><input type="url" name="url" value="" id="comment-url"></p>',
		);
		comment_form(
			array(
				'fields' => $fields,
				'comment_field' => $comment_field,
				'class_form' => 'comments-form',
				'label_submit' => 'Submit',
				'comment_notes_before' => '',
				'title_reply' => 'Leave a Comment',
			)
		);
	?>
