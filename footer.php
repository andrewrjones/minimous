	<div id="footer">
		<ul class="menu">
		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer') ) : ?>
		<?php else : ?>
			<li>Copyright &copy; <?php bloginfo('name'); ?> <?php echo date('Y') == 2009 ? date('Y') : '2009 - '.date('Y')?>
		<?php endif; ?>
			<li>Powered by <a href="http://wordpress.org/">Wordpress</a>,
				<a href="http://www.webtatic.com/projects/minimous/">Minimous</a> theme.</li>
		<?php wp_footer(); ?>
		</ul>
	</div>
</body>
</html>
