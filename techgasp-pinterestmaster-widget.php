<?php
//Load Shortcode Framework

//Hook Widget
add_action( 'widgets_init', 'techgasp_pinterestmaster_widget' );
//Register Widget
function techgasp_pinterestmaster_widget() {
register_widget( 'techgasp_pinterestmaster_widget' );
}

class techgasp_pinterestmaster_widget extends WP_Widget {
	function techgasp_pinterestmaster_widget() {
	$widget_ops = array( 'classname' => 'Pinterest Master', 'description' => __('Pinterest Master adds the follow me on pinterest, pin it button, show pinterest profile and show pinterest board to your wordpress website. ', 'Pinterest Master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'techgasp_pinterestmaster_widget' );
	$this->WP_Widget( 'techgasp_pinterestmaster_widget', __('Pinterest Master', 'Pinterest master'), $widget_ops, $control_ops );
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
		//Display Pinterest Follow Me Button
	if ( $show_pinterestfollow )
			echo '&nbsp;&nbsp;<a data-pin-do="buttonFollow" href="http://pinterest.com/'.$pinterestusername.'/">Pinterest</a>';
	
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
		return $instance;
	}
	function form( $instance ) {
	//Set up some default widget settings.
	$defaults = array( 'name' => __('Pinterest Master', 'pinterest master'), 'title' => true, 'show_pinterestfollow' => false, 'pinterestusername' => false, 'show_pinterestpin' => false, 'show_pinterestprofile' => false, 'show_pinterestboard' => false, 'pinterestboard' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<b>Check the buttons to be displayed:</b>
	<p>
	<input type="checkbox" <?php checked( (bool) $instance['title'], true ); ?> id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><b><?php _e('Display Widget Title', 'pinterest master'); ?></b></label></br>
	</p>
	<hr>
	<p>
	<input type="checkbox" <?php checked( (bool) $instance['show_pinterestfollow'], true ); ?> id="<?php echo $this->get_field_id( 'show_pinterestfollow' ); ?>" name="<?php echo $this->get_field_name( 'show_pinterestfollow' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_pinterestfollow' ); ?>"><b><?php _e('Pinterest Follow Me Button', 'pinterest master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'pinterestusername' ); ?>"><?php _e('Pinterest Username:', 'pinterest master'); ?></label></br>
	<input id="<?php echo $this->get_field_id( 'pinterestusername' ); ?>" name="<?php echo $this->get_field_name( 'pinterestusername' ); ?>" value="<?php echo $instance['pinterestusername']; ?>" style="width:auto;" />
	</p>
	<hr>
	<p><b>Pinterest Master Advanced Version:</b> contains the extra Pin-it Button, Pinterest Profile Display and Pinterest Board Display. Also includes shortcode framework.</p>
	<p><a class="button-primary" href="http://wordpress.techgasp.com/pinterest-master/" target="_blank" title="Pinterest Master Advanced Version">Pinterest Master Advanced Version</a></p>
	<?php
	}
 }
?>
