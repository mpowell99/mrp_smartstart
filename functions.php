<?php
/**
 * MRP-SmartStart functions and definitions
 *
 * @package MRP-SmartStart
 * @since 1.0
 * @version 1.0
 */

define( 'MRP_THEME_DIR', get_template_directory() );
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
add_action( 'init', 'mrp_menus' );
function mrp_menus() {
    register_nav_menus( array( 'header-menu' => __( 'Header Menu' ) ) );
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
                'name'          => __( 'Our Team' ),
                'singular_name' => __( 'Our Team' ),
				'add_new_item'  => __( 'Add New Team Member' ),
				'edit_item'     => __( 'Edit Team Member' ),
				'new_item'      => __( 'New Team Member' ),
				'view_item'     => __( 'View Team Member' ),
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
                'name'          => __( 'Projects' ),
                'singular_name' => __( 'Project' ),
				'add_new_item'  => __( 'Add New Project' ),
				'edit_item'     => __( 'Edit Project' ),
				'new_item'      => __( 'New Project' ),
				'view_item'     => __( 'View Project' ),
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
			'label' => __( 'Skills' ),
			'rewrite' => array( 'slug' => 'skill' ),
            'labels' => array(
                'name'          => __( 'Skills' ),
                'singular_name' => __( 'Skill' ),
				'add_new_item'  => __( 'Add New Skill' ),
				'edit_item'     => __( 'Edit Skill' ),
				'new_item'      => __( 'New Skill' ),
				'view_item'     => __( 'View Skill' ),
            ),
			'hierarchical' => TRUE,
		)
	);

	/* Portfolio Taxonomy: Disciplines (Photography, Illustration, etc) */
	register_taxonomy(
		'disciplines',
		'portfolio',
		array(
			'label' => __( 'Disciplines' ),
			'rewrite' => array( 'slug' => 'discipline' ),
            'labels' => array(
                'name'          => __( 'Disciplines' ),
                'singular_name' => __( 'Discipline' ),
				'add_new_item'  => __( 'Add New Discipline' ),
				'edit_item'     => __( 'Edit Discipline' ),
				'new_item'      => __( 'New Discipline' ),
				'view_item'     => __( 'View Discipline' ),
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
			'name'          => 'Sidebar 1',
			'id'            => 'sidebar-1',
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
    include_once( ABSPATH.'wp-admin/includes/plugin.php' );

	/* Define which plugins are required */
    $aRequired_plugins = array(
        array(
			'name'=>'Advanced Custom Fields',
			'download'=>'http://wordpress.org/plugins/advanced-custom-fields/',
			'path'=>'advanced-custom-fields/acf.php',
		),
		array(
			'name' => 'Comment Form 7',
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
    $plugin_messages = array();
    foreach ( $aRequired_plugins as $aPlugin ) {
        // Check if plugin exists
        if ( ! is_plugin_active( $aPlugin['path'] ) ) {
            $plugin_messages[] = "This theme requires plugin <b>".$aPlugin['name']."</b>. <a href='".$aPlugin['download']."' target='pluginwin'>Download</a>";
        }
    }

	/* If there were any errors, display them */
    if ( count( $plugin_messages ) > 0 ) {
		echo '<div style="margin: 20px 0px; width: 400px; background-color: white; border: 5px red solid; padding: 5px 10px; border-radius: 10px;">';
        foreach ( $plugin_messages as $message ) {
            echo '<p>'.$message.'</p>';
        }
		echo '</div>';
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
	/* Inputs for the Team page */
	$wp_customize->add_setting( 'team_title', array( 'default'   => 'Team' ) );
	$wp_customize->add_setting( 'team_description', array( 'default'   => '' ) );

	/* Inputs for the Portfolio page */
	$wp_customize->add_setting( 'portfolio_title', array( 'default'   => 'Portfolio' ) );
	$wp_customize->add_setting( 'portfolio_description', array( 'default'   => '' ) );

	/* Inputs for the Blog page */
	$wp_customize->add_setting( 'blog_title', array( 'default'   => 'Our Blog' ) );

	/* Inputs for the Contact page */
	$wp_customize->add_setting( 'contact_title', array( 'default'   => 'Contact Us' ) );
	$wp_customize->add_setting( 'contact_formhead', array( 'default'   => "Let's Keep in Touch") );
	$wp_customize->add_setting( 'contact_address', array( 'default'   => '') );

	/* New sections on the Customize Theme menu for our new options */
	$wp_customize->add_section(
		'mrp_custom_headers' , array(
    		'title'      => __( 'Custom Headers', 'mrp-smartstart' ),
    		'priority'   => 30,
		)
	);
	$wp_customize->add_section(
		'mrp_contact_settings' , array(
    		'title'      => __( 'Contact Page Settings', 'mrp-smartstart' ),
    		'priority'   => 35,
		)
	);

	/* Admin controls for our new options: Team */
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'team_title',
			array(
				'label'      => __( 'Team Page Header', 'mrp-smartstart' ),
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
				'label'      => __( 'Team Page Description', 'mrp-smartstart' ),
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
				'label'      => __( 'Portfolio Page Header', 'mrp-smartstart' ),
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
				'label'      => __( 'Portfolio Page Description', 'mrp-smartstart' ),
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
				'label'      => __( 'Blog Page Header', 'mrp-smartstart' ),
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
				'label'      => __( 'Contact Page Title', 'mrp-smartstart' ),
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
				'label'      => __( 'Contact Form Header', 'mrp-smartstart' ),
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
				'label'      => __( 'Contact Address', 'mrp-smartstart' ),
				'section'    => 'mrp_contact_settings',
				'settings'   => 'contact_address',
				'type'       => 'textarea',
			)
		)
	);
}

?>
