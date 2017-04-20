=== Press Elements - Widgets for Elementor ===
Contributors: ramiy
Tags: elementor, press elements, elements, widgets, page builder
Requires at least: 4.7
Tested up to: 4.7
Stable tag: 1.5.0
License: GPLv3
License URI: https://opensource.org/licenses/GPL-3.0

Easy-to-use widgets that help you display and design your content using Elementor page builder.

== Description ==

**Press Elements** combines the simplicity of [Elementor](https://wordpress.org/plugins/elementor/) with the efficiency of the built-in WordPress theme components.

= WordPress Elements =

When you create a new post (or a page) on WordPress, you choose a title, write an excerpt, select a publish date, add an author, choose featured image, select several taxonomies and maybe you define some custom fields.

In the Elementor page builder you can't display and style those components. You need to repeat the process and manually add a title, write the excerpt and add images.

That's where Press Elements comes in handy. The plugin adds smart widgets that let you display those post components. Now you can drag a "Post Title" widget and style it your way. The widget will automatically insert the title used as the post title. Same applies for all the other post components.

= Dynamic Content =

Regular Elementor widgets save the data as hard-coded content in the database. To change something you need to open the page builder and manually change the element inside the builder. Updating post titles, excerpts, authors and other WordPress Element won't affect the builder.

Press Elements uses dynamic content architecture. It doesn't save the title and other element as hard-coded content. It generates them on-the-fly. Just like the WordPress theme system.

When you change post titles and other post elements from your WordPress dashboard (outside of Elementor), they will be automatically updated in the content area and in the page builder.

For example, you can bulk edit several posts from your sites dashboard to change the author, post that use "Post Author" widget will be automatically updates with the new data.

= Template Design =

When using page builders, you need to create all the page element for each page over and over again. Currently you can't design single page templates and apply the design on the post. When you use the template system you need to manually change titles and images for each post/page.

With Press Elements you can create custom designs with post elements and save them as template. When you apply the template on other posts, it will inherite the data from the new post. No more manual updates!

You don't need to hire developers to generate custom page templates - with Press Elements you can do it using a simple drag & drop interface! Now you can design different templates for different blog posts, pages and other Post Types. When creating new posts, load your predefined templates from your template library.

With Press Elements you can use Elementor widgets to display and design your post elements! Just like developers use theme-functions to generate themes. How cool is that?!

https://www.youtube.com/watch?v=yGzefuK7ngs

= Included Widgets =

Press Elements comes with 16 useful Elementor widgets, 10 of them are free of charge!

Site Elements:

- **Site Title** - The name of the site (set in Settings > General).
- **Site Description** - The tagline (set in Settings > General).
- **Site Logo** - Custom site logo (set in the Customizer).
- **Site Counters** - General site stats for Post Types, Taxonomies, Comments and Users.

Post Elements:

- **Post Title** - The title of the post.
- **Post Excerpt** - A short description.
- **Post Date** - Publish date or last modified date.
- **Post Author** - The post author information.
- **Post Terms** - The taxonomies assigned to the post.
- **Post Featured Image (Pro)** - An image assigned to the post.
- **Post Custom Field (Pro)** - Extra information saved as WordPress meta-data.
- **Post Comments** -  The default Comments Template included in the theme.

Integrations:

- **Advanced Custom Fields (Pro)** - Fields added by [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/) plugin.
- **Gravatar (Pro)** - Display single [Gravatars](https://gravatar.com/) based on an email address.
- **Flickr (Pro)** - Display Flickr photostream based on Flickr User ID.
- **Pinterest (Pro)** - Display Pinterest pins based on Pinterest username.

= Coming Soon =

Site Elements:

- **Search Form**
- **Login Form**

Comments Elements:

- **Comments Form**
- **Comments List**
- **Comments Pagination**

Integrations:

- **Flickr (Pro)**
- **Pinterest (Pro)**

== Screenshots ==
1. Post edit screen with WordPress elements.
2. Elementor widgets for each site and post element.
3. Styling post title with a dedicated Elementor widget.
4. Display post custom fields.
5. Create your own author bio section.
6. Widgets for your site logo, site name and site description.
7. Site counters for Post Types, Taxonomies, Comments and Users.
8. Custom fields as text fields and images, and linking to other custom fields.
9. Display Gravatars based on an email address.
10. Display Flickr photostream based on Flickr User ID.
11. Display Pinterest pins based on Pinterest username.

== Frequently Asked Questions ==

= Is Press Elements compatible with any Theme? =

It sure is! Press Elements uses standard theme functions. That plugin will work on any WordPress theme!

= Is Press Elements compatible with Custom Post Types? =

Yes. It works on any post type as long as it supports the relevant post element.

= Can I use Press Elements to design archive pages? =

Currently the plugin displays post elements on "single" pages. But in the future, it will support "archive" page too.

= I am a theme developer, how can it help me? =

As a theme developer you probably use theme-functions in your workflow. Press Elements turns those functions to widgets. Replacing code with a visual builder to reduce your development time.

= Can I optimize the source code for SEO? =

Yes you can! Each element has an "HTML Tag" field, which is used as a container tag. This way you can optimize your template design source code the way you want. You are no longer dependent on theme authors for Search Engine Optimization in your source code.

= Does the plugin has minimum requirements? =

**Minimum Requirements**

* WordPress version 4.7 or greater.
* Elementor version 1.3.4 or greater.
* PHP version 5.4 or greater.
* MySQL version 5.0 or greater.

**Recommended Requirements**

* The latest WordPress version.
* The latest Elementor version.
* PHP version 7.0 or greater.
* MySQL version 5.6 or greater.

= Where can I suggest new features? =

You can suggest new features on our [wp.org support forum](https://wordpress.org/support/plugin/press-elements).

= Can I customize the author data? =

Yes you can. The "Post Author" widgets allows you to display author first name, last name, username, user bio, user image and other user data.

= How do I use the custom field widgets? =

When using WordPress based custom fields, the data is saved as text based fields. With 3rd party plugins, each plugin saves the data in it's own format (text, array, object). It's impossible to provide solutions for each and every plugin data structure.

That's why Press Elements has two widgets to display custom fields. The "Post Custom Field" widget is used to display WordPress based custom fields, and the "Advanced Custom Fields" widget is used to display ACF custom fields.

Both widgets can display custom fields as "Text" or as "Images". Each display type reveals it's own advances options in the styling tab. You can also link the fields to URL stored in other custom fields.

For more advanced uses, please contact us in our [wp.org support forum](https://wordpress.org/support/plugin/press-elements). The plugin is developed based on user feedback.

== Changelog ==

= 1.5.0 =

**General**

* Move "Press Elements" menu from "Appearance" to "Settings".
* Fix the issue with single quotes characters in "Post Title" and "Post Excerpt" widgets.
* Escape the URL returned by the "Link to" controller in all the widgets.
* Add warnings in widgets that dependent on external plugins like ACF.
* Enhance "Advanced Custom Fields" widget to display fields saved as arrays.

**New Widgets**

* Flickr (Pro)
* Pinterest (Pro)

= 1.4.0 =

**General**

* Fix "Site Counters" post types display and taxonomy total count.
* Update "Custom Field" widget with display condition to the image angle controller.
* Enhance "Post Author" widget "Style" tab. Different design controllers for author images and other author data.
* Upgrade Minimum Requirements to PHP 5.4 - like Elementor.

**New Widgets**

* Advanced Custom Fields (Pro)
* Gravatar (Pro)

= 1.3.1 =

**General**

* Fix images rotation angle controller to allow 360deg image rotation.
* Fix "Post Terms" to display only the post-terms not all the terms.

= 1.3.0 =

**General**

* Remove redundant hidden control in "Site Title" and "Site Description" widgets.
* Enhance "Post Custom Field" widget with links to other custom fields.
* Enhance "Post Custom Field" widget with "Display as" as control to display as simple text or an image.
* Enhance "Post Custom Field" widget "Style" tab. Different fields for simple text values and images.
* Enhance "Site Logo", "Post Featured Image" and "Post Custom Field" with an image rotation feature.

= 1.2.2 =

**General**

* Bug fix - When adding new widgets the design is not applied because of undefined hover animation.

= 1.2.1 =

**General**

* Add an admin menu linking to the plugin support forum.
* Bug fix - display plugin admin even if Elementor is not active.

= 1.2.0 =

**General**

* Add Hover Animation field to all the widgets.
* Enhance the "Post Date" with new select field to choose either "Publish Date" or "Last Modified Date".
* Remove redundant hidden control in Post Title, Excerpt and Date widgets.
* Fix reload glitch on "Post Author" widget.
* Upgrade Minimum Requirements to WordPress 4.7 for the site logo feature.

**New Widgets**

* Site Logo
* Site Counters

= 1.1.2 =

**General**

* Fix Freemius opt-in issue.
* Upgrade Minimum Requirements to PHP 5.3.
* Merge similar translation strings.

= 1.1.1 =

**General**

* Fix Freemius "first-path" parameter on plugin activation.
* Update translators comments for string placeholders.

= 1.1.0 =

**General**

* Add admin notices for missing parent plugin and minimum required Elementor version.
* Move Freemius init functions to a separate file.
* Upgrade Freemius SDK to version 1.2.1.6.1
* Fix animations in "Post Featured Image" widget.
* Extend the link field for all widgets.

**New Widgets**

* Post Terms
* Post Comments

= 1.0.0 =

**General**

* Initial release.

**New Widgets**

* Site Title
* Site Description
* Post Title
* Post Excerpt
* Post Date
* Post Author
* Post Featured Image (Pro)
* Post Custom Field (Pro)
