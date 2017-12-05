<?php
/*
  Add Visual Composer Support
*/

// don't load directly
if (!defined('ABSPATH')) die('-1');

class VCExtendWPMTPv3 {
    function __construct() {
        // We safely integrate with VC with this hook
        add_action( 'init', array( $this, 'integrateWithVC' ) );
        add_shortcode( 'wpmtpv3', array( $this, 'vc_create_shortcode' ) );
    }
 
    public function integrateWithVC() {
        // Check if Visual Composer is installed
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            // Display notice that Visual Compser is required
            add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }

        $categories = get_terms( 'team-category', array(
          'orderby'    => 'title',
          'hide_empty' => 0,
         ) );
        $tax = array();
        $tax['All'] = '';
        if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
          foreach ($categories as $key => $value) {
            $tax[ $value->name ] = $value->slug;
          }
        }

        vc_map( array(
            "name" => __("Meet The Team", 'vc_extend'),
            "description" => __("Display Team Members on your posts/page", 'vc_extend'),
            "base" => "wpmtpv3",
            "class" => "",
            "controls" => "full",
            "icon" => WPMTPv2_IMG . '/vc-icon.png', // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Content', 'js_composer'),
            "params" => array(
              array(
                  "type" => "dropdown",
                  "holder" => "",
                  "class" => "",
                  "heading" => __("Groups/Category", 'vc_extend'),
                  "param_name" => "category",
                  "value" => $tax, 
                  "description" => __("Select Specific Group/Categories you want to display", 'vc_extend'),
                  'admin_label' => true,
                  'group' => __( 'General', 'vc_extend' ),
              ),
              array(
                  "type" => "dropdown",
                  "holder" => "",
                  "class" => "",
                  "heading" => __("Order By", 'vc_extend'),
                  "param_name" => "orderby",
                  "value" => array( __('Default', 'vc_extend') => '', __('Name', 'vc_extend') => 'title', __('Custom Order', 'vc_extend') => 'menu_order' ), 
                  // "description" => __("Select Specific Group/Categories you want to display", 'vc_extend'),
                  'admin_label' => false,
                  'group' => __( 'General', 'vc_extend' ),
              ),
              array(
                  "type" => "dropdown",
                  "holder" => "",
                  "class" => "",
                  "heading" => __("Order", 'vc_extend'),
                  "param_name" => "order",
                  "value" => array( __('Default', 'vc_extend') => '', __('Ascending', 'vc_extend') => 'ASC', __('Descending', 'vc_extend') => 'DESC' ), 
                  // "description" => __("Select Specific Group/Categories you want to display", 'vc_extend'),
                  'admin_label' => false,
                  'group' => __( 'General', 'vc_extend' ),
              ),
              array(
                  "type" => "textfield",
                  "holder" => '',
                  "class" => "",
                  "heading" => __("Filter By ID", 'vc_extend'),
                  "param_name" => "ids",
                  "value" => "",
                  "description" => __("Separate by comma for multiple ID. <strong>Leave Blank if you don't want to display spedific member IDs.</strong>", 'vc_extend'),
                  'admin_label' => false,
                  'group' => __( 'General', 'vc_extend' ),
              ),
              array(
                  "type" => "dropdown",
                  "holder" => "",
                  "class" => "",
                  "heading" => __("Social Icons Position", 'vc_extend'),
                  "param_name" => "position",
                  "value" => array( __('Default', 'vc_extend') => '', __('Before Excerpt/Content', 'vc_extend') => 'before', __('After Excerpt/Content', 'vc_extend') => 'after', __('On Mouse Over', 'vc_extend') => 'image' ), 
                  // "description" => __("Select Specific Group/Categories you want to display", 'vc_extend'),
                  'admin_label' => false,
                  'group' => __( 'Display', 'vc_extend' ),
              ),
              array(
                  "type" => "textfield",
                  "holder" => '',
                  "heading" => __("Number of Entries to display", 'vc_extend'),
                  "param_name" => "limit",
                  "value" => "",
                  "description" => __("Enter 0 or blank to display all.", 'vc_extend'),
                  'admin_label' => false,
                  'group' => __( 'Display', 'vc_extend' ),
              ),
              array(
                  "type" => "checkbox",
                  "holder" => '',
                  "heading" => __("Hide Elements", 'vc_extend'),
                  "param_name" => "hide",
                  "value" => array( 
                              __("Name/Title <br />", 'vc_extend') => 'title', 
                              __("Job Title <br />", 'vc_extend') => 'job_title', 
                              __("Image <br />", 'vc_extend') => 'image', 
                              __("Excerpt/Content <br />", 'vc_extend') => 'excerpt', 
                              __("Social Media Icons <br />", 'vc_extend') => 'social', 
                              __("More Link <br />", 'vc_extend') => 'more', 
                              __("Field Labels <br />", 'vc_extend') => 'field_label', 
                            ),
                  'admin_label' => false,
                  "description" => __("Check the Elements you don't want to show", 'vc_extend'),
                  'group' => __( 'Display', 'vc_extend' ),
              ),
              array(
                  "type" => "checkbox",
                  "holder" => '',
                  "heading" => __("Disable Link", 'vc_extend'),
                  "param_name" => "link",
                  "value" => array( 
                              __("Check if you want to disable name/title linking to member page", 'vc_extend') => '1',
                            ),
                  'admin_label' => false,
                  'group' => __( 'Display', 'vc_extend' ),
              ),
              array(
                  "type" => "dropdown",
                  "holder" => "",
                  "class" => "",
                  "heading" => __("Layout", 'vc_extend'),
                  "param_name" => "layout",
                  "value" => array( __('Grid', 'vc_extend') => 'grid', __('Carousel', 'vc_extend') => 'carousel', __('Filterable', 'vc_extend') => 'filterable' ), 
                  "description" => __("Select from Grid, Carousel or Filterable Display", 'vc_extend'),
                  'admin_label' => false,
                  'group' => __( 'Layout', 'vc_extend' ),
              ),
              array(
                  "type" => "dropdown",
                  "holder" => "",
                  "class" => "",
                  "heading" => __("Columns", 'vc_extend'),
                  "param_name" => "columns",
                  "value" => array( 1,2,3,4,5,6,7,8,9,10,11,12 ), 
                  "description" => __("Select from upto Twelve(12) Columns", 'vc_extend'),
                  'admin_label' => false,
                  'group' => __( 'Layout', 'vc_extend' ),
              ),
              array(
                  "type" => "dropdown",
                  "holder" => "",
                  "class" => "",
                  "heading" => __("Alignment", 'vc_extend'),
                  "param_name" => "align",
                  "value" => array( __('Center') => 'center' ,__('Left') => 'left', __('Right') => 'right', __('Justify') => 'justify' ), 
                  "description" => __("Select text alignment", 'vc_extend'),
                  'admin_label' => false,
                  'group' => __( 'Layout', 'vc_extend' ),
              ),
              array(
                  "type" => "dropdown",
                  "holder" => "",
                  "class" => "",
                  "heading" => __("Social Media Style", 'vc_extend'),
                  "param_name" => "social_view",
                  "value" => array( __('Colored Icons') => 'colored' ,__('Text Link') => 'text', __('Dark Icons') => 'dark', __('Light Icons') => 'light' ), 
                  "description" => __("Select text alignment", 'vc_extend'),
                  'admin_label' => false,
                  'group' => __( 'Layout', 'vc_extend' ),
              ),
            )
          
        ) );
    }

    function vc_create_shortcode( $atts , $content='' ) {
      extract( shortcode_atts( array(
            'vc' => true,
          ), $atts ) );
      if(empty($atts['hide'])){
        unset($atts['hide']);
      }
      $defaults = array( 'ids'       =>  null,
                        'category'    =>  null,
                        'orderby'     =>  null,
                        'order'     =>  null,
                        'position'    =>  'before',
                        'limit'     =>  -1,
                        'link'      =>  null,
                        'layout'      =>  'grid',
                        'columns'     =>  'one',
                        'align'     =>  'center',
                        'social_view'   =>  'colored',
                        'border'      =>  null
                      );
      $num = array('','one','two','three','four','five','six','seven','eight','nine','ten','eleven','twelve');
      $atts['columns'] = $num[ $atts['columns'] ];
      $atts = array_merge($defaults, $atts);
      // print_r($atts);
      $output = '[display-team ';
      foreach ($atts as $key => $value) {
        $output .= ' '. $key .'="'. $value .'"';
      }
      $output .= ' ]';

    return do_shortcode($output);

    }

    /*
    Show notice if your plugin is activated but Visual Composer is not
    */
    public function showVcVersionNotice() {
        $plugin_data = get_plugin_data(__FILE__);
        echo '
        <div class="updated">
          <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431?ref=phpbits" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend'), $plugin_data['Name']).'</p>
        </div>';
    }
}
// Finally initialize code
new VCExtendWPMTPv3();