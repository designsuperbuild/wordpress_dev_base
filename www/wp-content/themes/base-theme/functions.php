<?php
/**
 * Roots includes
 */
require_once locate_template('/lib/utils.php');           // Utility functions
require_once locate_template('/lib/init.php');            // Initial theme setup and constants
require_once locate_template('/lib/wrapper.php');         // Theme wrapper class
require_once locate_template('/lib/sidebar.php');         // Sidebar class
require_once locate_template('/lib/config.php');          // Configuration
require_once locate_template('/lib/activation.php');      // Theme activation
require_once locate_template('/lib/titles.php');          // Page titles
require_once locate_template('/lib/cleanup.php');         // Cleanup
require_once locate_template('/lib/nav.php');             // Custom nav modifications
require_once locate_template('/lib/gallery.php');         // Custom [gallery] modifications
require_once locate_template('/lib/comments.php');        // Custom comments modifications
require_once locate_template('/lib/rewrites.php');        // URL rewriting for assets
require_once locate_template('/lib/relative-urls.php');   // Root relative URLs
require_once locate_template('/lib/widgets.php');         // Sidebars and widgets
require_once locate_template('/lib/scripts.php');         // Scripts and stylesheets
require_once locate_template('/lib/custom.php');          // Custom functions


/*--------------------------------------------------------------------------
  Default Attachement Display Config
  --------------------------------------------------------------------------*/

  function default_attachment_display_settings() {
    update_option( 'image_default_align', 'left' );
    update_option( 'image_default_link_type', 'none' );
    update_option( 'image_default_size', 'bm-large' );
  }


/*--------------------------------------------------------------------------
  Custom Image Size
  --------------------------------------------------------------------------*/

  add_image_size('bm-med', 750, 422, true);


/*--------------------------------------------------------------------------
  Add image sizes to Media Selection UI
  --------------------------------------------------------------------------*/

  add_filter('image_size_names_choose', 'dsb_display_image_size_names_in_muploader', 11, 1);
  function dsb_display_image_size_names_in_muploader( $sizes ) {
    $new_sizes = array();
    $added_sizes = get_intermediate_image_sizes();
    foreach( $added_sizes as $key => $value) {
      $new_sizes[$value] = $value;
    }
    $new_sizes = array_merge( $new_sizes, $sizes );
    return $new_sizes;
  }


/*--------------------------------------------------------------------------
  Custom Post Types with Custom Taxonomies
  - see dsb/custom_post_types.php for the setup
  - see page-case-studies.php for the them use of the custom post type
  --------------------------------------------------------------------------*/

  require_once locate_template('/dsb/custom_post_types.php');


/*--------------------------------------------------------------------------
  WP-Alchemy - see http://www.farinspace.com/wpalchemy-metabox/
  --------------------------------------------------------------------------*/

  // require_once locate_template('/dsb/wpalchemy/MetaBox.php');
  // require_once locate_template('/dsb/wpalchemy/MediaAccess.php');

  // add_action( 'init', 'dsb_metabox_styles' );
   
  // function dsb_metabox_styles() {
  //   if ( is_admin() ) { 
  //     wp_enqueue_style( 'wpalchemy-metabox', get_stylesheet_directory_uri() . '/wpalchemy/meta.css' );
  //   }
  // }

  // $wpalchemy_media_access = new WPAlchemy_MediaAccess();

  // $custom_metabox = new WPAlchemy_MetaBox(
  //   array(
  //     'id' => '_custom_meta',
  //     'title' => 'Gallery Images',
  //     'template' => STYLESHEETPATH . '/dsb/wpalchemy/gallery-meta.php',
  //     // 'hide_editor' => TRUE,
  //     // 'include_template' => array('post-gallery.php') 
  //   )
  // );


/*
  Example of Use In Theme

  <div class="gallery">
    <?php 
      global $custom_metabox;
      while($custom_metabox->have_fields('docs')): 
    ?>
      <div class="gallery-element">
        <div class="gal-image">
          <a href="<?php $custom_metabox->the_value('link'); ?>" target="_blank">
            <img src="<?php $custom_metabox->the_value('imgurl'); ?>">
          </a>
        </div>
        <div class="gal-text-block">
          <div class="gal-title">
            <h4><?php $custom_metabox->the_value('title'); ?></h4>
          </div>
          <div class="gal-text">
            <?php $custom_metabox->the_value('caption'); ?>
          </div>
        </div> 
      </div>
    <?php endwhile; ?>  
  </div>

*/
