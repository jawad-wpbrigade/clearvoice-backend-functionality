<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class ClearVoiceElementorWidgets {
    
	/**
	 * Set the instance.
	 */
	private static $_instance = null;

    public function __construct() {
        add_action( 'elementor/elements/categories_registered', [ $this, 'create_new_category' ] );
        add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
    }

	/**
	 * Start Registering Widgets
	 */
    public function init_widgets( $widgets_manager ) {
		require_once( __DIR__ . '/widgets/clearvoice_custom_posts_freelancer.php' );

        // Register widget with elementor.
        $widgets_manager->register( new Clearvoice_Custom_Posts_Freelancer() );


    }

    public static function get_instance() {

        if ( null == self::$_instance ) {
            self::$_instance = new Self();
        }

        return self::$_instance;

    }

	/**
	 * Create new category and show it on top of all categories in elementor.
	 */
	public function create_new_category( $elements_manager ) {

		$clv_categories = array();
		$clv_categories['clearvoice'] = array(
			'title' => __( 'ClearVoice', 'ClearVoice-backend-functionality' ),
			'icon'  => 'fa fa-plug',
		);
		// Get our category to the top.
		$old_categories = $elements_manager->get_categories();
		$clv_categories = array_merge( $clv_categories, $old_categories );
		$set_categories = function ( $clv_categories ) {
			$this->categories = $clv_categories;
		};

		$set_categories->call( $elements_manager, $clv_categories );
    }

}

ClearVoiceElementorWidgets::get_instance();
