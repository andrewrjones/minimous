<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page">

<div id="page-inner">
<div id="header" role="banner">
	<div id="header_nav">
	<ul class="menu">
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('header-menu') ) : ?>
	<?php else : ?>
<?php
		echo '<li><ul>';
		echo '<li class="page_item';
		if(is_home()) echo ' current_page_item';
		echo '"><a href="' . get_bloginfo('url') . '" title="' . get_bloginfo('name') . '"><span>' . __('Home','hybrid') . '</span></a></li>';
		wp_list_pages('title_li=&show_home=Home&depth=1');
		echo '</ul></li>'; ?>
		<li>
		<ul>
		<?php wp_register(); ?>
		</ul>
		</li>
	<?php endif; ?>
	</ul>
	</div>
	<div id="headerimg">
		<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
		<div class="description"><?php bloginfo('description'); ?></div>
	</div>
	
	<?php if (is_single()) { ?>
	<div id="back_to_blog">
		<a href="<?php echo get_option('home'); ?>/">&laquo; Back to blog</a>
	</div>
	<?php } ?>
</div>