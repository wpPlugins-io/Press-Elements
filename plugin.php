<?php
namespace PressElements;

use PressElements\Widgets\Press_Elements_Site_Title;
use PressElements\Widgets\Press_Elements_Site_Description;
use PressElements\Widgets\Press_Elements_Post_Title;
use PressElements\Widgets\Press_Elements_Post_Excerpt;
use PressElements\Widgets\Press_Elements_Post_Author;
use PressElements\Widgets\Press_Elements_Post_Date;
use PressElements\Widgets\Press_Elements_Post_Featured_Image;
use PressElements\Widgets\Press_Elements_Post_Custom_Field;



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
class Press_Elements_Plugin {

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
		add_action( 'elementor/init', array( $this, 'add_elementor_category' ) );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
	}

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function add_elementor_category(){
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'press-elements-site-elements',
			[
				'title' => __( 'Site Elements', 'press-elements' ),
				'icon'  => 'font'
			],
			1
		);
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'press-elements-post-elements',
			[
				'title' => __( 'Post Elements', 'press-elements' ),
				'icon'  => 'font'
			],
			1
		);
	}

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		// Site Elements
		require_once __DIR__ . '/widgets/site-title.php';
		require_once __DIR__ . '/widgets/site-description.php';
		// Post Elements
		require_once __DIR__ . '/widgets/post-title.php';
		require_once __DIR__ . '/widgets/post-excerpt.php';
		require_once __DIR__ . '/widgets/post-date.php';
		require_once __DIR__ . '/widgets/post-author.php';
		require_once __DIR__ . '/widgets/post-featured-image.php';
		require_once __DIR__ . '/widgets/post-custom-field.php';
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {
		// Site Elements
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Press_Elements_Site_Title() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Press_Elements_Site_Description() );
		// Post Elements
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Press_Elements_Post_Title() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Press_Elements_Post_Excerpt() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Press_Elements_Post_Date() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Press_Elements_Post_Author() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Press_Elements_Post_Featured_Image() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Press_Elements_Post_Custom_Field() );
	}

}

new Press_Elements_Plugin();
