<?php

/**
 * Custom Post Types
 */
function casestudy_register() {

  $args = array(
    'label'               => 'Case Studies',
    'labels' => array(
      'singular_label'      => 'Case Study',
      'add_new_item'        => 'Add New Case Study',
      'edit_item'           => 'Edit Case Study',
      'new_item'            => 'New Case Study',
      'view_item'           => 'View Case Study',
      'search_items'        => 'Search Case Studies',
      'not_found'           => 'No Case Studies found',
      'not_found_in_trash'  => 'No Case Studies found in trash'
    ),
    'description' => "Case Studies",
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'taxonomies' => array('post_tag'),
    'rewrite' => true,
    'menu_position' => 5,
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt','revisions')
  );

  register_post_type( 'casestudy' , $args );

}

$labels = array(
   'name' => _x( 'Customers', 'taxonomy general name' ),
   'singular_name' => _x( 'Customer', 'taxonomy singular name' ),
   'search_items' =>  __( 'Search Customers' ),
   'all_items' => __( 'All Customers' ),
   'parent_item' => __( 'Parent Customer' ),
   'parent_item_colon' => __( 'Parent Customer:' ),
   'edit_item' => __( 'Edit Customer' ),
   'update_item' => __( 'Update Customer' ),
   'add_new_item' => __( 'Add New Customer' ),
   'new_item_name' => __( 'New Customers' ),
   'menu_name' => __( 'Customers' ),
 );

register_taxonomy("customer", array("casestudy"), array("hierarchical" => true, "labels" => $labels, 'show_ui' => true, 'query_var' => true, 'rewrite'=> array('slug'=>'customer')));

$labels = array(
   'name' => _x( 'Industries', 'taxonomy general name' ),
   'singular_name' => _x( 'Industry', 'taxonomy singular name' ),
   'search_items' =>  __( 'Search Industry' ),
   'all_items' => __( 'All Industries' ),
   'parent_item' => __( 'Parent Industry' ),
   'parent_item_colon' => __( 'Parent Industry:' ),
   'edit_item' => __( 'Edit Industry' ),
   'update_item' => __( 'Update Industry' ),
   'add_new_item' => __( 'Add New Industry' ),
   'new_item_name' => __( 'New Genre Industry' ),
   'menu_name' => __( 'Industries' ),
 );

register_taxonomy("industry", array("casestudy"), array("hierarchical" => true, "labels" => $labels, 'show_ui' => true, 'query_var' => true, 'rewrite'=> array('slug'=>'industry')));

/**
 * Admin setup for Custom Post Types
 */

function casestudy_custom_columns($column){
    global $post;
    switch ($column)
    {
      case "description":
        the_excerpt();
        break;
      case "industry":
        echo get_the_term_list($post->ID, 'industry', '', ', ','');
        break;
      case "customer":
        echo get_the_term_list($post->ID, 'customer', '', ', ','');
        break;
    }
}

function casestudy_edit_columns($columns){
    $columns = array(
      "cb" => "<input type=\"checkbox\" />",
      "title" => "Item Title",
      "description" => "Description",
      "industry" => "Industries",
      "customer" => "Customers",
    );

    return $columns;
}


add_action('init', 'casestudy_register');
add_filter("manage_edit-casestudy_columns", "casestudy_edit_columns");
add_action("manage_posts_custom_column",  "casestudy_custom_columns");
