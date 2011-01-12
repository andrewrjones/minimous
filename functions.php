<?php

automatic_feed_links();

include dirname(__FILE__) . '/widgets/profile.php';

widget_minimous_profile_register();

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
	
	register_sidebar(array(
		'id' => 'header-menu',
		'name' => 'Header Navigation',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
	
	register_sidebar(array(
		'id' => 'footer',
		'name' => 'Footer',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}


function minimous_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="date"><?php echo get_comment_date() ?></div>
      <div class="avatar"><?php echo get_avatar($comment,$size='35',$default='<path_to_url>' ); ?></div>
      <div class="comment-inner">
      <div class="comment-author vcard">
         <?php printf(__('<cite class="fn">%s</cite> <span class="says">said...</span>'), get_comment_author_link()) ?>
         <?php edit_comment_link(__('(Edit)'),'  ','') ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>

      <?php comment_text() ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
      </div>
     </div>
<?php
        }
