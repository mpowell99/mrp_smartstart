<?php
/**
 * The main template file, and archive for blog entries
 *
 * @package MRP-SmartStart
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

	<header class="page-header">
		<h1 class="page-title">
			<?php
				echo get_theme_mod( 'blog_title' );
				if ( is_category() ) {
					echo ': ';
					echo single_cat_title();
				}
			?>
		</h1>
	</header><!-- end .page-header -->

	<section id="main">
		<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
		?>

		<article class="entry clearfix">
			<a href="<?php esc_url( the_permalink() ); ?>" title="">
				<?php the_post_thumbnail( 'blog-header' ); ?>
			</a>

			<div class="entry-body">
				<a href="<?php esc_url( the_permalink() ); ?>">
					<h1 class="title"><?php the_title(); ?></h1>
				</a>
				<?php the_excerpt(); ?>
			</div><!-- end .entry-body -->

			<div class="entry-meta">
				<ul>
					<li><a href="<?php esc_url( the_permalink() ); ?>"><span class="post-format">Permalink</span></a></li>
					<li><span class="title">Posted:</span> <a href="<?php
							$archive_year  = get_the_time( 'Y' );
							$archive_month = get_the_time( 'm' );
							$archive_day   = get_the_time( 'd' );
							echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) );
						?>"><?php echo get_the_date( 'M j Y' ); ?></a></li>
					<li><span class="title">Tags:</span> <?php the_tags( '' ); ?></li>
					<li><span class="title">Comments:</span> <a href="<?php esc_url( the_permalink() ); ?>#comments"><?php comments_number( '0', '1', '%' ); ?></a></li>
				</ul>
			</div><!-- end .entry-meta -->

		</article><!-- end .entry -->

		<?php
				}
			}
		?>

	<?php wp_pagenavi(); ?>

	</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
