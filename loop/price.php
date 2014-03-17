<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;



//START
/*
The functions below retrieve the product post and if the logged in user is a
Wholesale Buyer, it displays the wholesale price stored in the product meta 
Wholesale Price
*/

$myPost = $product->get_post_data();
$postID = $myPost->ID;


if (is_wholesale_buyer ())
{?>
	<span class="price">£<?php echo show_wholesale_price ($postID); ?></span>
<?php
}
else
{
	if ($price_html = $product->get_price_html()) : ?>
	<span class="price"><?php echo $price_html; ?></span>
	<?php endif; 
}

//END

?>




<!--
<?php if ( $price_html = $product->get_price_html() ) : ?>
	<span class="price"><?php echo $price_html; ?></span>
<?php endif; ?>

-->