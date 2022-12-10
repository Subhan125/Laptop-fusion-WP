<?php  
/**
 *
 * functions.php
 *
 */

/*----------  1.0 DEFINE CONSTANT  ----------*/
	define( 'THEMEROOT', get_stylesheet_directory_uri() );
	define( 'STYLES',  THEMEROOT . '/assets/css' );
	define( 'SCRIPTS',  THEMEROOT . '/assets/js' );
	define( 'IMAGES',  THEMEROOT . '/assets/images' );

/*----------  2.0 LOAD THE CUSTOM STYLES AND SCRIPTS  ----------*/
	if ( ! function_exists( 'laptopfusion_scripts' ) ) {
		function laptopfusion_scripts()
		{
			// LOAD THE STYELSHEET
			wp_enqueue_style( 'fontawesome', STYLES . '/font-awesome.min.css', null, null, null );	
			wp_enqueue_style( 'bootstrap', STYLES . '/bootstrap.css', null, null, null );
			wp_enqueue_style( 'flexslider', STYLES . '/flexslider.css', null, null, null );
			wp_enqueue_style( 'main', STYLES . '/main.css', null, null, null );
			wp_enqueue_style( 'custom', STYLES . '/custom.css', null, null, null );

			// LOAD THE SCRIPTS
			wp_enqueue_script( 'bootstrap-js', SCRIPTS . '/bootstrap.js', [ 'jquery' ], null, true );
			wp_enqueue_script( 'plugins-js', SCRIPTS . '/plugins.js', [ 'jquery' ], null, true );
			wp_enqueue_script( 'flexslider-js', SCRIPTS . '/jquery.flexslider.js', [ 'jquery' ], null, true );
		}

		add_action( 'wp_enqueue_scripts', 'laptopfusion_scripts' );
	}

/*----------  3.0 SET UP THEME DEFAULT AND REGISTER VARIOUS SUPPORTED FEATURES.  ----------*/
	if ( ! function_exists( 'laptopfusion_setup' )) {
		function laptopfusion_setup()
		{
			// MAKE THE THEME AVAILABLE FOR TRANSLATION.
			$lang_dir = THEMEROOT . '/assets/language';
			load_theme_textdomain( 'laptopfusion', $lang_dir );

			// ADD SUPPORT FOR AUTOMATIC FEED LINKS.
			add_theme_support( 'automatic_feed_links' );

			// ADD SUPPORT FOR POST THUMBNAILS.
			add_theme_support( 'post-thumbnails' );

			// ADD SUPPORT FOR POST FORMATS.
			add_theme_support( 'post-formats', [
				'gallery', 'link', 'audio', 'video', 'quote'
			] );

			// REGISTER NAVIGATION MENU
			register_nav_menus( [
				'top-menu' => __( 'Top Menu', 'laptopfusion'),
				'footer-menu' => __( 'Footer Menu', 'laptopfusion'),
			] );
		}
		add_action( 'after_setup_theme', 'laptopfusion_setup' );
	}

