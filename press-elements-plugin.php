<?php
namespace PressElements;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {

		// Add New Elementor Categories
		add_action( 'elementor/init', [ $this, 'add_elementor_category' ] );

		// Register Widget Scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_widget_scripts' ] );

		// Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'register_widget_styles' ] );

		// Register New Widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );

	}

	/**
	 * Add Elementor Categories
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function add_elementor_category() {

		\Elementor\Plugin::instance()->elements_manager->add_category(
			'press-elements-site-elements',
			[ 'title' => __( 'Site Elements', 'press-elements' ) ],
			1
		);
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'press-elements-post-elements',
			[ 'title' => __( 'Post Elements', 'press-elements' ) ],
			2
		);
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'press-elements-effects',
			[ 'title' => __( 'Press Elements Pro Effects', 'press-elements' ) ],
			3
		);
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'press-elements-integrations',
			[ 'title' => __( 'Press Elements Pro Integrations', 'press-elements' ) ],
			4
		);

	}

	/**
	 * Register Widget Scripts
	 *
	 * @since 1.6.0
	 *
	 * @access public
	 */
	public function register_widget_scripts() {

		if ( press_elements_freemius()->is__premium_only() ) {

			// Before After Effect
			wp_register_script( 'eventmove', plugins_url( 'libs/twentytwenty/jquery.event.move.js', __FILE__ ), array( 'jquery' ) );
			wp_register_script( 'twentytwenty', plugins_url( 'libs/twentytwenty/jquery.twentytwenty.js', __FILE__ ), array( 'eventmove' ) );
			wp_register_script( 'before-after-effect', plugins_url( 'assets/js/before-after-effect.js', __FILE__ ), array( 'twentytwenty' ) );

		}

	}

	/**
	 * Register Widget Styles
	 *
	 * @since 1.7.0
	 *
	 * @access public
	 */
	public function register_widget_styles() {

		if ( press_elements_freemius()->is__premium_only() ) {

			// Image Accordion
			wp_register_style( 'image-accordion', plugins_url( 'press-elements/assets/css/image-accordion.css' ) );
			wp_enqueue_style( 'image-accordion' );

			// Before After Effect
			wp_register_style( 'before-after-effect', plugins_url( 'press-elements/assets/css/before-after-effect.css' ) );
			wp_enqueue_style( 'before-after-effect' );

			// Notes
			wp_register_style( 'notes', plugins_url( 'press-elements/assets/css/notes.css' ) );
			wp_enqueue_style( 'notes' );

		}

	}

	/**
	 * Register New Widgets
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {

		$this->includes();
		$this->register_widgets();

	}

	/**
	 * Include Widgets Files
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {

		// Site Elements
		require_once( __DIR__ . '/widgets/site-title.php' );
		require_once( __DIR__ . '/widgets/site-description.php' );
		require_once( __DIR__ . '/widgets/site-logo.php' );
		require_once( __DIR__ . '/widgets/site-counters.php' );

		// Post Elements
		require_once( __DIR__ . '/widgets/post-title.php' );
		require_once( __DIR__ . '/widgets/post-excerpt.php' );
		require_once( __DIR__ . '/widgets/post-date.php' );
		require_once( __DIR__ . '/widgets/post-author.php' );
		require_once( __DIR__ . '/widgets/post-terms.php' );
		require_once( __DIR__ . '/widgets/post-featured-image.php' );
		require_once( __DIR__ . '/widgets/post-custom-field.php' );
		require_once( __DIR__ . '/widgets/post-comments.php' );

		// Effects
		require_once( __DIR__ . '/widgets/image-accordion.php' );
		require_once( __DIR__ . '/widgets/before-after-effect.php' );
		require_once( __DIR__ . '/widgets/notes.php' );

		// Integrations
		require_once( __DIR__ . '/widgets/advanced-custom-fields.php' );
		require_once( __DIR__ . '/widgets/gravatar.php' );
		require_once( __DIR__ . '/widgets/flickr.php' );
		require_once( __DIR__ . '/widgets/pinterest.php' );

	}

	/**
	 * Register Widgets
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widgets() {

		// Site Elements
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Site_Title() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Site_Description() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Site_Logo() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Site_Counters() );

		// Post Elements
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Post_Title() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Post_Excerpt() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Post_Date() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Post_Author() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Post_Terms() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Post_Featured_Image() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Post_Custom_Field() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Post_Comments() );

		// Effects
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Image_Accordion() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Before_After_Effect() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Notes() );

		// Integrations
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Advanced_Custom_Fields() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Gravatar() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Flickr() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \PressElements\Widgets\Press_Elements_Pinterest() );

	}

}
