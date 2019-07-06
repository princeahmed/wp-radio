<?php

namespace Prince\WP_Radio;

/* Block direct access */
defined( 'ABSPATH' ) || exit();

/**
 * Class Widget
 *
 * Register widget for this plugin
 *
 * @package Prince\WP_Radio
 */
class Widget extends \WP_Widget {

	/**
	 * Register widget with WordPress.
	 */

	function __construct() {
		add_action( 'widgets_init', array( $this, 'register_widget' ) );
		parent::__construct(
			'wp-radio-widget', // Base ID
			esc_html__( 'WP Radio Player', 'wp-radio' ), // Name
			array( 'description' => esc_html__( 'WP Radio Player Widget', 'wp-radio' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $widget_args, $instance ) {

		echo $widget_args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $widget_args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $widget_args['after_title'];
		}

		wp_radio_get_template('player/player');

		echo $widget_args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Radio Player', 'wp-radio' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'wp-radio' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_attr_e( 'Layout:', 'wp-radio' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            <img src="<?php echo PRINCE_ASSETS_URL.'/full-width.png' ?>" alt="">
            <img src="<?php echo PRINCE_ASSETS_URL.'/left-sidebar.png' ?>" alt="">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

	// register WP_Radio_Widget widget
	public function register_widget() {
		register_widget( get_class($this) );
	}

}

new Widget();