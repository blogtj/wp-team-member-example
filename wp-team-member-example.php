<?php
/**
 * Plugin Name: Team Member
 * Plugin URI: http://www.wordpress.com
 * Description: This plugin create custom post team members
 * Version: 1.0.0
 * Author: TJ
 * Author URI: http://www.wordpress.com
 * License: GPL2
 */

// create custom post
add_action( 'init', 'codex_team_member_init' );

function codex_team_member_init() {
	$labels = array(
		'name'               => _x( 'Team Members', 'post type general name'),
		'singular_name'      => _x( 'Team Member', 'post type singular name'),
		'menu_name'          => _x( 'Team Members', 'admin menu'),
		'name_admin_bar'     => _x( 'Team Member', 'add new on admin bar'),
		'add_new'            => _x( 'Add New', 'teammember'),
		'add_new_item'       => __( 'Add New Member'),
		'new_item'           => __( 'New Member'),
		'edit_item'          => __( 'Edit Member'),
		'view_item'          => __( 'View Member'),
		'all_items'          => __( 'All Team Members'),
		'search_items'       => __( 'Search Team Members'),
		'parent_item_colon'  => __( 'Parent Team Members:'),
		'not_found'          => __( 'No books found.'),
		'not_found_in_trash' => __( 'No books found in Trash.')
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'team-member' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'team-member', $args );
}


// create custom fields
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_customfields_team-member',
		'title' => 'customfields_team-member',
		'fields' => array (
			array (
				'key' => 'field_585c1df9f97c7',
				'label' => 'Position',
				'name' => 'position',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_585c1dae5ed0a',
				'label' => 'Twitter Url',
				'name' => 'twitter_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_585c1dec71385',
				'label' => 'Facebook Url',
				'name' => 'facebook_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'team-member',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}


// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Departments', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Department', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Taxonomy', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'department', array( 'team-member' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );


//custom template page for archive team-member
add_filter('archive_template','teammember_archive');
function teammember_archive($template){
  if(is_post_type_archive('team-member')){
    $theme_files = array('archive-team-member.php');
    $exists_in_theme = locate_template($theme_files, false);
    if($exists_in_theme == ''){
      return plugin_dir_path(__FILE__) . '/templates/archive-team-member.php';
    }
  }
  return $template;
}


// add css
wp_enqueue_style('css_plugin', plugins_url ( 'css/style.css', __FILE__ ), array(), time(0));

// add javascript
wp_enqueue_script( 'script', plugins_url ( 'js/holder.min.js', __FILE__ ) , true);


//post thumbnail support
add_action( 'after_setup_theme', 'theme_setup' );

function theme_setup() {
      if ( function_exists( 'add_theme_support' ) ) {
        add_image_size( 'mythumb380x180', 380, 180, TRUE);
    }
}

?>
