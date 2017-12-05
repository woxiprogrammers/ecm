<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.2
 */
 
$shop_columns = ot_get_option('shop_columns');

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

// Store loop count we're currently on.
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid.
if ( empty( $woocommerce_loop['columns'] ) ) {
	if(!$shop_columns){
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	}else{
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $shop_columns );
	}
}

// Increase loop count.
$woocommerce_loop['loop']++;
?>
<li class="product-category product<?php
    if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1)
        echo ' first';
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo ' last';
	if ($woocommerce_loop['columns'] == "2"){
		echo ' col-md-6';
	} elseif ($woocommerce_loop['columns'] == "3"){
		echo ' col-md-4';	
	} elseif ($woocommerce_loop['columns'] == "4"){
		echo ' col-md-3';	
	} else{
		echo ' col-md-3';	
	}
	?>">
	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

		<?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );
		?>

		<h3 class="product-category-title">
			<?php
				echo $category->name;
				
				if($category->count=='1'){
				
					$label = __(' Item', GETTEXT_DOMAIN);
				
				} else{
				
					$label = __(' Items', GETTEXT_DOMAIN);
				
				}
				
				if ( $category->count > 0 )
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <small class="count">('. $category->count . $label . ')</small>', $category );
			?>
		</h3>

		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
</li>
