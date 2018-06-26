<?php
/*
Plugin Name: PMPro Development Tools
Plugin URI:
Description: Make PMPro development faster
Version: 0.1
Author: Hersha Venkatesh
Author URI:
*/

//Stripe
define('DEV_PMPRO_STRIPE_SECRETKEY', '');
define('DEV_PMPRO_STRIPE_PUBLISHABLEKEY', '');

//PAYFLOW
define('DEV_PMPRO_PAYFLOW_PARTNER', '');
define('DEV_PMPRO_PAYFLOW_PWD', '');
define('DEV_PMPRO_PAYFLOW_USER', '');
define('DEV_PMPRO_PAYFLOW_VENDOR', '');

//2CHECKOUT
define('DEV_PMPRO_TWOCHECKOUT_ACCOUNTNUMBER', '');
define('DEV_PMPRO_TWOCHECKOUT_APIPASSWORD', '');
define('DEV_PMPRO_TWOCHECKOUT_APIUSERNAME', '');
define('DEV_PMPRO_TWOCHECKOUT_SECRETWORD', '');

//AUTH.NET
define('DEV_PMPRO_TRANSACTIONKEY', '');
define('DEV_PMPRO_LOGINNAME', '');

//PAYPAL PRO, EXPRESS, STANDARD
define('DEV_PMPRO_GATEWAY_EMAIL', '');
define('DEV_PMPRO_APIPASSWORD', '');
define('DEV_PMPRO_APISIGNATURE', '');
define('DEV_PMPRO_APIUSERNAME', '');
define('DEV_PMPRO_PAYPALEXPRESS_SKIP_CONFIRMATION', '1');

define('DEV_PMPRO_GATEWAY_ENVIRONMENT', 'sandbox');

//Your IP Address
define('DEV_IPV4', '');
define('DEV_IPV6', '');

function pmprodev_ip_match()
{
	 $ip = $_SERVER['REMOTE_ADDR'];

	 if($ip == DEV_IPV4 || $ip == DEV_IPV6)
		  return true;
	 else
		  return false;
}

function auto_fill_pmpro_checkout_data()
{
//	 if(pmprodev_ip_match()) {
?>
<a href ="#fill" id = "auto_fill">Fill User & Checkout Data</a>
	<script>
		jQuery(document).ready(function() {

			//From: http://stackoverflow.com/questions/1026069/how-do-i-make-the-first-letter-of-a-string-uppercase-in-javascript
			String.prototype.capitalize = function() {
				return this.charAt(0).toUpperCase() + this.slice(1);
			}

			jQuery('#auto_fill').click(function() {

				jQuery.ajax({
					url: 'https://randomuser.me/api/?nat=us',	//only US Identities
					dataType: 'json',
					success: function(data) {
						results = data.results[0];
						console.log(data);

						jQuery('#username').val(results.login.username);
						jQuery('#password').val('x');
						jQuery('#password2').val('x');
						jQuery('#bemail').val(results.email);
						jQuery('#bconfirmemail').val(results.email);

						jQuery('#bfirstname').val(results.name.first.capitalize());
						jQuery('#blastname').val(results.name.last.capitalize());
						jQuery('#baddress1').val(results.location.street);
						jQuery('#bcity').val(results.location.city.capitalize());
						jQuery('#bstate').val(results.location.state.capitalize());
						jQuery('#bzipcode').val(results.location.postcode);
						jQuery('#bphone').val(results.cell);

						//TODO: use Ajax to get different test credit card numbers for each gateway
						jQuery('#AccountNumber').val("4242424242424242");
						jQuery('#ExpirationYear').val('2020');
						jQuery('#CVV').val('111');
					}
				});
			});
		});


	</script><?php
//	 }
}

add_action('pmpro_checkout_after_level_cost', 'auto_fill_pmpro_checkout_data');

function pmprodev_option_pmpro_gateway_environment($option)
{
	if(!is_admin() && pmprodev_ip_match())
		$option = DEV_PMPRO_GATEWAY_ENVIRONMENT;

	return $option;
}
add_filter( 'option_pmpro_gateway_environment', 'pmprodev_option_pmpro_gateway_environment' );


//Stripe
function pmpro_stripe_publishkey($option)
{
	 if(!is_admin() && pmprodev_ip_match())
	 	$option = DEV_PMPRO_STRIPE_PUBLISHABLEKEY;

	 return $option;
}

