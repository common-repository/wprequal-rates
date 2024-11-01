<?
/*
Plugin Name: Mortgage Rates by WPrequal
Plugin URI:  https://wprequal.com
Description: Display basic mortgage rates in widget or with shortcode.
Version:     1.0.1
Author:      WPrequal
Author URI:  https://wprequal.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wprequal_rates

Mortgage Rates by WPrequal is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Mortgage Rates by WPrequal is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Mortgage Rates by WPrequal. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * WPrequal Rates Class
 *
 * @since 1.0
 */
 
class WPrequal_rates {
	
	/**
	 * API version.
	 *
	 * @since 1.0
	 * @var sting
	 */
	private $api_version = '1.0';
	
	/** constructor */
	public function __construct() {
		
		/**
		 * Validate WPrequal api key.
 		 */
		 
		add_action( 'init', array( $this, 'wprequal_rates_init' ) );
		
		/**
		 * Require WPrequal_Mortgage_Rates_Widget Class.
 		 */
		 
		require_once( plugin_dir_path( __FILE__ ) . 'widget.php' );
		
		/**
		 * Register WPrequal_Mortgage_Rates_Widget.
		 *
		 * @since 1.0
		 */
		 
		add_action( 'widgets_init', function(){
			register_widget( 'WPrequal_Mortgage_Rates_Widget' );
		});
		
		/**
		 * Enqueue Styles.
		 *
		 * @since 1.0
		 */
		 
		add_action( 'wp_enqueue_scripts', array( $this, 'wprequal_enqueue_scripts' ) );
		
		/**
		 * Rates Body Hook.
		 *
		 * Body can be called for widget or shortcode.
		 *
		 * @since 1.0
		 */
		 
		add_action( 'display_wprequal_rates_body', array( $this, 'wprequal_rates_body' ), 10, 1 );
		
		/**
		 * Rates Get Hook.
		 *
		 * Perform the api request to get the rates body.
		 *
		 * @since 1.0
		 */
		 
		add_filter( 'wprequal_rates_get', array( $this, 'wprequal_rates_get' ), 10, 2 );
		
		/**
		 * Rates Error.
		 *
		 * If api response is empty, display an error message.
		 *
		 * @since 1.0
		 */
		 
		add_action( 'wprequal_rates_error', array( $this, 'wprequal_rates_error' ) );
		
		/**
		 * Add Rates shortcode.
		 *
		 * Display Rates with a shortcode.
		 *
		 * @since 1.0
		 */
		 
		add_shortcode( 'wprequal_rates', array( $this, 'wprequal_rates_shortcode' ) );
		
	}
	
	/**
	 * Enqueue Styles.
	 *
	 * @since 1.0
	 */
	 
	public function wprequal_enqueue_scripts() {
		wp_enqueue_style( 'wprequal_rates_css', plugin_dir_url( __FILE__ ) . 'css/style.css' );
	}
	
	/**
	 * Get and Recieve data.
	 *
	 * Get and Recieve data from WPrequal api.
	 *
	 * @since 1.0
	 *
	 * @param string $string Get string request for WPrequal api.
	 */
	 
	public static function wprequal_rates_get( $api, $string = '' ) {
		$token = get_option( 'wprequal_token_code' );
		$url = 'https://api.wprequal.com/' . $this->api_version . '/' . $api . '/?' . $string . '&key=' . $token;
		return wp_remote_retrieve_body( wp_remote_get( $url ) );
	}
	
	/**
	 * Error Message.
	 *
	 * Display error message if data not received from WPreQal api.
	 *
	 * @since 1.0
	 */
	 
	public static function wprequal_rates_error() {
		?>
		<div class="wprequal_red">
			An error has occured. Please refresh your browser. If this issue persists. Please contact the website administrator.
		</div>
		<?
	}
	
	/**
	 * Mortgage Rates body.
	 *
	 * @since 1.0
	 *
	 * @param string $state State for the rates displayed.
	 */
	 
	public function wprequal_rates_body( $state ) {
		
		$transient = 'wprequal_rates_body_'. $state;
		/** If wprequal rates body is saved and not expired echo the saved copy */
		if ( $wprequal_body = get_transient( $transient ) ) {
			echo $wprequal_body;
			return;
		}
		
		ob_start();
		?>
		<div class="wprequal_rates" id="wprequal_rates">
			<h2 class="wprequal_rates_header">Mortgage Rates</h2>
			<div class="wprequal_rates_wrap">
				<? $response = json_decode( apply_filters( 'wprequal_rates_get', 'rates', 'state=' . $state ) );
				if ( ! empty ( $response ) ) echo $response;
				else do_action( 'wprequal_rates_error' ); ?>
			</div>
		</div>
		<?
		$obj = ob_get_clean();
		
		/** If no $response error save wprequal body for 1 hour */
		if ( ! empty ( $response ) )
			set_transient( $transient, $obj, 1 * HOUR_IN_SECONDS );
			
		echo $obj;
	}
	
	/**
	 * Mortgage Rates shortcode.
	 *
	 * Display WPrequal Mortgage Rates with a shortcode.
	 *
	 * @param array $atts Attributes defined in shortcode.
	 *
	 * @since 1.0
	 */
	
	public static function wprequal_rates_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'state' => 'AZ',
		), $atts, 'wprequal_rates' );
		/** Display WPrequal Mortgage Rates */
		ob_start(); 
		?>
		<div class="wprequal_short_wrap">
			<?
			do_action( 'display_wprequal_rates_body', $atts['state'] );
			?>
		</div>
		<? 
		return ob_get_clean();
	}
	
	/**
	 * Valudate API Key exsists.
	 *
	 * Get API from WPrequal API key if does not exsist.
	 *
	 * @since 1.0
	 */
	 
	public function wprequal_rates_init() {
		if ( ! get_option( 'wprequal_token_code' ) ) {
			$new_token = apply_filters( 
				'wprequal_rates_get', 
				'activate', 
				'wprequal_activate=true&wprequal_url=' . urlencode( get_site_url() ) 
			);
			update_option( 'wprequal_token_code', sanitize_text_field( $new_token ) );
		}
	}

}

new WPrequal_rates();
?>