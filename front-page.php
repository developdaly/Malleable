<?php
/**
 * Template Name: Front Page
 *
 * Useful for sites that need a news-type front page.
 */

get_header(); ?>

	<div class="hfeed content">

		<?php hybrid_before_content(); // Before content hook ?>

		<div id="slider-container">

			<div id="slider">

			<?php
				if ( $malleable_settings['feature_category'] )
					$feature_query = array( 'cat' => $malleable_settings['feature_category'], 'showposts' => $malleable_settings['feature_num_posts'], 'caller_get_posts' => 1 );
				else
					$feature_query = array( 'post__in' => get_option( 'sticky_posts' ), 'showposts' => $malleable_settings['feature_num_posts'] );
			?>

				<?php query_posts( $feature_query ); ?>

				<?php while ( have_posts() ) : the_post(); $do_not_duplicate[] = $post->ID; ?>

					<div class="<?php hybrid_entry_class( 'feature' ); ?>">
						
						<?php get_the_image( array( 'custom_key' => array( 'Medium', 'Feature Image' ), 'default_size' => 'medium' ) ); ?>

						<?php hybrid_before_entry(); ?>

						<div class="entry-summary entry">
							<?php the_excerpt(); ?>
						</div>

						<?php hybrid_after_entry(); ?>

					</div>

				<?php endwhile; wp_reset_query(); ?>

			</div>

		</div>

		<div id="excerpts">

			<?php query_posts( array( 'cat' => $malleable_settings['excerpt_category'], 'showposts' => $malleable_settings['excerpt_num_posts'], 'caller_get_posts' => 1, 'post__not_in' => $do_not_duplicate ) ); ?>

			<?php while( have_posts() ) : the_post(); $do_not_duplicate[] = $post->ID; ?>

				<div class="<?php hybrid_entry_class(); ?>">

					<?php hybrid_before_entry(); ?>

					<div class="entry-summary entry">
						<?php get_the_image( array( 'custom_key' => array( 'Thumbnail', 'Feature Image Thumbnail' ), 'default_size' => 'thumbnail', 'height' => '125', 'width' => '125' ) ); ?>
						<?php the_excerpt(); ?>
					</div>

					<?php hybrid_after_entry(); ?>

				</div>

			<?php endwhile; wp_reset_query(); ?>

		</div>

		<?php if ( !empty( $malleable_settings['headlines_category'] ) ) : $alt = 'odd'; ?>

			<div id="headlines">

			<?php foreach ( $malleable_settings['headlines_category'] as $category ) : ?>

				<?php $headlines = get_posts( array(
					'numberposts' => $malleable_settings['headlines_num_posts'], 
					'category' => $category, 
					'post__not_in' => $do_not_duplicate
				) ); ?>

				<?php if ( !empty( $headlines ) ) : ?>

					<div class="section <?php echo $alt; ?>">

						<?php $cat = get_category( $category ); ?>

						<h3 class="section-title"><a href="<?php echo get_category_link( $category ); ?>" title="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></a></h3>

						<ul>
						<?php foreach ( $headlines as $post ) : $do_not_duplicate[] = $post->ID; ?>
							<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
						<?php endforeach; ?>
						</ul>

					</div>

					<?php if ( $i++ % 2 == 0 ) $alt = 'even'; else $alt = 'odd'; ?>

				<?php endif; ?>

			<?php endforeach; ?>

			</div>

		<?php endif; ?>

		<?php hybrid_after_page(); // After page hook ?>

		<?php hybrid_after_content(); // After content hook ?>

	</div>

<?php get_footer(); ?>