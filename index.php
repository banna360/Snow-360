<?php
/*
Plugin Name: December Snow 360
Plugin URI: http://wordpress.org/extend/plugins/snow360/
Description: A Simple snow plugin for your site. Its December Snow time :)
Author: Hasanul Banna
Version: 1.0
Author URI: http://daxxip.com/
*/



function dx_snow_style() { ?>
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="<?php echo plugins_url();?>/dx-snow-360/jquery.snow.js"></script>
        
        <?php
        //Defaults Snow settings
        $snow_min = 5;
        $snow_max = 50;
        $snow_snowon = 10000;
        $snow_flake_color = '#0099FF';
        
        
        $snow_min = get_option('snow_min');
        $snow_max = get_option('snow_max');
        $snow_snowon = get_option('snow_snowon');
        $snow_flake_color = get_option('snow_flake_color');
        ?>
       
        <script>
        $(document).ready( function(){
                $.fn.snow({ 
                    minSize: <?php echo $snow_min; ?>, 
                    maxSize: <?php echo $snow_max; ?>, 
                    newOn: <?php echo $snow_snowon; ?>, 
                    flakeColor: '<?php echo $snow_flake_color; ?>' });
        });
        </script>


<?php 

}
add_action('wp_head', 'dx_snow_style');


// create custom plugin settings menu
add_action('admin_menu', 'dx_snow_create_menu');

function dx_snow_create_menu() {

	//create new top-level menu
        $plugins_url = plugins_url();
        
	add_menu_page('Snow Options', 'Snow Options', 'add_users', 'dx_snow_settings', 'sw_settings_page', plugins_url( '/dx-snow-360/icon.png' ),3);
	
	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}




function register_mysettings() {
	//register our settings
	register_setting( 'sw-settings-group', 'snow_min' );
	register_setting( 'sw-settings-group', 'snow_max' );
	register_setting( 'sw-settings-group', 'snow_snowon' );
	register_setting( 'sw-settings-group', 'snow_flake_color' );
	
}

function sw_settings_page() {
	
	
?>
<div class="wrap">
<?php screen_icon('users'); ?><h2> December Snow 360 Settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'sw-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Snow Min Size:</th>
        <td><input type="text" name="snow_min" value="<?php echo get_option('snow_min'); ?>" />
            <small > Example: 5</small>
        </td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Snow Max Size:</th>
        <td><input type="text" name="snow_max" value="<?php echo get_option('snow_max'); ?>" />   <small > Example: 50</small></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Snow New on (m.seconds)</th>
        <td><input type="text" name="snow_snowon" value="<?php echo get_option('snow_snowon'); ?>" />   <small > Example: 1000</small></td>
        </tr>
        
         <tr valign="top">
        <th scope="row">Snow Flake Color:</th>
        <td><input type="text" name="snow_flake_color" value="<?php echo get_option('snow_flake_color'); ?>" />   <small > Example: #0099FF</small></td>
        </tr>
					
          
        
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
<?php } ?>