<?
/**
 * Mortgage Rates by WPrequal Widget.
 *
 * Displays WPrequal moergage rates widget in widget areas.
 *
 * @since 1.0
 */
 
class WPrequal_Mortgage_Rates_Widget extends WP_Widget {
	
	/** constructor */
	public function __construct() {
		parent::__construct(
			'wprequal_rates',
			__( 'Mortgage Rates by WPrequal', 'wprequal_rates' ),
			array( 'description' => __( 'Add a mortgage rates widget', 'wprequal_rates' ), )
		);
	}
	
	/** @see WP_Widget::widget */
	public function widget( $args, $instance ) {
		
		echo $args['before_widget'];
		do_action( 'display_wprequal_rates_body', $instance['state'] );
		echo $args['after_widget'];
	}
	
	/** @see WP_Widget::form */
	public function form( $instance ) {
		$state = ! empty( $instance['state'] ) ? $instance['state'] : __( 'Your state here', 'wprequal_rates' );
		?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'state' ) ); ?>"><?php _e( esc_attr( 'Select State:' ) ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'state' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'state' ) ); ?>" type="text">
				<option value="<?php echo esc_attr( $state ); ?>"><?php echo esc_attr( $state ); ?></option>
				<option value="AL">Alabama</option>
				<option value="AK">Alaska</option>
				<option value="AZ">Arizona</option>
				<option value="AR">Arkansas</option>
				<option value="CA">California</option>
				<option value="CO">Colorado</option>
				<option value="CT">Connecticut</option>
				<option value="DE">Delaware</option>
				<option value="FL">Florida</option>
				<option value="GA">Georgia</option>
				<option value="HI">Hawaii</option>
				<option value="ID">Idaho</option>
				<option value="IL">Illinois</option>
				<option value="IN">Indiana</option>
				<option value="IA">Iowa</option>
				<option value="KS">Kansas</option>
				<option value="KY">Kentucky</option>
				<option value="LA">Louisiana</option>
				<option value="ME">Maine</option>
				<option value="MD">Maryland</option>
				<option value="MA">Massachusetts</option>
				<option value="MI">Michigan</option>
				<option value="MN">Minnesota</option>
				<option value="MS">Mississippi</option>
				<option value="MO">Missouri</option>
				<option value="MT">Montana</option>
				<option value="NE">Nebraska</option>
				<option value="NV">Nevada</option>
				<option value="NH">New Hampshire</option>
				<option value="NJ">New Jersey</option>
				<option value="NM">New Mexico</option>
				<option value="NY">New York</option>
				<option value="NC">North Carolina</option>
				<option value="ND">North Dakota</option>
				<option value="OH">Ohio</option>
				<option value="OK">Oklahoma</option>
				<option value="OR">Oregon</option>
				<option value="PA">Pennsylvania</option>
				<option value="RI">Rhode Island</option>
				<option value="SC">South Carolina</option>
				<option value="SD">South Dakota</option>
				<option value="TN">Tennessee</option>
				<option value="TX">Texas</option>
				<option value="UT">Utah</option>
				<option value="VT">Vermont</option>
				<option value="VA">Virginia</option>
				<option value="WA">Washington</option>
				<option value="WV">West Virginia</option>
				<option value="WI">Wisconsin</option>
				<option value="WY">Wyoming</option>
			</select>
		</p>
		<?php 
	}
	
	/** @see WP_Widget::update */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['state'] = ( ! empty( $new_instance['state'] ) ) ? strip_tags( $new_instance['state'] ) : '';
	
		return $instance;
	}
}
?>