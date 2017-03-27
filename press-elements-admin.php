<?php
namespace PressElements;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Admin Page Class
 *
 * Register menu and generate admin pages
 *
 * @since 1.0.0
 */
class Press_Elements_Admin {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'register_menus' ) );

	}

	/**
	 * Register Admin Menus
	 *
	 * Register the Dashboard Pages which are later hidden but these pages
	 * are used to render the Welcome and Credits pages.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function register_menus() {

		/**
		 * User capability to display Press Elements menu.
		 *
		 * Allows developers to filter the required capability to display the settings page.
		 *
		 * @since 1.0.0
		 */
		$capability = apply_filters( 'press_elements_menu_display_capability', 'manage_options' );

		// About
		add_theme_page(
			esc_html__( 'Press Elements for Elementor', 'press-elements' ),
			esc_html__( 'Press Elements', 'press-elements' ),
			$capability,
			'press-elements',
			array( $this, 'page_layout' )
		);

	}

	/**
	 * Navigation tabs
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function tabs() {
		$tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'about';
		?>
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php echo ( 'about'           === $tab ) ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'press-elements', 'tab' => 'about'           ), 'themes.php' ) ) ); ?>"><?php esc_html_e( 'About',           'press-elements' ); ?></a>
			<a class="nav-tab <?php echo ( 'getting-started' === $tab ) ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'press-elements', 'tab' => 'getting-started' ), 'themes.php' ) ) ); ?>"><?php esc_html_e( 'Getting Started', 'press-elements' ); ?></a>
			<a class="nav-tab <?php echo ( 'changelog'       === $tab ) ? 'nav-tab-active' : ''; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'press-elements', 'tab' => 'changelog'       ), 'themes.php' ) ) ); ?>"><?php esc_html_e( 'Changelog',       'press-elements' ); ?></a>
			<a class="nav-tab" href="<?php echo press_elements_freemius()->get_upgrade_url(); ?>"><?php esc_html_e( 'Pro Version', 'press-elements' ); ?></a>
		</h2>
		<?php
	}

	/**
	 * Render Page Layout
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function page_layout() {
		$tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'about';

		switch ( $tab ) {
			case 'changelog':
				$this->changelog_screen();
				break;
			case 'getting-started':
				$this->getting_started_screen();
				break;
			case 'about':
			default:
				$this->about_screen();
				break;
		}
	}

	/**
	 * About Screen
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function about_screen() {
		?>
		<div class="wrap about-wrap">

			<h1><?php esc_html_e( 'Press Elements for Elementor', 'press-elements' ); ?></h1>

			<p class="about-text"><?php esc_html_e( 'An easy-to-use Elementor widgets that helps you design single page templates to display your content.', 'press-elements' );?></p>

			<?php $this->tabs(); ?>

			<p class="about-text"><?php esc_html_e( 'Press Elements lets you style a single page with all the site and post elements, and display them within your favorite page builder!', 'press-elements' ); ?></p>

			<div class="feature-section two-col">

				<div class="col">

					<h3><?php esc_html_e( 'Template Design', 'press-elements' ); ?></h3>

					<p class="about-text"><?php esc_html_e( 'When using page builders, you need to create all the page element for each page over and over again. Currently you can\'t design single page templates and use the built in post data like the post title, excerpts, date and others.', 'press-elements' ); ?></p>

					<p class="about-text"><?php esc_html_e( 'Press Elements allows you to design different templates in minutes! You don\'t need to hire developers to generate custom page templates - with Press Elements you can do it using a simple drag & drop interface!', 'press-elements' ); ?></p>

					<p class="about-text"><?php esc_html_e( 'Design different templates for different blog posts, pages and other Post Types. When creating new posts, load your predefined templates from your template library.', 'press-elements' ); ?></p>

					<p class="about-text"><?php esc_html_e( 'Developers use theme-functions to generate themes. With Press Elements you can use Elementor widgets to display and design your post elements! How cool is that?!', 'press-elements' ); ?></p>

					<h3><?php esc_html_e( 'Included Widgets', 'press-elements' ); ?></h3>

					<p><?php esc_html_e( 'Site Elements:', 'press-elements' ); ?></p>
					<ol>
						<li><?php esc_html_e( 'Site Title', 'press-elements' ); ?></li>
						<li><?php esc_html_e( 'Site Description', 'press-elements' ); ?></li>
						<li><?php esc_html_e( 'Site Logo', 'press-elements' ); ?></li>
						<li><?php esc_html_e( 'Site Counters', 'press-elements' ); ?></li>
					</ol>
					<p><?php esc_html_e( 'Post Elements:', 'press-elements' ); ?></p>
					<ol>
						<li><?php esc_html_e( 'Post Title', 'press-elements' ); ?></li>
						<li><?php esc_html_e( 'Post Excerpt', 'press-elements' ); ?></li>
						<li><?php esc_html_e( 'Post Date', 'press-elements' ); ?></li>
						<li><?php esc_html_e( 'Post Author', 'press-elements' ); ?></li>
						<li><?php esc_html_e( 'Post Terms', 'press-elements' ); ?></li>
						<li><?php esc_html_e( 'Post Featured Image (Pro)', 'press-elements' ); ?></li>
						<li><?php esc_html_e( 'Post Custom Fields (Pro)', 'press-elements' ); ?></li>
						<li><?php esc_html_e( 'Post Comments', 'press-elements' ); ?></li>
					</ol>

					<h3><?php esc_html_e( 'Dynamic Content', 'press-elements' ); ?></h3>

					<p class="about-text"><?php esc_html_e( 'Regular Elementor widgets save the data as hard-coded content (text, images and other element). To change something you need to open the page builder and manualy change it inside the builder. Updating titles, expects, authors and other WordPress Element won\'t affect the builder.', 'press-elements' ); ?></p>

					<p class="about-text"><?php esc_html_e( 'Press Elements uses dynamic content architecture. It doesn\'t save the title and other element as hard-coded content it generates them on-the-fly, just like the WordPress theme system.', 'press-elements' ); ?></p>

					<p class="about-text"><?php esc_html_e( 'When you change titles, exerpts, feature-images, custom-fields and other elements from your WourdPress dashboard (outside of Elementor), they will be automatically updated in the content area and in the page builder.', 'press-elements' ); ?></p>

				</div>

				<div class="col">

					<figure>
						<a href="<?php echo esc_url( plugins_url( 'screenshot-1.png', __FILE__ ) ); ?>" target="_blank">
							<img src="<?php echo esc_url( plugins_url( 'screenshot-1.png', __FILE__ ) ); ?>" alt="<?php esc_attr_e( 'Post edit screen with WordPress elements.', 'press-elements' ); ?>">
						</a>
						<figcaption><?php esc_html_e( 'Post edit screen with WordPress elements.', 'press-elements' ); ?></figcaption>
					</figure>

					<br>

					<figure>
						<a href="<?php echo esc_url( plugins_url( 'screenshot-2.png', __FILE__ ) ); ?>" target="_blank">
							<img src="<?php echo esc_url( plugins_url( 'screenshot-2.png', __FILE__ ) ); ?>" alt="<?php esc_attr_e( 'Elementor widgets for each site and post element.', 'press-elements' ); ?>">
						</a>
						<figcaption><?php esc_html_e( 'Elementor widgets for each site and post element.', 'press-elements' ); ?></figcaption>
					</figure>

					<br>

					<figure>
						<a href="<?php echo esc_url( plugins_url( 'screenshot-3.png', __FILE__ ) ); ?>" target="_blank">
							<img src="<?php echo esc_url( plugins_url( 'screenshot-3.png', __FILE__ ) ); ?>" alt="<?php esc_attr_e( 'Styling post title with a dedicated elementor widget.', 'press-elements' ); ?>">
						</a>
						<figcaption><?php esc_html_e( 'Styling post title with a dedicated elementor widget.', 'press-elements' ); ?></figcaption>
					</figure>

					<br>

					<figure>
						<a href="<?php echo esc_url( plugins_url( 'screenshot-4.png', __FILE__ ) ); ?>" target="_blank">
							<img src="<?php echo esc_url( plugins_url( 'screenshot-4.png', __FILE__ ) ); ?>" alt="<?php esc_attr_e( 'Display post custom fields.', 'press-elements' ); ?>">
						</a>
						<figcaption><?php esc_html_e( 'Display post custom fields.', 'press-elements' ); ?></figcaption>
					</figure>

					<br>

					<figure>
						<a href="<?php echo esc_url( plugins_url( 'screenshot-5.png', __FILE__ ) ); ?>" target="_blank">
							<img src="<?php echo esc_url( plugins_url( 'screenshot-5.png', __FILE__ ) ); ?>" alt="<?php esc_attr_e( 'Create your own author bio section.', 'press-elements' ); ?>">
						</a>
						<figcaption><?php esc_html_e( 'Create your own author bio section.', 'press-elements' ); ?></figcaption>
					</figure>

					<br>

					<figure>
						<a href="<?php echo esc_url( plugins_url( 'screenshot-6.png', __FILE__ ) ); ?>" target="_blank">
							<img src="<?php echo esc_url( plugins_url( 'screenshot-6.png', __FILE__ ) ); ?>" alt="<?php esc_attr_e( 'Widgets for your site logo, site name and site description.', 'press-elements' ); ?>">
						</a>
						<figcaption><?php esc_html_e( 'Widgets for your site logo, site name and site description.', 'press-elements' ); ?></figcaption>
					</figure>

				</div>

			</div>

		</div>
		<?php
	}

	/**
	 * Getting Started Screen
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function getting_started_screen() {
		?>
		<div class="wrap about-wrap get-started">

			<h1><?php esc_html_e( 'Getting Started', 'press-elements' ); ?></h1>

			<p class="about-text"><?php esc_html_e( 'Welcome to Press Elements getting started guide.', 'press-elements' ); ?></p>

			<?php $this->tabs(); ?>

			<p class="about-text"><?php esc_html_e( 'Getting started with Press Elements is easy! We put together this quick start guide to help first time users of the plugin. Our goal is to get you up and running in no time. Let\'s begin!', 'press-elements' ); ?></p>

			<div class="feature-section">

				<div class="col">

					<h3><?php esc_html_e( 'STEP 1: Create a new post', 'press-elements' ); ?></h3>

					<p class="about-text"><?php esc_html_e( 'Navigate to "Posts > Add New" to create a new post. Enter a post title, write an excerpt, select a featured image, set an author, select a publish date and publish the post.', 'press-elements' ); ?></p>

				</div>

			</div>

			<div class="feature-section">

				<div class="col">

					<h3><?php esc_html_e( 'STEP 2: Design your own template', 'press-elements' ); ?></h3>

					<p class="about-text"><?php esc_html_e( 'Click the "Edit with Elementor" button and start designing the page layout. Design a page header, footer, and the content area.', 'press-elements' ); ?></p>

					<p class="about-text"><?php esc_html_e( 'Use "Press Elements" widgets to display the post title, post excerpt, post date and the other fields used by WordPress. Don\'t forget to style those elements!', 'press-elements' ); ?></p>

				</div>

			</div>

			<div class="feature-section">

				<div class="col">

					<h3><?php esc_html_e( 'STEP 3: Save the template', 'press-elements' ); ?></h3>

					<p class="about-text"><?php esc_html_e( 'Click on the "Add Template" button located at the bottom, and save the design. You will see the newly created template at the "My Templates" tab.', 'press-elements' ); ?></p>

					<p class="about-text"><?php esc_html_e( 'You can save several templates for blogs posts, pages, and other post types. Or even several templates for a particular post type.', 'press-elements' ); ?></p>

				</div>

			</div>

			<div class="feature-section">

				<div class="col">

					<h3><?php esc_html_e( 'STEP 4: Apply the design to new posts', 'press-elements' ); ?></h3>

					<p class="about-text"><?php esc_html_e( 'For each new post you create, load the desired template and apply it to the post. The post will enherite the design but the elements will be updated with the current post data.', 'press-elements' ); ?></p>

				</div>

			</div>

		</div>
		<?php
	}

	/**
	 * Changelog Screen
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function changelog_screen() {
		?>
		<div class="wrap about-wrap">

			<h1><?php esc_html_e( 'Changelog', 'press-elements' ); ?></h1>

			<p class="about-text"><?php esc_html_e( 'Press Elements changelog.', 'press-elements' ); ?></p>

			<?php $this->tabs(); ?>

			<p class="about-text"><?php esc_html_e( 'The Press Elements plugin is developed continuasly, this is the full changelog.', 'press-elements' ); ?></p>

			<?php echo $this->parse_readme(); ?>

		</div>
		<?php
	}

	/**
	 * Parse the readme.txt file
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string $readme HTML formatted readme file
	 */
	public function parse_readme() {
		$file = file_exists( plugin_dir_path( __FILE__ ) . '/readme.txt' ) ? plugin_dir_path( __FILE__ ) . '/readme.txt' : null;

		if ( ! $file ) {
			$readme = '<p>' . esc_html__( 'No valid changelog was found.', 'press-elements' ) . '</p>';
		} else {
			$readme = file_get_contents( $file );
			$readme = nl2br( esc_html( $readme ) );
			$readme = explode( '== Changelog ==', $readme );
			$readme = end( $readme );

			$readme = preg_replace( '/`(.*?)`/', '<code>\\1</code>', $readme );
			$readme = preg_replace( '/\*\*(.*?)\*\*/', '<strong>\\1</strong>', $readme );
			$readme = preg_replace( '/\*(.*?)\*/', ' <em>\\1</em>', $readme );
			$readme = preg_replace( '/= (.*?) =/', '<h3>\\1</h3>', $readme );
			$readme = preg_replace( '/\[(.*?)\]\((.*?)\)/', '<a href="\\2">\\1</a>', $readme );
		}

		return $readme;
	}

}

new Press_Elements_Admin();
