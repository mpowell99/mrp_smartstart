<?php
/**
 * MRP-SmartStart functions and definitions
 *
 * @package MRP-SmartStart
 * @since 1.0
 * @version 1.0
 */

define( 'MRP_THEME_URI', get_template_directory_uri() );

/**
 *  Setup the theme with the necessary support features and image sizes
 */
add_action( 'after_setup_theme', 'mrp_setup_theme' );
function mrp_setup_theme() {

    /* Enable theme to to manage the document title tag */
	add_theme_support( 'title-tag' );

	/* Add Automatic Feed Links */
	add_theme_support( 'automatic-feed-links' );

    /* Define custom logo */
    $logo_defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
	add_theme_support( 'custom-logo', $logo_defaults );

	/* Enable post-thumbnails for this theme */
    add_theme_support( 'post-thumbnails' );

	/* Add custom image sizes */
	add_image_size( 'feature-slider', 940, 380, true );
	add_image_size( 'portfolio-large', 680, 600, true );
	add_image_size( 'blog-header', 680, 235, true );
	add_image_size( 'portfolio-archive', 300, 190, true );
	add_image_size( 'portfolio-thumb', 220, 140, true );
}


/**
 *  Enqueue Stylesheets and Javascript
 */
add_action( 'wp_enqueue_scripts', 'mrp_scripts' );
function mrp_scripts() {
	/* Styles */
    wp_enqueue_style( 'googlefonts', '//fonts.googleapis.com/css?family=Open+Sans:400,600,300,800,700,400italic|PT+Serif:400,400italic' );
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'fancybox-style', MRP_THEME_URI.'/assets/css/fancybox.min.css' );
    wp_enqueue_style( 'audioplayer-style', MRP_THEME_URI.'/assets/css/audioplayerv1.min.css' );

	/* Scripts */
	wp_enqueue_script( 'jquery-js', '//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' );
	wp_enqueue_script( 'googlemaps-js', '//maps.google.com/maps/api/js?sensor=false&key=AIzaSyAL-Oc1Sk5N1maxzRWPTB9w3gTSMbJePkE' );
    wp_enqueue_script( 'modernizr-js', MRP_THEME_URI.'/assets/js/modernizr.custom.js' );
	wp_enqueue_script( 'respond-js', MRP_THEME_URI.'/assets/js/respond.min.js' );
	wp_enqueue_script( 'easing-js', MRP_THEME_URI.'/assets/js/jquery.easing-1.3.min.js' );
	wp_enqueue_script( 'fancybox-js', MRP_THEME_URI.'/assets/js/jquery.fancybox.pack.js' );
	wp_enqueue_script( 'slider-js', MRP_THEME_URI.'/assets/js/jquery.smartStartSlider.min.js' );
	wp_enqueue_script( 'jcarousel-js', MRP_THEME_URI.'/assets/js/jquery.jcarousel.min.js' );
	wp_enqueue_script( 'cycle-js', MRP_THEME_URI.'/assets/js/jquery.cycle.all.min.js' );
	wp_enqueue_script( 'isotope-js', MRP_THEME_URI.'/assets/js/jquery.isotope.min.js' );
	wp_enqueue_script( 'jquery-gmap-js', MRP_THEME_URI.'/assets/js/jquery.gmap.min.js' );
	wp_enqueue_script( 'touchswipe-js', MRP_THEME_URI.'/assets/js/jquery.touchSwipe.min.js' );
	wp_enqueue_script( 'custom-js', MRP_THEME_URI.'/assets/js/custom.js' );
}


/**
 *  Register navigation menu
 */
add_action( 'init', 'mrp_register_menu' );
function mrp_register_menu() {
    register_nav_menus( array( 'header-menu' => 'Header Menu' ) );
}

/**
 *  Add class to the active item on the navigation menu
 */
add_filter( 'nav_menu_css_class' , 'mrp_nav_class' , 10 , 2 );
function mrp_nav_class( $classes, $item ) {
    if ( in_array( 'current-menu-item', $classes ) ) {
    	$classes[] = 'current ';
    }
    return $classes;
}


