<?php
/*
Plugin Name: Wordpress FrontPage Banner
Plugin URI: http://rcanblog.com/projects/
Version: 1.1.4
Description: Use this plugin to display/Insert PHP, HTML, JavaScript, Announcements, Video's, Google Adsense or any other ads (affiliate/referrals) on your blog's frontpage. Frontpage is a prime space for any website/blog, use this plugin to increase your blog's advertisement scope. You can also post some announcements linking to page/post's, It will help to reduce your site's bouncing rate.
Author: devcorn
Author URI: http://rcanblog.com
*/
if (!function_exists ('add_action')) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}

	if(!get_option('fpb_st'))
	update_option('fpb_st','true');
	
	add_action('admin_menu', 'Gwp_fpb_adminmenu');
	add_action('the_post', 'Gwp_fpb_display');
	
	
	function Gwp_fpb_adminmenu()
	{
		//admin menu
		$fpb_hook = add_menu_page('FrontPageBanner Plugin Settings', 'FPB Settings', 'manage_options', frontpagebanner, 'Gwp_fpb_settings');
			//calling register settings
		add_action( 'admin_init', 'register_Gwpfpbsettings' );
		
	}
	
		//function register
	function register_Gwpfpbsettings()
	{
		//register settings
		
		register_setting('Gwp-fpb-settings-group','Gwp_fpb_option_code');
		register_setting('Gwp-fpb-settings-group','Gwp_fpb_option_style');
		register_setting('Gwp-fpb-settings-group','Gwp_fpb_option_radio');
		register_setting('Gwp-fpb-settings-group','Gwp_fpb_option_check');
		register_setting('Gwp-fpb-settings-group','Gwp_fpb_option_php');
		register_setting('Gwp-fpb-settings-group','Gwp_fpb_option_fix');
		register_setting('Gwp-fpb-settings-group','fpb_st');
	}
	//function fpbsettings
	function Gwp_fpb_settings()
	{
	
		//Admin Menu Starts
?>
	<div class="wrap">
		<h2>FrontPageBanner Plugin Settings</h2>
		<?php
			if ( isset($_GET['settings-updated']) )
			{
		?>
	<div class="updated"><p><strong><?php _e('Settings saved.'); ?></strong></p></div>
<?php 
	}
?>
	<form method="post" action="options.php">
	 <?php settings_fields( 'Gwp-fpb-settings-group' ); ?>
		<table class="form-table">
		<tr valign="top">
		<th scope="row">Default Style</th>
		<td>
			<input type="radio" name= "Gwp_fpb_option_radio" value= "Plain" <?php if (get_option('Gwp_fpb_option_radio') == 'Plain') echo "checked='checked'";?>/> Plain
			<input type="radio" name= "Gwp_fpb_option_radio" value= "Media" <?php if (get_option('Gwp_fpb_option_radio') == 'Media') echo "checked='checked'";?>/> Media (Ads,Adsense,Image,Video,Flash,Javascript etc)
		</td>
		</tr>
		<tr valign="top">
			<th scope="row">Enable PHP <strong>*</strong></th></br>
		<td>
			<input type="checkbox" name="Gwp_fpb_option_php" value="true" <?php if (get_option('Gwp_fpb_option_php')) echo "checked='checked'";?>"/> Execute PHP in custom code
		</td>
		<tr valign="top">
			<th scope="row">Custom code</th>
		<td>
			<textarea name="Gwp_fpb_option_code" rows="4" cols="50"><?php echo get_option('Gwp_fpb_option_code'); ?></textarea>
		</td>
		</tr>
		<tr valign="top">
			<th scope="row">Enable Custom Style Sheet<strong> *</strong></th></br>
		<td>
			<input type="checkbox" name="Gwp_fpb_option_check" value="true" <?php if (get_option('Gwp_fpb_option_check')) echo "checked='checked'";?>/> define your own custom style ( please refer <a href="http://rcanblog.com/projects/#wpfpbhelp"> help docs </a>)
		</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Custom stylesheet<strong> *</strong></th>
		<td>
			<textarea name="Gwp_fpb_option_style" rows="4" cols="50"><?php echo get_option('Gwp_fpb_option_style'); ?></textarea>
		</td>
		</tr>
		<tr valign="top">
			<th scope="row"><strong>Plugin Broken *</strong></th></br>
		<td>
			<input type="checkbox" name="Gwp_fpb_option_fix" value="true" <?php if (get_option('Gwp_fpb_option_fix')) echo "checked='checked'";?>/> Check ONLY if plugin is broken with your theme (Twenty Ten, etc) <a href="http://rcanblog.com/wordpress-frontpagebanner-support-426/">Comment here for issues</a>
		</td>
		</tr>
		<input type="hidden" name="fpb_st" value="false" />
		<tr valign="top">
			<th scope="row"><strong>* For Advance users only </strong></th>
			<td></td>
			</tr>
		  </table>
		<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
	<div class="updated"><strong>Powerful Wordpress Optimized Servers ,Discounted Domains and Outstanding support . Consider <a href="http://expressin.net">eXpressin.net</a> </strong></div>
	<p><strong>About Frontpage Banner Plugin</strong> - Simple, lightweight and very powerful plugin. Use this plugin to display/insert <strong>PHP</strong>, HTML , JavaScript, announcements, Video's, adsense, affiliate/referral marketing or any third party ads like (buysellads.com) on your blog's frontpage. It has a very simple interface, please refer the help docs to learn how to use. </p>
	<p><a href="http://rcanblog.com/projects/#wpfpb">Plugin Home</a> | <a href="http://rcanblog.com/projects/#wpfpbhelp">Help Docs</a> | <a href="http://rcanblog.com/wordpress-frontpagebanner-support-426/">Ask Questions</a> | <a href="http://feedburner.google.com/fb/a/mailverify?uri=rcanblog&amp;loc=en_US">Email Updates</a> | <a href="http://twitter.com/rcanblog">Twitter</a> | <a href="http://twitter.com/home?status=Wordpress+FrontPageBanner+plugin+is+awesome%2C+check+this+out+http%3A%2F%2Frcanblog.com%2Fprojects%23wpfpb+%23wordpress+%23wordpressplugin+%23adsense">Spread the Word</a> | <a href="http://rcanblog.com/projects#hireme">Hire me (Wordpress Expert)</a></p>
	</div>
<?php
	//function
	}
