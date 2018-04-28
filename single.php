<?php
/**
 * Template for Single Blog Entry
 *
 * @package MRP-SmartStart
 * @since 1.0
 * @version 1.0
 */


get_header();
the_post();

?>
	<header class="page-header">
		<h1 class="page-title">Welcome to our blog</h1>
	</header><!-- end .page-header -->

	<section id="main">

		<article class="entry single clearfix">

			<a href="<?php echo esc_url( the_permalink() ); ?>" title="">
				<?php the_post_thumbnail( 'blog-header' ); ?>
			</a>

			<div class="entry-body">
				<a href="<?php echo esc_url( the_permalink() ); ?>">
					<h1 class="title"><?php the_title(); ?></h1>
				</a>
				<?php the_content(); ?>
			</div><!-- end .entry-body -->

			<div class="entry-meta">
				<ul>
					<li><a href="<?php echo esc_url( the_permalink() ); ?>"><span class="post-format">Permalink</span></a></li>
					<li><span class="title">Posted:</span> <a href="
						<?php
							$archive_year  = get_the_time( 'Y' );
							$archive_month = get_the_time( 'm' );
							$archive_day   = get_the_time( 'd' );
							echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) );
						?>
						"><?php the_date( 'M j Y' ); ?></a></li>
					<li><span class="title">Tags:</span> <?php the_tags( '' ); ?></li>
					<li><span class="title">Comments:</span> <a href="<?php esc_url( the_permalink() ); ?>#comments"><?php comments_number( '0', '1', '%' ); ?></a></li>
				</ul>
			</div><!-- end .entry-meta -->
		</article><!-- end .entry -->

		<?php comments_template(); ?>
	</section><!-- end #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