/**
 *  Register Custom Post Types for Theme
 */
add_action( 'init', 'create_posttypes' );
function create_posttypes() {

	/* Custom Post Type: Team */
    register_post_type( 'team',
        array(
            'labels' => array(
                'name'          => 'Our Team',
                'singular_name' => 'Our Team',
				'add_new_item'  => 'Add New Team Member',
				'edit_item'     => 'Edit Team Member',
				'new_item'      => 'New Team Member',
				'view_item'     => 'View Team Member',
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array( 'slug' => 'team', 'with_front' => false ),
            'supports' => array( 'title', 'excerpt', 'thumbnail' ),
        )
    );

	/* Custom Post Type: Portfolio */
    register_post_type( 'portfolio',
        array(
            'labels' => array(
                'name'          => 'Projects',
                'singular_name' => 'Project',
				'add_new_item'  => 'Add New Project',
				'edit_item'     => 'Edit Project',
				'new_item'      => 'New Project',
				'view_item'     => 'View Project',
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array( 'slug' => 'portfolio', 'with_front' => false ),
            'supports' => array( 'title', 'editor', 'thumbnail' ),
			'taxonomies' => array( 'disciplines', 'skills' ),
			'with_front' => false,
        )
    );
}


/**
 *  Create custom taxonomies for custom post types
 */
add_action( 'init', 'mrp_taxonomies_init' );
function mrp_taxonomies_init() {

	/* Portfolio Taxonomy: Skills (HTML/CSS, Database Design, Programming, etc) */
	register_taxonomy(
		'skills',
		'portfolio',
		array(
			'label' => 'Skills',
			'rewrite' => array( 'slug' => 'skill' ),
            'labels' => array(
                'name'          => 'Skills',
                'singular_name' => 'Skill',
				'add_new_item'  => 'Add New Skill',
				'edit_item'     => 'Edit Skill',
				'new_item'      => 'New Skill',
				'view_item'     => 'View Skill',
            ),
			'hierarchical' => TRUE,
		)
	);

	/* Portfolio Taxonomy: Disciplines (Photography, Illustration, etc) */
	register_taxonomy(
		'disciplines',
		'portfolio',
		array(
			'label' => 'Disciplines',
			'rewrite' => array( 'slug' => 'discipline' ),
            'labels' => array(
                'name'          => 'Disciplines',
                'singular_name' => 'Discipline',
				'add_new_item'  => 'Add New Discipline',
				'edit_item'     => 'Edit Discipline',
				'new_item'      => 'New Discipline',
				'view_item'     => 'View Discipline',
            ),
			'hierarchical' => TRUE,
		)
	);
}


/**
 *  Return a nicely-formatted list of taxonomy terms based on current post
 *
 *  @param string $term_type - the taxonomy being queried
 *  @param string $separator - string to put between terms
 *  @param boolean $use_slug - are we displaying the term's slug or name?
 *
 *  @return string $termlist - formatted list of terms
 */
function mrp_termlist( $term_type='category', $separator=' ', $use_slug=FALSE ) {
	$post_id = get_the_ID();
	if ( ! $post_id ) { return FALSE; }

	$terms = get_the_terms( $post_id, $term_type );
	$termlist = "";

	if ( $terms ) {
		foreach( $terms as $termid => $terminfo ) {
			if ( $use_slug ) {
				$termlist .= $terminfo->slug.$separator;
			} else {
				$termlist .= $terminfo->name.$separator;
			}
		}
		$termlist = substr( $termlist, 0, -strlen( $separator ) );
	}
	return $termlist;
}


/**
 *  Add custom classes to prev/next links
 */
add_filter( 'next_post_link', 'mrp_link_attributes' );
add_filter( 'previous_post_link', 'mrp_link_attributes' );
function mrp_link_attributes( $output ) {
    $code = 'class="button medium no-bg"';
	return str_replace( '<a href=', '<a '.$code.' href=', $output );
}


/**
 *  Register the theme's sidebar
 */
add_action( 'widgets_init', 'mrp_register_sidebar' );
function mrp_register_sidebar() {
    register_sidebar(
		$args = array(
			'name'          => 'Sidebar MRP',
			'id'            => 'sidebar-mrp',
			'description'   => 'Right-hand Sidebar on Blog Posts',
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>',
		)
	);
}


/**
 *  Modify the position of the textfield on the comment form
 */
add_filter( 'comment_form_fields', 'mrp_move_comment_field_to_bottom' );
function mrp_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}


/**
 *  Warn admins about plugin requirements of the theme
 */
add_action( 'admin_notices', 'mrp_admin_messages' );
function mrp_admin_messages() {
	/* Define which plugins are required */
    $required_plugins = array(
        array(
			'name'=>'Advanced Custom Fields',
			'download'=>'http://wordpress.org/plugins/advanced-custom-fields/',
			'path'=>'advanced-custom-fields/acf.php',
		),
		array(
			'name' => 'Contact Form 7',
			'download' => 'https://wordpress.org/plugins/contact-form-7/',
			'path' => 'contact-form-7/wp-contact-form-7.php',
		),
		array(
			'name' => 'WP-PageNavi',
			'download' => 'https://wordpress.org/plugins/wp-pagenavi/',
			'path' => 'wp-pagenavi/wp-pagenavi.php',
		)
    );

	/* Check for each required plugin */
    $plugin_message = '';
    foreach ( $required_plugins as $this_plugin ) {
        // Check if plugin exists
        if ( ! is_plugin_active( $this_plugin['path'] ) ) {
            $plugin_message .= "<b><a href='".$this_plugin['download']."'>".$this_plugin['name']."</a></b> and ";
        }
    }

	if ( $plugin_message ) {
		/* strip off the last "and" */
		$plugin_message = substr( $plugin_message, 0, -5 );
		$message = '<div class="setting-error-mrp notice-warning settings-error notice is-dismissible"><p>This theme recommends the following plugins: '.$plugin_message.'</p></div>';
		echo $message;
    }
}

/**
 *  Add a field allowing admins to mark projects as "featured"
 */
add_action( 'post_submitbox_misc_actions', 'mrp_isfeatured_label' );
function mrp_isfeatured_label() {
    $project_id = get_the_ID();

	// Only projects
	if ( get_post_type( $project_id ) !== 'portfolio' ) { return; }

    $is_featured = get_post_meta( $project_id, 'mrp_isfeatured', TRUE );

	echo "
<div class='misc-pub-section mrp-isfeatured-options'>
	<input type='checkbox' id='mrp_isfeatured' name='mrp_isfeatured'";

    if ( $is_featured ) { echo " checked"; }

	echo "
	<label for='mrp_isfeatured'>Featured Project</label>
</div>";
}


/**
 *  When project is saved, also save the value of the is_featured flag
 */
add_action( 'save_post', 'mrp_save_isfeatured' );
function mrp_save_isfeatured() {
    $project_id = get_the_ID();

	// Only projects
	if ( get_post_type( $project_id ) !== 'portfolio' ) { return; }

    // Don't do anything if this is an auto-save
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

    // Exit if I don't have permission to edit the post
    if ( ! current_user_can( 'edit_post', $project_id ) ) { return; }

    if ( isset( $_POST['mrp_isfeatured'] ) ) {
        update_post_meta( $project_id, 'mrp_isfeatured', $_POST['mrp_isfeatured'] );
    } else {
        delete_post_meta( $project_id, 'mrp_isfeatured' );
    }
}


/**
 *  Register new settings, sections and controls in the
 *  Customize Theme admin area
 */
add_action( 'customize_register', 'mrp_customize_register' );
function mrp_customize_register( $wp_customize ) {
	/* Inputs for the Site Identity section */
	$wp_customize->add_setting( 'site_slogan', array(
		'default'   => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	));

	/* Inputs for the Team section */
	$wp_customize->add_setting( 'team_title', array(
		'default'   => 'Team',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_setting( 'team_description', array(
		'default'   => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	));

	/* Inputs for the Portfolio section */
	$wp_customize->add_setting( 'portfolio_title', array(
		'default'   => 'Portfolio',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_setting( 'portfolio_description', array(
		'default'   => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	));

	/* Inputs for the Blog section */
	$wp_customize->add_setting( 'blog_title', array(
		'default'   => 'Our Blog',
		'sanitize_callback' => 'sanitize_text_field',
	));

	/* Inputs for the Contact section */
	$wp_customize->add_setting( 'contact_title', array(
		'default'   => 'Contact Us',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_setting( 'contact_formhead', array(
		'default'   => "Let's Keep in Touch",
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_setting( 'contact_address', array(
		'default'   => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	));

	/* New sections on the Customize Theme menu for our new options */
	$wp_customize->add_section(
		'mrp_custom_headers' , array(
    		'title'      => 'Custom Headers',
    		'priority'   => 30,
		)
	);
	$wp_customize->add_section(
		'mrp_contact_settings' , array(
    		'title'      => 'Contact Page Settings',
    		'priority'   => 35,
		)
	);

	/* Admin controls for our new options: Site Identity */
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'site_slogan',
			array(
				'label'      => 'Site Slogan',
				'section'    => 'title_tagline',
				'settings'   => 'site_slogan',
				'type'       => 'textarea',
			)
		)
	);

	/* Admin controls for our new options: Team */
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'team_title',
			array(
				'label'      => 'Team Page Header',
				'section'    => 'mrp_custom_headers',
				'settings'   => 'team_title',
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'team_description',
			array(
				'label'      => 'Team Page Description',
				'section'    => 'mrp_custom_headers',
				'settings'   => 'team_description',
				'type'       => 'textarea',
			)
		)
	);

	/* Admin controls for our new options: Portfolio */
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'portfolio_title',
			array(
				'label'      => 'Portfolio Page Header',
				'section'    => 'mrp_custom_headers',
				'settings'   => 'portfolio_title',
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'portfolio_description',
			array(
				'label'      => 'Portfolio Page Description',
				'section'    => 'mrp_custom_headers',
				'settings'   => 'portfolio_description',
				'type'       => 'textarea',
			)
		)
	);

	/* Admin controls for our new options: Blog */
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'blog_title',
			array(
				'label'      => 'Blog Page Header',
				'section'    => 'mrp_custom_headers',
				'settings'   => 'blog_title',
			)
		)
	);

	/* Admin controls for our new options: Portfolio */
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'contact_title',
			array(
				'label'      => 'Contact Page Title',
				'section'    => 'mrp_contact_settings',
				'settings'   => 'contact_title',
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'contact_formhead',
			array(
				'label'      => 'Contact Form Header',
				'section'    => 'mrp_contact_settings',
				'settings'   => 'contact_formhead',
			)
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'contact_address',
			array(
				'label'      => 'Contact Address',
				'section'    => 'mrp_contact_settings',
				'settings'   => 'contact_address',
				'type'       => 'textarea',
			)
		)
	);
}

/**
 * Define content width, if it's not already defined
 */
if ( ! isset( $content_width ) ) $content_width = 940;


/**
 * Create the Pages that this theme assumes exist: Blog, Contact and Front Page
 */
add_action( 'after_switch_theme', 'mrp_initialize_theme' );
function mrp_initialize_theme() {
	$contact_id   = mrp_createpage( 'Contact' );
	$blog_id      = mrp_createpage( 'Blog' );
	$frontpage_id = mrp_createpage( 'Front Page' );

	// Let's make sure we're showing the front page, and just 3 blog entires per page
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $frontpage_id );
	update_option( 'page_for_posts', $blog_id );
	update_option( 'posts_per_page', 3 );

	// Let's set up our navigation menu
	mrp_create_menu();

	// Populate our new taxonomies with some terms
	wp_insert_term( 'HTML/CSS', 'skills' );
	wp_insert_term( 'Programming', 'skills' );
	wp_insert_term( 'Information Architecture', 'skills' );
	wp_insert_term( 'Database Design', 'skills' );
	wp_insert_term( 'User Interface Design', 'skills' );
	wp_insert_term( 'Performance Optimization', 'skills' );

	wp_insert_term( 'Animation', 'disciplines' );
	wp_insert_term( 'Web', 'disciplines' );
	wp_insert_term( 'Design', 'disciplines' );
	wp_insert_term( 'Illustration', 'disciplines' );
	wp_insert_term( 'Photography', 'disciplines' );
	wp_insert_term( 'Video', 'disciplines' );

	wp_insert_term( 'Design', 'category' );
	wp_insert_term( 'Awards & Recognition', 'category' );
	wp_insert_term( 'Competitions', 'category' );
	wp_insert_term( 'Travel & Tourism', 'category' );
	wp_insert_term( 'Direct Mail', 'category' );
	wp_insert_term( 'Environment', 'category' );
	wp_insert_term( 'Tips & Tricks', 'category' );

	mrp_default_widgets();
}

function mrp_default_widgets () {
    $new_active_widgets = array (
        'sidebar-mrp' => array (
            'categories-3',
            'text-2',
        ),
    );

    // save new widgets to DB
    update_option('sidebars_widgets', $new_active_widgets);
}

/**
 * Create a new, empty page
 *
 * @param string $page_title - the page title to create
 */
function mrp_createpage( $page_title ) {
	$page_slug = sanitize_title( $page_title );
	$this_page = get_page_by_path( $page_slug, OBJECT, 'page' );

	if ( !$this_page) {
		$page_id = wp_insert_post( array('ID'=>'', 'post_name'=>'', 'post_title'=>$page_title, 'post_type'=>'page', 'post_status'=>'publish') );
	} else {
		$page_id = $this_page->ID;
	}
	return($page_id);
}

/**
 * Register, create and add location of the default menu for our theme
 */
function mrp_create_menu() {
	/* Check if my menu exists */
	$menu_exists = wp_get_nav_menu_object( 'MRP Nav Menu' );

	if (!$menu_exists) {
		$menu_id = wp_create_nav_menu( 'MRP Nav Menu' );

		// Set up default menu items
    	wp_update_nav_menu_item( $menu_id, 0, array(
	        'menu-item-title' =>  'Home',
	        'menu-item-url' => home_url( '/' ),
	        'menu-item-status' => 'publish',
		));
    	wp_update_nav_menu_item( $menu_id, 0, array(
	        'menu-item-title' =>  'Our Team',
			'menu-item-object' => 'team',
			'menu-item-type' => 'post_type_archive',
	        'menu-item-status' => 'publish',
		));
		$blog_page = get_page_by_path( 'blog', OBJECT, 'page' );
    	wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title' => 'Blog',
    		'menu-item-object-id' => $blog_page->ID,
		    'menu-item-object' => 'page',
		    'menu-item-status' => 'publish',
		    'menu-item-type' => 'post_type',
		));
    	wp_update_nav_menu_item( $menu_id, 0, array(
	        'menu-item-title' =>  'Projects',
			'menu-item-object' => 'portfolio',
			'menu-item-type' => 'post_type_archive',
	        'menu-item-status' => 'publish',
		));
		$contact_page = get_page_by_path( 'contact', OBJECT, 'page' );
    	wp_update_nav_menu_item( $menu_id, 0, array(
	        'menu-item-title' => 'Contact',
    		'menu-item-object-id' => $contact_page->ID,
		    'menu-item-object' => 'page',
		    'menu-item-status' => 'publish',
		    'menu-item-type' => 'post_type',
		));

		// Set the menu to the new location and save into database
		$locations = get_theme_mod('nav_menu_locations');
		$locations['header-menu'] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
}

?>