/*----------  4.0 DISPLAY META INFORMATION FOR A SPECIFIC POST.  ----------*/
if (! function_exists('laptopfusion_post_meta' ))
 {
	function laptopfusion_post_meta()
	{
		echo '<div class="large-post-meta">';
		if (get_post_type() === 'post') 
		{
			// IF THE POST IS STICKY, MARK IT
			if (is_sticky() ) 
			{
				echo '<span><i class="fa fa-sticky-note-o"></i>' . __('sticky', 'laptopfusion') . '</span>';
				echo '<small class="hidden-xs">&#124;</small>';
			}

			// GET THE DATE
					echo '<span><i class="fa fa-clock-o"></i> ' . get_the_date() . '</span>';
				    echo '<small class="hidden-xs">&#124;</small>';

					// GET THE POST AUTHOR
					printf(
						'<span><i class="fa fa-user"></i> <a href="%1$s">%2$s</a></span>',
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ))),
						get_the_author()			
					);
				    	echo '<small class="hidden-xs">&#124;</small>';
			// GET THE TAGS
					$tag_list = get_the_tag_list( '', ', ' );
					if ($tag_list) 
					{
						echo '<span><i class="fa fa-tags"></i> ' . $tag_list . '</span>';
				    	echo '<small class="hidden-xs">&#124;</small>';
					}

			//COMMENTS LINK
			if ( comments_open() ) 
			{
				echo '<span><i class="fa fa-comments-o"></i> ';
				comments_popup_link(
					__('Leave a comment', 'laptopfusion'),

					__('One comment', 'laptopfusion'),

					__('View all %', 'laptopfusion')
				);
				echo '</span>';
				echo '<small class="hidden-xs">&#124;</small>';
			}
			// EDIT LINK
					if ( is_user_logged_in() ) {
						echo '<span><i class="fa fa-pencil"></i> ';
							edit_post_link( __( 'Edit', 'laptopfusion'), '<span>', '</span>' );
						echo '</span>';
					}
				}	
			echo '</div>';
		}
	}
	/*----------  5.0 DISPLAY NAVIGATION TO THE NEXT/PREVIOUS SET OF POST.  ----------*/
	if ( ! function_exists('laptopfusion_paging_nav')) {
		function laptopfusion_paging_nav()
		{
			echo '<ul class=" pager list-unstyled">';
			if (get_previous_posts_link()) {
				echo '<li class="next"><span aria-hidden="true">';
				previous_posts_link( __('Newer post &rarr;', 'laptopfusion') );
				echo '</span></li>';
			}
			if (get_next_posts_link()) {
				echo '<li class="previous"><span aria-hidden="true">';
				next_posts_link( __('&larr; Older post', 'laptopfusion') );
				echo '</span></li>';
			}
			echo '</ul>';


		}
	}
	/*----6.0 NUMBERED PAGINATION-----*/
	
	if ( ! function_exists( 'laptopfusion_numbered_pagination' )) {
		function laptopfusion_numbered_pagination() {
			echo '<div class="pagination-wrapper">';
			$args = [
					'prev_next' =>  false,
					'type' => 'array'
				];
			$paginates = paginate_links( $args);
			if ( is_array($paginates)) {
				echo '<nav><ul
				class="pagination">
				';
				foreach ($paginates as $paginate) {
					if ( strpos($paginate, 'current')) 
							echo '<li><a href="#">' . $paginate . '</a></li>';
						else
							echo '<li>' . $paginate . '</li>';;
					}
					echo '</ul></nav>'; 
				}
			echo '</div>';
		}
	}
	/*----REGISTER WIDGET AREA-------*/
	if ( ! function_exists( 'laptopfusion_widget_init' )) {
		function laptopfusion_widget_init() {
			$widget = [
				'name' => __( 'Footer One'),
				'id' => 'footer-one',
				'description' => __( 'Apears in footer Column One'),
				'class' => '',
				'before_widget' => '<ul class="check">',
				'after_widget' => '</ul>',
				'before_title' => '<div class="widget-title"><h4>', 
				'after_title' =>  '</h4><hr></div>'
			];

			register_sidebar( $widget );

			$widget = [
				'name' => __( 'Footer Two'),
				'id' => 'footer-two',
				'description' => __( 'Apears in footer Column Two'),
				'class' => '',
				'before_widget' => '<ul class="check">',
				'after_widget' => '</ul>',
				'before_title' => '<div class="widget-title"><h4>', 
				'after_title' =>  '</h4><hr></div>'
			];

			register_sidebar( $widget );
		}
		add_action( 'widgets_init', 'laptopfusion_widget_init' );
	}
	/*================================================
	   WORDPRESS ADMIN PANEL CUSTOMMIZATION
	   ===============================================*/
	   function edit_wp_menu()
	   {
	   	//REMOVE MENU 
	   	//https://developer.wordpress.org/reference/functions/remove_menu_page/
	   remove_menu_page( 'edit-comments.php' );

	   //ADD MENU ITEM.
	   // https://developer.wordpress.org/reference/functions/add_menu_page/
	   add_menu_page(
	   	'New comments',
	   	'Laptop comments',
	   	'manage_options',
	   	'edit-comments.php',
	   	'',
	   	'',
	   	6
	   );

	   //CHANGE THE ORDER
	   // https://developer.wordpress.org/reference/functions/remove_menu_page/
	   function change_menu_order($menu_order)
	   {
	   	return[
	   		'index.php',
	   		'themes.php',
	   		'edit.php',
	   		'edit.php?post_type=page',
	   		'upload.php'
	   	];

	   }
	   add_filter('menu_order', 'change_menu_order');
	   add_filter('custom_menu_order', '__return_true');

	   //RENAME POST TO LAPTOPS | YOUR ANY BRAND NAME//
	   global $menu;
	   global $submenu;

	   // print_r($submenu);
	    $menu[5][0] = 'Laptops';
	    $submenu['edit.php'][5][0] = 'All Laptops';
		$submenu['edit.php'][10][0] = 'Add New Laptop';
		$submenu['edit.php'][15][0] = 'Brands';
		$submenu['edit.php'][16][0] = 'Keywords';

	}
	//RENAME POSTS LABLES TO LAPTOP | YOUR BRAND NAME INTO POST SECTION.
	function change_post_labels()
	{
		global $wp_post_types;
		//print_r($wp_post_types);

		$labels = $wp_post_types['post']->labels;
			$labels->name = 'Laptops';
            $labels->singular_name = 'Laptop';
            $labels->add_new = 'Add New Laptop';
            $labels->add_new_item = 'Add New Laptop';
            $labels->edit_item = 'Edit Laptop';
            $labels->new_item = 'New Laptop';
            $labels->view_item = 'View Laptop';
            $labels->view_items = 'View Laptops';
            $labels->search_items = 'Search Laptops';
            $labels->not_found = 'No Laptops found.';
            $labels->not_found_in_trash = 'No Laptops found in Trash.';
            $labels->all_items = 'All Laptops';
            $labels->archives = 'Laptop Archives';
            $labels->attributes = 'Laptop Attributes';
            $labels->insert_into_item = 'Insert into Laptop';
            $labels->uploaded_to_this_item = 'Uploaded to this Laptop';
            $labels->filter_items_list = 'Filter Laptops list';
            $labels->items_list_navigation = 'Laptops list navigation';
            $labels->items_list = 'Laptops list';
            $labels->item_published = 'Laptop published.';
            $labels->item_published_privately = 'Laptop published privately.';
            $labels->item_reverted_to_draft = 'Laptop reverted to draft.';
            $labels->item_scheduled = 'Laptop scheduled.';
            $labels->item_updated = 'Laptop updated.';
            $labels->item_link = 'Laptop Link';
            $labels->item_link_description = 'A link to a Laptop.';
            $labels->menu_name = 'Laptops';
            $labels->name_admin_bar = 'Laptop';
		}
		
		add_action( 'init', 'change_post_labels' );
		add_action( 'admin_menu', 'edit_wp_menu' );

		/*------------------2.0 THE DASHBOARD.-----------*/
		function customize_dashboard()
		{
	        // remove a deafult dashboard widget.	   	// https://developer.wordpress.org/reference/functions/remove_meta_box/

	      remove_meta_box('dashboard_quick_press', 'dashboard', 'side');

	      //remove welcome panel.
	      remove_action('welcome_panel', 'wp_welcome_panel');

	      //add a new dashboard widget.
	      wp_add_dashboard_widget(
	      	'date_dashboard_widget',
	      	'Today',
	      	'date_dashboard_widget_function'
	      );
	      function date_dashboard_widget_function()
	      {
	      	echo 'Hi, Today is ' . date('l\, F JS Y');
	      }

		}
		add_action('wp_dashboard_setup', 'customize_dashboard');

		/*-----------3.0 THE COLUMNS---------------*/
		function customize_post_listing_cols( $columns )
	{
		// print_r($columns);
		unset($columns['tags']);
		unset($columns['comments']);
		return $columns;
	}
	function customize_page_listing_cols( $columns )
	{
		// print_r($columns);
		unset($columns['tags']);
		unset($columns['comments']);
		return $columns;
	}

	add_action( 'manage_posts_columns', 'customize_post_listing_cols' );
	add_action( 'manage_pages_columns', 'customize_page_listing_cols' );

	/*----------  4.0 THE SMALLER CHANGES.  ----------*/
	function change_admin_footer()
	{
		echo 'Copyrights &copy; All rights reserved 2022 by student of AFA';
	}
	add_action('admin_footer_text', 'change_admin_footer');
	function remove_footer_version()
	{
		remove_filter('update_footer', 'core_update_footer');
	}
	add_action('admin_menu', 'remove_footer_version');

	/*----------  5.0 CHANGE YOUR COLOR SCHEME.  ----------*/
	function add_color_schemes()
	{
		$dir = THEMEROOT;
		wp_admin_css_color( 
			'laptopfusion', 
			__( 'Laptop Fusion'), 
			$dir . '/assets/css/colors.min.css', 
			['#336699', '#996633', '#369369', '#963963']
		);
	}

	add_action( 'admin_init', 'add_color_schemes' );



	/*----------  6.0 CHANGE WP LOGIN LOGO.  ----------*/
	function change_login_logo($value=''){ ?>
	<!-- https://codex.wordpress.org/Customizing_the_Login_Form -->
	<style>
	#login h1 a, .login h1 a
	{
		background-image: url(<?php echo IMAGES ?>/logo1.png);
			height:95px;
			width:400px;
			position: relative;
			right: 455px;
			background-size: 400px 95px;
			background-repeat: no-repeat;
        	padding-bottom: px;
	}
	</style>
	<?php }
	add_action('login_enqueue_scripts', 'change_login_logo')	;
	function change_login_logo_url()
	{
		return home_url();
	}
	add_filter( 'login_headerurl', 'change_login_logo_url' );

	/*----------  7.0 CHANGE YOUR LOGIN STYLES.  ----------*/
	function change_login_styles()
	{
		wp_enqueue_style('custom-login-style', STYLES . '/custom-login.css');
		wp_enqueue_script('custom-login-script', SCRIPTS . '/custom-login-js');
	}
	add_action('login_enqueue_scripts', 'change_login_styles');

	function disable_reset_password()
	{
		return false;
	}
	add_filter('allow_password_reset', 'disable_reset_password');

