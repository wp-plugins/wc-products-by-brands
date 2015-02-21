<?php
/*
Plugin Name: WC Products by Brands
Plugin URI: http://northwestmediacollective.com
Description: List WooCommerce products by Brands
Version: 1.2
Author: Travis Buck
Author URI: http://northwestmediacollective.com
License: GPLv3
*/
/*
List WooCommerce Products by Brands
This will list out by brands if you have one 
of the brand plugins installed

Shortcode example [wc_by_brands tags="puma,nike"]
*/
function wc_product_brands_shortcode( $atts ) {

extract(shortcode_atts(array("brands" => '',"limit" => ''), $atts));
ob_start();

$args = array(
'post_type' => 'product',
'posts_per_page' => $limit,
'product_brand' => $brands
);

$loop = new WP_Query( $args );

$product_count = $loop->post_count;

if( $product_count > 0 ) :
echo '<div class="woocommerce columns-4">';
echo '<ul class="products">';

while ( $loop->have_posts() ) : $loop->the_post(); global $product;
global $post;
echo '<li class="product">';
echo '<a href="'. get_permalink().'">';
if (has_post_thumbnail( $loop->post->ID ))
echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
else
echo '<img src="'.$woocommerce->plugin_url().'/assets/images/placeholder.png" alt="" width="'.$woocommerce->get_image_size('shop_catalog_image_width').'px" height="'.$woocommerce->get_image_size('shop_catalog_image_height').'px" />';
echo "<h3>" . $thePostID = $post->post_title. " </h3>";
echo '<span class="price">';
echo '<span class="amount">';
echo woocommerce_get_template( 'loop/price.php' );
echo '</span>';
echo '</span>';
echo '</a>';
echo '<a class="button add_to_cart_button product_type_simple" data-quantity="1" data-product_sku="" data-product_id="40" rel="nofollow" href="'.get_permalink().'">Add to cart</a>';
echo '</li>';
endwhile;
echo '</ul><!--/.products-->';
echo '</div><!-- close woo column -->';
else :
_e('No product matching your criteria.');
endif; // endif no products returned
return ob_get_clean();
}
add_shortcode("wc_by_brands", "wc_product_brands_shortcode"); 