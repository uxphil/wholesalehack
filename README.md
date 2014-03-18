wholesalehack
=============

A hack to enable wholesale pricing to be displayed to signed in wholesale customers on wordpress woocommerce

------------------
TO DISPLAY WHOLESALE PRICES IN WOOCOMMERCE SHOP
------------------

I've put together the manual for this hack, after I had a client needing to be able to 
sell retail as well as wholesale, but most importantly the ability to display different
prices in the shop / product overview for retail customers and wholesale customers.

Currently all wholesale plugins only support applying a discount in the shopping cart, which 
means that the wholesale customers have to view retail prices and only in the cart see the
wholesale price.

The hack below solves that problem.

----------------------------------------
REQUIRED PLUGINS
----------------------------------------

Dynamic Pricing
http://www.woothemes.com/products/dynamic-pricing/

----------------------------------------
OPTIONAL PLUGINS
----------------------------------------

WooCommerce CSV Importer Suite
http://www.woothemes.com/products/product-csv-import-suite/

- Not strictly required, but makes updating products a lot easier because you can 
bulk manage your products from a spreadsheet

----------------------------------------
Files modified
----------------------------------------
maya/functions.php

maya/woocommerce/single-product/price.php

maya/woocommerce/single-product/short-description.php

maya/woocommerce/loop/price.php

----------------------------------------
WHERE ARE THE PRICES CREATED & STORED
----------------------------------------

1) the wholesale price is stored in the products spreadsheet

2) from the wholesale price you calculate the retail price.  This is the regular
price that is stored for each product and displayed for non wholesale customers

It's calculated:  Retail price = Wholesale price x 250% or any other value preferred

3) the wholesale price is stored in the product as a custom field called "Wholesale Price"

4) the wholesale price is uploaded as a meta data / custom field

5) we also store custom wholesale info "Wholesale Info" (e.g. Wholesale min order: 2 items) 
as a custom field and upload it for each product.  This info is only displayed to logged in 
wholesale users

----------------------------------------
HOW ARE THE WHOLESALE DISCOUNTS APPLIED TO WOOCOMMERCE
----------------------------------------

- we use the dynamic pricing plugin to calculate the price discount based off the retail price

- in woocommere > dynamic pricing > category > advanced category pricing

	we set the following per category 
		* min order  
		* price discount
		
	since the min order amount & price discounts are the same for a number of categories 
	we set those as two rules
		min order 2 + discount 60%
		min order 3 + discount 60%
		
- to calculate the percentage discount we use the following formula
	
	(1-(1 / Retail markup))*100
	
	For example
	
	(1-(1 / 2.5) * 100 = 60
	

----------------------------------------
HOW ARE THE PRICES DISPLAYED
----------------------------------------

***1) there are 4 functions that have been added to the functions.php file inside the maya theme (maya/functions.php)

>> get_current_user_role() 
	
	returns the current user role
	if logged in it returns FALSE	
	
>> show_wholesale_info ($postID)

	Displays the Wholesale Info (e.g. Wholesale min order: 2 items)

>> show_wholesale_price ($postID)
	
	Returns the Wholesale Price stored in the custom field
	
>> is_wholesale_buyer ()

	checks whether the current user is a wholesale customer


***2) the functions are applied in the following pages

-------
SINGLE PRODUCT OVERVIEW PAGE (PRICE): maya/woocommerce/single-product/price.php
-------

- we use the is_wholesale_buyer () and an if statement to check if the user is a wholesale buyer

- if YES - we use show_wholesale_price () to display the wholesale price in the green price flag

- if NO - we display the regular price


-------
SINGLE PRODUCT OVERVIEW PAGE (INFO): maya/woocommerce/single-product/short-description.php
-------

- we use the function show_wholesale_info ($postID) to display the wholesale info (e.g. Wholesale min order: 2 items)


-------
PRODUCT THUMBNAIL IN CATALOGUES / CATEGORIES: maya/woocommerce/loop/price.php
-------

- we get the post data via the product functions

- we use the is_wholesale_buyer () and an if statement to check if the user is a wholesale buyer

- if YES - we use show_wholesale_price () to display the wholesale price in the green price flag

- if NO - we display the regular price
