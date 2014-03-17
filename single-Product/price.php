<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

if( $product->get_price() === '') return;
?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p itemprop="price" class="price"><?php 

/*
WHOLESALE HACK START
- we use the is_wholesale_buyer () and an if statement to check if the user is a wholesale buyer
- if YES - we use show_wholesale_price () to display the wholesale price in the green price flag
- if NO - we display the regular price
*/
	
	if (is_wholesale_buyer ())
	{
		echo "£".show_wholesale_price ($post->ID); ?></p>
		<?php
	}
	
	else 
	{
		echo $product->get_price_html(); 
	}
	
	//END	
	
	 ?></p>

	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />



</div>