<?php
get_header();

$wp_query->query(array('pagename' => '404'));
?>

	<div id="content" class="narrowcolumn noleftcolumn">
<?php
	if (have_posts()) : the_post(); the_content();
	else :?>
		<h2>Page Not Found</h2>
		<p>You are looking for something that could not be found. To find whatever it is you are looking for, you could:</p>
		<ol>
			<li>Search for a different keyword;</li>
			<li>Select a monthly archive;</li> 
			<li>Browse through the categories used on the blog; or
				<ul class="archives">
					<?php wp_list_categories('orderby=name&show_count=1&title_li='); ?>
				</ul>
			</li>
			<li>Browse through the last 20 posts published on this blog.
				<ul class="archives">
					<?php $myposts = query_posts('numberposts=20&offset=0&order=DESC');
					if ( have_posts() ) : while ( have_posts() ) : the_post() ; ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <small>- <?php the_date() ?></small></li>
					<?php endwhile; else:
					endif; ?>
				</ul>
			</li>
		</ol>
<?php endif; ?>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
