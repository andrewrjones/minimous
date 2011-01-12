<?php
get_header(); ?>

	<?php if (have_posts()) : ?>
	
	<div id="content" class="narrowcolumn" role="main">

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<div class="date">
					<?php the_date() ?>
				</div>
				<div class="post-inner">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
					<?php if (is_single() || is_page()) wp_link_pages(array('before' => '<p><b>Pages</b> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					<ul class="menu">
						<li><ul>				
					<?php if (!is_page() || comments_open()) { echo '<li>'; comments_popup_link('Comments [0]', 'Comments [1]', 'Comments [%]'); echo '</li>'; } ?>
					<?php the_tags('<li>Tags [', ', ', ']</li>'); ?>
					<?php if (!is_page()) { echo '<li>Categories ['; the_category(', '); echo ']</li>'; } ?>
						</ul></li>
					</ul>
				</div>
				</div>
			</div>
			
			<?php if (is_single() || (is_page() && comments_open())) comments_template(); ?>
			
		<?php endwhile; ?>

		<div class="pagenavigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
		
	</div>
	
	<?php else : ?>
	
	<?php include dirname(__FILE__) . '/404.php'; exit; ?>
	
	<?php endif; ?>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
