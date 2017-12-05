<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// cropping the images as per the layouts
add_image_size( 'circle-image',210,210, array('center','top') ); // Hard crop top center

// Add Shortcode
function wprm_team_shortcode( $atts ) {

	$setting_post_type =get_option('setting_post_type');
	$setting_section_heading_title =get_option('setting_section_heading_title');
	if($setting_post_type):
	$setting_new_post_type =get_option('setting_new_post_type');
	if($setting_new_post_type):
	$override_post_type =$setting_new_post_type;
	endif;
	else:
	$override_post_type ='team';
	endif;
	
	// Attributes
	extract( shortcode_atts(
		array(
			'layout' => 'Circle',
			'post_per_page' => '-1',
			'team_title' => '<h1 class="dp-team-title">meet <span>the team </span>- Style Default - Listing</h1>',
			'category' =>'',
			'columns' =>4,
		), $atts )
	);
if($category):
	$tax =array(
				array(
				'taxonomy'=>'team-category',
				'field'=>'slug',
				'terms'=>$category,
				),
			);
endif;
	$args =array(
			'post_type'=>$override_post_type,
			'posts_per_page'=>$post_per_page,
			'tax_query'=>$tax
		);	

	$teams = get_posts($args);


if($columns=='') $columns=4;
$grids =array(1=>12,2=>6,3=>4,4=>3,6=>2);

if($layout!='Boxed') $layout_class =' dp-columns';

if($setting_section_heading_title):
$html .='<div class="dp-team">'.$setting_section_heading_title;	
else:	
$html .='<div class="dp-team">'.$team_title;	
endif;
$html .='<div id="circle" class="dp-layout-'. strtolower('circle') .$layout_class.'">';

foreach($teams as $post): setup_postdata( $post );

$feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'boxed');

$team_facebook =get_post_meta( $post->ID,'team_facebook',true);
if($team_facebook) $social_html .='<a href="'.$team_facebook.'" target="blank"><i class="fa fa-facebook"></i></a>';

$team_twitter =get_post_meta( $post->ID,'team_twitter',true);
if($team_twitter) $social_html .='<a href="'.$team_twitter.'" target="blank"><i class="fa fa-twitter"></i></a>';

$team_google =get_post_meta( $post->ID,'team_google',true);
if($team_google) $social_html .='<a href="'.$team_google.'" target="blank"><i class="fa fa-google-plus"></i></a>';

$team_link =get_post_meta( $post->ID,'team_link',true);
if($team_link) $social_html .='<a href="'.$team_link.'" target="blank"><i class="fa fa-linkedin"></i></a>';

$team_pin =get_post_meta( $post->ID,'team_pin',true);
if($team_pin) $social_html .='<a href="'.$team_pin.'" target="blank"><i class="fa fa-pinterest"></i></a>';

$cropped_img =get_post_meta( $post->ID,'team_circle',true);

$html .='<div id="post-'.$post->ID.'" class="dp-col-'.$grids[$columns].'">
	<div class="dp-item-circle">
	<div class="dp-tm-pic-circle"><a href="'. get_permalink($post->ID) .'"><img src="'. $cropped_img[url] .'"></a>
	</div>
	<span class="dp-tm-name"> <a href="'. get_permalink($post->ID) .'"> '. $post->post_title .'</a> </span>
	<span class="dp-tm-position">'. get_post_meta( $post->ID,'team_position',true) .'</span> 
	</div></div>';

unset($social_html);
endforeach ;

$html .='</div>';
$html .='</div>';

wp_enqueue_style( 'Circle-css', plugin_dir_url( __FILE__ ) . '../assets/layouts/Circle.css',false,false );
wp_enqueue_script('team-theme', plugin_dir_url( __FILE__ ) . '../assets/js/team-theme.js',false,false );


return $html;
}
add_shortcode( 'Team-manager', 'wprm_team_shortcode' );
