<?php
/**
 * @package WordPress
 * @subpackage YIW Themes
 * 
 * Here the first hentry of theme, when all theme will be loaded.
 * On new update of theme, you can not replace this file.
 * You will write here all your custom functions, they remain after upgrade.
 */                                                                               

// include all framework
require_once dirname(__FILE__) . '/core/core.php';

// include the library for the layers slider
require_once dirname(__FILE__) . '/inc/LayerSlider/layerslider.php';

// include the library for the wishlist
require_once dirname(__FILE__) . '/inc/yith_wishlist/init.php';

/*-----------------------------------------------------------------------------------*/
/* End Theme Load Functions - You can add custom functions below */
/*-----------------------------------------------------------------------------------*/

function get_current_user_role() {
	global $wp_roles;
	$current_user = wp_get_current_user();
	$roles = $current_user->roles;
	$role = array_shift($roles);
	return isset($wp_roles->role_names[$role]) ? translate_user_role($wp_roles->role_names[$role] ) : false;
}


function show_wholesale_info ($postID)
{
	$currentRole = get_current_user_role();
	if (is_wholesale_buyer ())
	{
		echo "<h2>".get_post_meta($postID, 'Wholesale Info', true)."</h2>";
	}
	else
	{
		//echo 'Dude youre not a wholesale buyer';
	}
}	

function show_wholesale_price ($postID)
{
	return get_post_meta($postID, 'Wholesale Price', true);
}

function is_wholesale_buyer ()
{
	
	$currentRole = get_current_user_role();
	
	if ($currentRole =='Wholesale Buyer')
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}

}