add_filter( 'option_pmpro_stripe_publishablekey', 'pmpro_stripe_publishkey' );

function pmpro_stripe_secretkey($option)
{
	 if(!is_admin() && pmprodev_ip_match())
		$option = DEV_PMPRO_STRIPE_SECRETKEY;

	 return $option;
}

add_filter( 'option_pmpro_stripe_secretkey', 'pmpro_stripe_secretkey' );

//PayPal Pro, Standard, Express
function pmprodev_option_pmpro_gateway_email($option)
{
	//wp_cache_delete('pmpro_gateway_email', 'options'); -> do we need to use this function?
	//https://wordpress.stackexchange.com/questions/100040/can-i-force-get-option-to-go-back-to-the-db-instead-of-cache
	 if(!is_admin() && pmprodev_ip_match())
		$option = DEV_PMPRO_GATEWAY_EMAIL;

	 return $option;
}

add_filter( 'option_pmpro_gateway_email', 'pmprodev_option_pmpro_gateway_email' );


function pmprodev_option_pmpro_apipassword($option)
{
	 if(!is_admin() && pmprodev_ip_match())
		$option = DEV_PMPRO_APIPASSWORD;

	 return $option;
}

add_filter( 'option_pmpro_apipassword', 'pmprodev_option_pmpro_apipassword' );

function pmprodev_option_pmpro_apisignature($option)
{
	 if(!is_admin() && pmprodev_ip_match())
		$option = DEV_PMPRO_APISIGNATURE;

	 return $option;
}

add_filter( 'option_pmpro_apisignature', 'pmprodev_option_pmpro_apisignature' );

function pmprodev_option_pmpro_apiusername($option)
{
	 if(!is_admin() && pmprodev_ip_match())
		$option = DEV_PMPRO_APIUSERNAME;

	 return $option;
}

add_filter( 'option_pmpro_apiusername', 'pmprodev_option_pmpro_apiusername' );

function pmprodev_option_pmpro_paypalexpress_skip_confirmation($option)
{
	 if(!is_admin() && pmprodev_ip_match())
		$option = DEV_PMPRO_PAYPALEXPRESS_SKIP_CONFIRMATION;

	 return $option;
}

add_filter( 'option_pmpro_paypalexpress_skip_confirmation', 'pmprodev_option_pmpro_paypalexpress_skip_confirmation' );

//Payflow
function pmprodev_option_pmpro_payflow_partner($option)
{
	 if(!is_admin()&& pmprodev_ip_match())
		$option = DEV_PMPRO_PAYFLOW_PARTNER;

	 return $option;
}

add_filter( 'option_pmpro_payflow_partner', '' );

function pmprodev_option_pmpro_payflow_pwd($option)
{
	 if(!is_admin()&& pmprodev_ip_match())
		$option = DEV_PMPRO_PAYFLOW_PWD;

	 return $option;
}

add_filter( 'option_pmpro_payflow_pwd', 'pmprodev_option_pmpro_payflow_pwd' );

function pmprodev_option_pmpro_payflow_user($option)
{
	 if(!is_admin()&& pmprodev_ip_match())
		$option = DEV_PMPRO_PAYFLOW_USER;

	 return $option;
}

add_filter( 'option_pmpro_payflow_user', 'pmprodev_option_pmpro_payflow_user' );

function pmprodev_option_pmpro_payflow_vendor($option)
{
	 if(!is_admin()&& pmprodev_ip_match())
		$option = DEV_PMPRO_PAYFLOW_VENDOR;

	 return $option;
}

add_filter( 'option_pmpro_payflow_vendor', 'pmprodev_option_pmpro_payflow_vendor' );

//Auth.net
function pmprodev_option_pmpro_transactionkey($option)
{
	 if(!is_admin()&& pmprodev_ip_match())
		$option = DEV_PMPRO_TRANSACTIONKEY;

	 return $option;
}

add_filter( 'option_pmpro_transactionkey', 'pmprodev_option_pmpro_transactionkey' );

function pmprodev_option_pmpro_loginname($option)
{
	 if(!is_admin()&& pmprodev_ip_match())
		$option = DEV_PMPRO_LOGINNAME;

	 return $option;
}

add_filter( 'option_pmpro_loginname', 'pmprodev_option_pmpro_loginname' );