?>
<?php
	//default stylesheet 
	function Gwp_fpb_stylesheet()
	{
		echo '
			<style>
			.fpb_media
			{
				padding: 5px;
				margin: 5;
			}
			.fpb_plain
			{
				background: #F3F3F2; padding:5px; margin:3px; border:1px solid #E3E1DB;
			}
			</style>
		';
	}
	
	//generate the final code
	function Gwp_fpb_generate()
	{
	?>
	
		<div class="<?php if (get_option('Gwp_fpb_option_radio') == 'Plain') echo 'fpb_plain'; else echo 'fpb_media';?>">
		<?php
			$code = get_option('Gwp_fpb_option_code');
			if (get_option('Gwp_fpb_option_php'))
			{
				ob_start();
				eval('?>'.$code);
				$code = ob_get_contents();
				ob_end_clean();
				echo $code;
			}
			else
			{
				echo $code;
			}
		?>
		</div>
	
	<?php
	}
	
	function Gwp_fpb_display()
	{
		
		if(get_option('Gwp_fpb_option_fix'))
				{
				if (is_front_page() && did_action(the_post)==2)
		{
			if (get_option('Gwp_fpb_option_check'))
			{
				$customstyle= get_option('Gwp_fpb_option_style');
				echo $customstyle.Gwp_fpb_generate();
			}
			else
			{
				echo Gwp_fpb_stylesheet().Gwp_fpb_generate();
			}
		}
		}
		else
		{
		if (is_front_page() && did_action(the_post)<=1)
		{
			if (get_option('Gwp_fpb_option_check'))
			{
				$customstyle= get_option('Gwp_fpb_option_style');
				echo $customstyle.Gwp_fpb_generate();
			}
			else
			{
				echo Gwp_fpb_stylesheet().Gwp_fpb_generate();
			}
		} }
		
	}
	function fpb_new()
	{
		add_option( 'fpb_st', 'true', '', 'yes' );
	}
	function fpb_ext()
	{
		delete_option('fpb_st');
	}
	function fpb_text(){
		if(get_option('fpb_st')=='true')
		{
			$pluginurl = admin_url();
			if ( preg_match( '/^https/', $pluginurl ) && !preg_match( '/^https/', get_bloginfo('url') ) )
			$pluginurl = preg_replace( '/^https/', 'http', $pluginurl );
			echo '<div class="error" ><p><strong>Thanks for updating Wordpress Frontpage Banner Plugin, I am all set for next big version (V1.2) with lots of flexibility and power, Stay tuned....will be released as soon as Wordpress 3.2 comes { *** <a href="http://rcanblog.com">CHECK PLUGIN HELP DOCS AND FREE SUPPORT</a> *** } or <a href="'.$pluginurl.'admin.php?page=frontpagebanner">go to the admin page and configure it</a></div>';
		}
	}
	register_deactivation_hook ( __FILE__, 'fpb_ext' );
	add_action('admin_notices', 'fpb_text');
	register_activation_hook( __FILE__, 'fpb_new' );
?>