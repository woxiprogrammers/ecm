<?php
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => __('Main Sidebar', GETTEXT_DOMAIN),
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="title"><span class="align">',
		'after_title' => '</span></h4>',
	));
}
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => __('Footer Top', GETTEXT_DOMAIN),
		'id' => 'sidebar-2',
		'before_widget' => '<div class="col-md-3 one-column"><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="title"><span class="align">',
		'after_title' => '</span></h4>',
	));
}
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => __('Footer', GETTEXT_DOMAIN),
		'id' => 'sidebar-3',
		'before_widget' => '<div class="col-md-3 one-column"><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="title"><span class="align">',
		'after_title' => '</span></h4>',
	));
}
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => __('Portfolio Post Sidebar', GETTEXT_DOMAIN),
		'id' => 'sidebar-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="title">',
		'after_title' => '</h4>',
	));
}
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => __('Shop Sidebar', GETTEXT_DOMAIN),
		'id' => 'sidebar-5',
        'description' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="title"><span class="align">',
		'after_title' => '</span></h4>',
	));
}
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => __('Product Post Sidebar', GETTEXT_DOMAIN),
		'id' => 'sidebar-6',
        'description' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="title"><span class="align">',
		'after_title' => '</span></h4>',
	));
}
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => __('Footer Top 3 Column', GETTEXT_DOMAIN),
		'id' => 'sidebar-7',
		'before_widget' => '<div class="col-md-4 one-column"><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="title"><span class="align">',
		'after_title' => '</span></h4>',
	));
}
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => __('Footer 3 Column', GETTEXT_DOMAIN),
		'id' => 'sidebar-8',
		'before_widget' => '<div class="col-md-4 one-column"><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="title"><span class="align">',
		'after_title' => '</span></h4>',
	));
}
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => __('Visual Composer Sidebar', GETTEXT_DOMAIN),
		'id' => 'sidebar-9',
        'description' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="title"><span class="align">',
		'after_title' => '</span></h4>',
	));
}

?>