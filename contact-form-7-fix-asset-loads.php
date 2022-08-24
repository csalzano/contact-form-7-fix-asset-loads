<?php
defined( 'ABSPATH' ) or exit;

/**
 * Plugin Name: Contact Form 7 - Fix Asset Loads
 * Description: Only loads JavaScript and CSS on pages where forms appear
 * Plugin URI: https://breakfastco.xyz
 * Author: Corey Salzano
 * Author URI: https://github.com/csalzano
 */

class CF7_Fix_Asset_Loads
{	
	/**
	 * cf7_form_was_loaded
	 * 
	 * Track whether a form was loaded
	 *
	 * @var bool
	 */
	var $cf7_form_was_loaded = false;
	
	/**
	 * add_hooks
	 *
	 * @return void
	 */
	public function add_hooks()
	{
		//Change the Contact Form 7 styles to load in the footer
		add_action( 'wp_enqueue_scripts', array( $this, 'move_style_loads_to_footer' ), 11 );

		//Listen for a form load
		add_filter( 'wpcf7_form_action_url', array( $this, 'track_form_load' ) );
	}
	
	/**
	 * maybe_enqueue
	 * 
	 * This callback method on the `wp_footer` hook checks our member variable
	 * to see if a form has been loaded. If not, the script is dequeued. If a 
	 * form has been loaded, the styles are are enqueued.
	 * 
	 * Contact Form 7 scripts already load in the footer.
	 *
	 * @return void
	 */
	public function maybe_enqueue()
	{
		//Was a form loaded? 
		if( ! $this->cf7_form_was_loaded )
		{
			//No, do not enqueue styles and dequeue the scripts
			wp_dequeue_script( 'contact-form-7' );
			return;
		}

		wp_enqueue_style( 'contact-form-7' );
		if ( function_exists( 'wpcf7_is_rtl' ) && wpcf7_is_rtl() ) {
			wp_enqueue_style( 'contact-form-7-rtl' );
		}
		if ( ! wpcf7_support_html5_fallback() ) {
			wp_enqueue_style( 'jquery-ui-smoothness' );
		}
	}
	
	/**
	 * move_style_loads_to_footer
	 * 
	 * This callback method on the `wp_enqueue_scripts` hook dequeues all
	 * stylesheets and adds an action hook so they can be requeued later in the
	 * footer.
	 * 
	 * Contact Form 7 scripts already load in the footer, so only the styles
	 * need to be moved.
	 *
	 * @return void
	 */
	public function move_style_loads_to_footer()
	{
		wp_dequeue_style( 'contact-form-7' );
		wp_dequeue_style( 'contact-form-7-rtl' );
		wp_dequeue_style( 'jquery-ui-smoothness' );
		add_action( 'wp_footer', array( $this, 'maybe_enqueue' ) );
	}
	
	/**
	 * track_form_load
	 * 
	 * This callback method on the `wpcf7_form_action_url` does not edit the
	 * form action URL. It sets our member variable to indicate a form has been
	 * loaded and returns the URL unchanged.
	 *
	 * @param  string $url
	 * @return string
	 */
	public function track_form_load( $url )
	{
		$this->cf7_form_was_loaded = true;
		return $url;
	}
}
$cf7_fix_asset_loads_29034234 = new CF7_Fix_Asset_Loads();
$cf7_fix_asset_loads_29034234->add_hooks();
