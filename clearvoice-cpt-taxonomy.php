<?php

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Post types Class.
 */
class CLV_Post_Types
{
    /**
     * Hook in methods.
     */
    public static function init()
    {
        add_action('init', array( __CLASS__, 'register_taxonomies' ) );
        add_action('init', array( __CLASS__, 'register_post_types' ) );
    }
    /**
     * Registering taxonomies for ClearVoice Custom Post Types
     */
    public static function register_taxonomies() {

        $labels = array(
            'name'              => __( 'Hire Freelancer Categories', 'ClearVoice-backend-functionality' ),
            'singular_name'     => __( 'Category', 'ClearVoice-backend-functionality' ),
            'search_items'      => __( 'Search Freelancer Categories', 'ClearVoice-backend-functionality' ),
            'all_items'         => __( 'All Freelancer Categories', 'ClearVoice-backend-functionality' ),
            'view_item'         => __( 'View Category', 'ClearVoice-backend-functionality' ),
            'parent_item'       => __( 'Parent Category', 'ClearVoice-backend-functionality' ),
		    'parent_item_colon' => __( 'Parent Category:', 'ClearVoice-backend-functionality' ),
		    'edit_item'         => __( 'Edit Category', 'ClearVoice-backend-functionality' ),
		    'update_item'       => __( 'Update Category', 'ClearVoice-backend-functionality' ),
		    'add_new_item'      => __( 'Add New Category', 'ClearVoice-backend-functionality' ),
		    'new_item_name'     => __( 'New Category Name', 'ClearVoice-backend-functionality' ),
		    'not_found'         => __( 'No Categories Found', 'ClearVoice-backend-functionality' ),
		    'back_to_items'     => __( 'Back to Categories', 'ClearVoice-backend-functionality' ),
            'menu_name'         => __( 'Categories', 'ClearVoice-backend-functionality' ),
        );

        register_taxonomy(
			'clv-hire-freelancer-categories', 'clv-hire-freelancer',
            array(
                'hierarchical'      => false,
                'show_ui'           => true,
                'show_in_nav_menus' => true,
                'show_admin_column' => true, // Show as a column on custom post type screen.
                'show_in_rest'      => true, // Make it available in block editor.
                'rewrite'           => array( 'slug' => 'hire-freelancers/category' ), // Url hierarchy
                'public'            => true,
                'labels'            => $labels,
            )
		);

    }
    /**
     * Registering taxonomies for Custom Post Types
     */
    public static function register_post_types() {

        $labels = array(
            'name'                     => __( 'Hire Freelancers', 'ClearVoice-backend-functionality' ),
            'singular_name'            => __( 'Hire Freelancer', 'ClearVoice-backend-functionality' ),
            'add_new'                  => __( 'Add New', 'ClearVoice-backend-functionality' ),
            'add_new_item'             => __( 'Add New Freelancer', 'ClearVoice-backend-functionality' ),
            'edit_item'                => __( 'Edit Freelancer', 'ClearVoice-backend-functionality' ),
            'new_item'                 => __( 'New Freelancer', 'ClearVoice-backend-functionality' ),
            'view_item'                => __( 'View Freelancer', 'ClearVoice-backend-functionality' ),
            'view_items'               => __( 'View Freelancers', 'ClearVoice-backend-functionality' ),
            'search_items'             => __( 'Search Freelancers', 'ClearVoice-backend-functionality' ),
            'not_found'                => __( 'No Freelancers found.', 'ClearVoice-backend-functionality' ),
            'not_found_in_trash'       => __( 'No Freelancers found in Trash.', 'ClearVoice-backend-functionality' ),
            'parent_item_colon'        => __( 'Parent Freelancers:', 'ClearVoice-backend-functionality' ),
            'all_items'                => __( 'All Freelancers', 'ClearVoice-backend-functionality' ),
            'archives'                 => __( 'Freelancers Archives', 'ClearVoice-backend-functionality' ),
            'attributes'               => __( 'Freelancer Attributes', 'ClearVoice-backend-functionality' ),
            'insert_into_item'         => __( 'Insert into Freelancer', 'ClearVoice-backend-functionality' ),
            'uploaded_to_this_item'    => __( 'Uploaded to this Freelancer', 'ClearVoice-backend-functionality' ),
            'menu_name'                => __( 'Hire Freelancers', 'ClearVoice-backend-functionality' ),   
         );

         $args = array(
            'labels'                => $labels,
            'description'           => __( 'Add Hire Freelancers Posts here', 'ClearVoice-backend-functionality' ),
            'public'                => true,
            'hierarchical'          => false,
            'exclude_from_search'   => false,  // Posts from this cpt will be searchable by users
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => true,
            'show_in_admin_bar'     => true,
            'show_in_rest'          => true,  // Add support for block editor.
            'menu_position'         => 5,     // Show after wordpress default posts
            'menu_icon'             => 'dashicons-businessman',
            'capability_type'       => 'post',
            'capabilities'          => array(),  // Add custom capabilites default to capability_type.
            'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'revisions' ),
            'taxonomies'            => array( 'clv-hire-freelancer-categories' ),
            'has_archive'           => true,
            'rewrite'               => array( 'slug' => 'hire-freelancers' ), // How the slug will show in the URL. 
            'query_var'             => true,
            'can_export'            => true,
            'delete_with_user'      => false,   // Don't delete the posts automatically with user deletion.
         );
         register_post_type( 'clv-hire-freelancer', $args );

    }
}
CLV_Post_Types::init();

