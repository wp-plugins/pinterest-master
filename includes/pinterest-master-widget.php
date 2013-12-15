<?php
//Hook Widget
add_action( 'widgets_init', 'pinterest_master_widget' );
//Register Widget
function pinterest_master_widget() {
register_widget( 'pinterest_master_widget' );
}

class pinterest_master_widget extends WP_Widget {
	function pinterest_master_widget() {
	$widget_ops = array( 'classname' => 'Pinterest Master', 'description' => __('Pinterest Master adds the follow me on pinterest, pin it button, show pinterest profile and show pinterest board to your wordpress website. ', 'pinterest_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'pinterest_master_widget' );
	$this->WP_Widget( 'pinterest_master_widget', __('Pinterest Master', 'pinterest_master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		//Our variables from the widget settings.
		$name = "Pinterest Master";
		$title = isset( $instance['title'] ) ? $instance['title'] :false;
		$pinterestspacer ="'";
		$show_pinterestfollow = isset( $instance['show_pinterestfollow'] ) ? $instance['show_pinterestfollow'] :false;
		$pinterestusername = $instance['pinterestusername'];
		echo $before_widget;
		
		// Display the widget title
	if ( $title )
		echo $before_title . $name . $after_title;
		//Display Pinterest Profile
	if ( $show_pinterestprofile )
		echo '<a data-pin-do="embedUser" href="http://pinterest.com/'.$pinterestusername.'/"></a></br></br>';
		//Display Pinterest Board
	if ( $show_pinterestboard )
		echo '<a data-pin-do="embedBoard" href="http://pinterest.com/'.$pinterestusername.'/'.$pinterestboard.'/"></a></br></br>';
		//Display Pinterest Follow Me Button
	if ( $show_pinterestfollow )
			echo '<span style="float: left"><a data-pin-do="buttonFollow" href="http://pinterest.com/'.$pinterestusername.'/">Pinterest</a>&nbsp;&nbsp;</span>';
		//Display Pin It Button
	if ( $show_pinterestpin )
			echo '<span style="float: left"><a data-pin-config="beside" href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" ><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a></span>';
	
	echo '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>' .
		$after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_pinterestfollow'] = $new_instance['show_pinterestfollow'];
		$instance['pinterestusername'] = $new_instance['pinterestusername'];
		$instance['show_pinterestpin'] = $new_instance['show_pinterestpin'];
		$instance['show_pinterestprofile'] = $new_instance['show_pinterestprofile'];
		$instance['show_pinterestboard'] = $new_instance['show_pinterestboard'];
		$instance['pinterestboard'] = $new_instance['pinterestboard'];
		return $instance;
	}
	function form( $instance ) {
	//Set up some default widget settings.
	$defaults = array( 'name' => __('Pinterest Master', 'pinterest_master'), 'title' => true, 'show_pinterestfollow' => false, 'pinterestusername' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<br>
		<b>Check the buttons to be displayed:</b>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['title'], true ); ?> id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><b><?php _e('Display Widget Title', 'pinterest_master'); ?></b></label></br>
	</p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; height:16px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_pinterestfollow'], true ); ?> id="<?php echo $this->get_field_id( 'show_pinterestfollow' ); ?>" name="<?php echo $this->get_field_name( 'show_pinterestfollow' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_pinterestfollow' ); ?>"><b><?php _e('Pinterest Follow Me Button', 'pinterest_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'pinterestusername' ); ?>"><?php _e('Pinterest Username:', 'pinterest_master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'pinterestusername' ); ?>" name="<?php echo $this->get_field_name( 'pinterestusername' ); ?>" value="<?php echo $instance['pinterestusername']; ?>" style="width:auto;" />
	</p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Pinterest Pin It Button</b>
	</p>
	<div class="description">Only available in advanced version.</div><br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Display Pinterest Profile</b>
	</p>
	<div class="description">Only available in advanced version.</div><br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Display Pinterest Board</b>
	</p>
	<div class="description">Only available in advanced version.</div><br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Shortcode Framework</b>
	</p>
	<div class="description">The shortcode framework allows you to insert Pinterest Master inside Pages & Posts without the need of extra plugins or gimmicks. Fast page load times and top SEO. Only available in advanced version.</div>
	<br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
	&nbsp;
	<b>Pinterest Master Website</b>
	</p>
	<p><a class="button-secondary" href="http://wordpress.techgasp.com/pinterest-master/" target="_blank" title="Pinterest Master Info Page">Info Page</a> <a class="button-secondary" href="http://wordpress.techgasp.com/pinterest-master-documentation/" target="_blank" title="Pinterest Master Documentation">Documentation</a> <a class="button-primary" href="http://wordpress.techgasp.com/pinterest-master/" target="_blank" title="Pinterest Master">Adv. Version</a></p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', __FILE__); ?>) repeat-x; height: 10px"></div>
		<p>
		<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', __FILE__); ?>" style="float:left; width:16px; vertical-align:middle;" />
		&nbsp;
		<b>Advanced Version Updater:</b>
		</p>
		<div class="description">The advanced version updater allows to automatically update your advanced plugin. Only available in advanced version.</div>
		<br>
	<?php
	}
 }
?>