<?php
/**
 * The template for displaying team members
 * test
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div id="teammembers">
		<?php
		// Start the loop.
		$i = 0;
	    query_posts(array(
	        'post_type'		=> 'team-member',
	        'showposts'		=> 12,
		    'orderby'		=> 'title',
		    'order'			=> 'ASC'
	    ) );

		while ( have_posts() ) : the_post();
		?>
			<?php $i++; ?>

			<div class="col">
				<div class="avatar">
					<?php
			        echo '<a href="' . get_permalink( $_post->ID ) . '" title="' . esc_attr( $_post->post_title ) . '">';
				    if ( has_post_thumbnail( $_post->ID ) ) {
				        echo get_the_post_thumbnail( $_post->ID, 'mythumb380x180', array( 'class' => 'imgresponsive' ) );
				    } else{
					    echo '<img src="holder.js/320x180">';
				    }
					echo '</a>';
					?>
				</div>

				<div class="title">
					<a href="<?php the_permalink(); ?>" title="<?php esc_attr( $_post->post_title ); ?>">
						<?php the_title(); ?>
					</a>
				</div>

				<div class="position">
					<?php echo get_post_meta($post->ID, 'position', true ); ?>
				</div>

				<div class="socials">
					<a href="<?php echo esc_url( get_post_meta($post->ID, 'facebook_url', true) ); ?>" class="facebook" title="facebook" target="_blank">
						<img src="<?php echo plugins_url( 'css/images/facebook.png', dirname(__FILE__) )?>" alt="facebook"/>
					</a>
					<a href="<?php echo esc_url( get_post_meta($post->ID, 'twitter_url', true) ); ?>" class="twitter" title="twitter" target="_blank">
						<img src="<?php echo plugins_url( 'css/images/twitter.png', dirname(__FILE__) )?>" alt="twitter"/>
					</a>
				</div>

				<a class="btn btn-primary toggle_<?php echo $post->ID; ?>"  href="javascript:void(0)" onclick="readMore_show(<?php echo $post->ID; ?>);">Read More</a>

				<div class="editor content_<?php echo $post->ID; ?>">
					<?php  echo get_the_content() ?>
					<br/>
					<a class="btn btn-primary readless_<?php echo $post->ID; ?>"  href="javascript:void(0)" onclick="readMore_hide(<?php echo $post->ID; ?>);">Read Less</a>
				</div>
			</div>
		<?php if ( $i%3 == 0 ) echo '<div class="clearfix"></div>'; ?>

		<?php
		// End of the loop.
		endwhile;
		?>
		</div>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>