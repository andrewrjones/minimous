<?php

/**
* Advanced page/link widget
* Replaces the default WordPress Pages widget
* Arguments are input through the widget control panel
*
* @since 0.3.2
*/
function widget_minimous_profile($args, $widget_args = 1) {

	extract($args, EXTR_SKIP);

	if(is_numeric($widget_args))
		$widget_args = array('number' => $widget_args);

	$widget_args = wp_parse_args($widget_args, array('number' => -1));

	extract($widget_args, EXTR_SKIP);

	$options = get_option('widget_minimous_profile');

	if(!isset($options[$number]))
		return;

	$username = $options[$number]['username'];
	$curauth = get_userdatabylogin($username);
	echo '<li>';
	echo get_avatar($curauth->ID, 75);
	echo '<p>' . $curauth->description . '</p>';
	echo '</li>';
}

/**
* Widget controls for the pages widget
* Options are chosen from user input from the widget panel
*
* @since 0.3.2
*/
function widget_minimous_profile_control($widget_args) {

	global $wp_registered_widgets;

	static $updated = false;

	if(is_numeric($widget_args))
		$widget_args = array('number' => $widget_args);

	$widget_args = wp_parse_args($widget_args, array('number' => -1));

	extract($widget_args, EXTR_SKIP);

	$options = get_option('widget_minimous_profile');

	if(!is_array($options))
		$options = array();

	if(!$updated && !empty($_POST['sidebar'])) :

		$sidebar = (string)$_POST['sidebar'];
		
		$sidebars_widgets = wp_get_sidebars_widgets();

		if(isset($sidebars_widgets[$sidebar]))
			$this_sidebar =& $sidebars_widgets[$sidebar];
		else
			$this_sidebar = array();

		foreach($this_sidebar as $_widget_id) :

			if('widget_minimous_profile' == $wp_registered_widgets[$_widget_id]['callback'] && isset($wp_registered_widgets[$_widget_id]['params'][0]['number'])) :

				$widget_number = $wp_registered_widgets[$_widget_id]['params'][0]['number'];

				unset($options[$widget_number]);

			endif;

		endforeach;

		foreach((array)$_POST['widget-minimous-profile'] as $widget_number => $widget_minimous_profile) :

			$username = strip_tags(stripslashes($widget_minimous_profile['username']));
			$options[$widget_number] = compact('username');

		endforeach;
		
		update_option('widget_minimous_profile', $options);

		$updated = true;

	endif;

	if($number == -1) :
		$username = 'andy';
		$number = '%i%';
	else :
		$username = attribute_escape($options[$number]['username']);
	endif;

?>

	<div style="float:left;width:100%;">
	<p>
		<label for="minimous-profile-username-<?php echo $number; ?>">
			<?php _e('Username:','minimous'); ?>
		</label>
		<input id="minimous-profile-username-<?php echo $number; ?>" name="widget-minimous-profile[<?php echo $number; ?>][username]" type="text" value="<?php echo $username; ?>" style="width:100%;" />
	</p>
	</div>

	<p style="clear:both;">
		<input type="hidden" id="minimous-profile-submit-<?php echo $number; ?>" name="minimous-profile-submit-<?php echo $number; ?>" value="1" />
	</p>
<?php

}

/**
* Register the pages widget
* Register the pages widget controls
*
* @since 0.3.2
*/
function widget_minimous_profile_register() {

	if(!$options = get_option('widget_minimous_profile'))
		$options = array();

	$widget_ops = array(
		'classname' => 'profile',
		'description' => __('A widget that displays your avatar and bio','minimous'),
	);

	$control_ops = array(
//		'width' => 700,
//		'height' => 350,
		'id_base' => 'minimous-profile',
	);

	$name = __('Profile','minimous');

	$id = false;
	
	
	foreach(array_keys($options) as $o) :

		$id = 'minimous-profile-' . $o;

		wp_register_sidebar_widget($id, $name, 'widget_minimous_profile', $widget_ops, array('number' => $o));

		wp_register_widget_control($id, $name, 'widget_minimous_profile_control', $control_ops, array('number' => $o));

	endforeach;

	if(!$id) :

		wp_register_sidebar_widget('minimous-profile-1', $name, 'widget_minimous_profile', $widget_ops, array('number' => -1));

		wp_register_widget_control('minimous-profile-1', $name, 'widget_minimous_profile_control', $control_ops, array('number' => -1));

	endif;

}

?>