function remove_shake()
	{
		remove_action( 'login_head', 'wp_shake_js', 12 );
	}
	add_action( 'login_head', 'remove_shake' );

	/*----------  8.0 CUSTOMIZE YOUR ADMIN BAR.  ----------*/
	//https://www.isitwp.com/addremove-wp-admin-bar-links//
	function remove_admin_bar_links()
	{
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wp-logo');
	}
	add_action('wp_before_admin_bar_render', 'remove_admin_bar_links');

	function add_admin_bar_links()
	{
		global $wp_admin_bar;
		$wp_admin_bar->add_menu([
			'id' => 'afa',
			'title' => 'Al-Fateem Academy',
			'href' => 'https://www.alfateemacademy.com/',
			'meta' => ['target' => '_blank']
		]);
		}

	add_action( 'admin_bar_menu', 'add_admin_bar_links' );

	function admin_bar_css() { ?>
		<style>
			#wpadminbar { background-color: grey; }
		</style>
	<?php }

	add_action( 'admin_head', 'admin_bar_css' );


	function login_background_image() {?>
<style>
body.login{
background-image: url(<?php echo IMAGES ?>/screen.png);
            height:700px;
			width:1400px;
			background-size: 1400px 700px;
			background-repeat: no-repeat;
        	padding-bottom: px;
}
</style>’;
<?php }
add_action('login_head', 'login_background_image');




?>

























