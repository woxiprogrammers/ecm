<?php

// v1.3.6

function vc_blockquote_func( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'cite' => '',
      'bc_align' => ''
   ), $atts ) );
   
   
	if ( empty( $bc_align ) ) {
		$bc_align = 'left';
	}
 
   $content = wpb_js_remove_wpautop($content); // fix unclosed/unwanted paragraph tags in $content
   
	$out = '';
	$pull_right = '';
	
	if($bc_align=="right"){
		$pull_right = 'class="pull-right"';
	}
    $out .= '<blockquote '.$pull_right.'><p>'.$content.'</p>';
    if($cite){
    $out .= '<small><cite title="'. $cite .'" >'. $cite .'</cite></small></blockquote>';
    }else{
    $out .= '</blockquote>';
    }
    return $out;
}
add_shortcode( 'vc_blockquote', 'vc_blockquote_func' );


vc_map(array(
   "name" => __("Blockquote", GETTEXT_DOMAIN),
   "base" => "vc_blockquote",
   "class" => "",
   "icon" => "icon-wpb-lpd",
   "category" => __('Content', GETTEXT_DOMAIN),
   'admin_enqueue_js' => "",
   'admin_enqueue_css' => array(get_template_directory_uri().'/functions/vc/assets/vc_extend.css'),
   "params" => array(
		array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Cite", GETTEXT_DOMAIN),
			 "param_name" => "cite",
			 "value" => "",
			 "description" => __("Someone famous Source Title.", GETTEXT_DOMAIN)
		),
		array(
			"type" => "dropdown",
			"heading" => __("Blockquote position", GETTEXT_DOMAIN),
			"param_name" => "bc_align",
			"value" => array(__('Left', GETTEXT_DOMAIN) => "left", __('Right', GETTEXT_DOMAIN) => "right"),
			"description" => __("Select blockquote align.", GETTEXT_DOMAIN)
		),
		array(
			 "type" => "textarea",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Content", GETTEXT_DOMAIN),
			 "param_name" => "content",
			 "value" => "",
			 "description" => __("Enter your content.", GETTEXT_DOMAIN)
		)
   )
));

?>