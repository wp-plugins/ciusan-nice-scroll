<?php 
/*
Plugin Name: Ciusan Nice Scroll
Plugin URI: http://plugin.ciusan.com/
Description: Nice scrollbars with a very similar ios/mobile style.
Author: Dannie Herdyawan
Version: 1.0
Author URI: http://www.ciusan.com/
*/

/*
   _____                                                 ___  ___
  /\  __'\                           __                 /\  \/\  \
  \ \ \/\ \     __      ___     ___ /\_\     __         \ \  \_\  \
   \ \ \ \ \  /'__`\  /' _ `\ /` _ `\/\ \  /'__'\        \ \   __  \
    \ \ \_\ \/\ \L\.\_/\ \/\ \/\ \/\ \ \ \/\  __/    ___  \ \  \ \  \
     \ \____/\ \__/.\_\ \_\ \_\ \_\ \_\ \_\ \____\  /\__\  \ \__\/\__\
      \/___/  \/__/\/_/\/_/\/_/\/_/\/_/\/_/\/____/  \/__/   \/__/\/__/

*/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'wp_enqueue_scripts', 'CNS_enqueue' );
function CNS_enqueue() {
	wp_enqueue_style('ciusan-nice-scroll', plugin_dir_url( __FILE__ ).'assets/css/ciusan-nice-scroll.css', false);
	wp_enqueue_script('jquery' );
	wp_enqueue_script('ciusan-nice-scroll', plugin_dir_url( __FILE__ ).'assets/js/ciusan-nice-scroll.js', false);
	wp_enqueue_script('nicescroll', plugin_dir_url( __FILE__ ).'assets/js/jquery.nicescroll.min.js', false);
}
add_action('admin_enqueue_scripts', 'CNS_admin_enqueue' );
function CNS_admin_enqueue() {
	wp_enqueue_style('ciusan-admin', plugin_dir_url( __FILE__ ).'assets/css/ciusan-admin.css', false);
	wp_enqueue_script('ciusan-admin', plugin_dir_url( __FILE__ ).'assets/js/ciusan-admin.js', false);
	wp_enqueue_script('jquery' );
	wp_enqueue_style('qtip', plugin_dir_url( __FILE__ ).'assets/css/jquery.qtip.min.css', null, false, false);
	wp_enqueue_script('qtip', plugin_dir_url( __FILE__ ).'assets/js/jquery.qtip.min.js', array('jquery'), false, true);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!function_exists('ciusan_admin__head')){
	function ciusan_admin__head(){
	wp_register_style('ciusan', plugin_dir_url( __FILE__ ).'assets/css/ciusan.css');
		wp_enqueue_style('ciusan');
	wp_register_script('ciusan', plugin_dir_url( __FILE__ ).'assets/js/ciusan.js');
		wp_enqueue_script('ciusan');
	}
}
function CNS_admin__menu(){
	global $menu;
	$main_menu_exists = false;
	foreach ($menu as $key => $value) {
		if($value[2] == 'ciusan-plugin'){
			$main_menu_exists = true;
		}
	}
	if(!$main_menu_exists){
		$ciusan_menu_icon = plugin_dir_url( __FILE__ ).'assets/img/ciusan.png';
		add_object_page(null, 'Ciusan Plugin', null, 'ciusan-plugin', 'ciusan-plugin', $ciusan_menu_icon);
		add_submenu_page('ciusan-plugin', 'Submit a Donation', 'Submit a Donation', 0, 'ciusan-submit-donation', 'ciusan_submit_donation');
	}
	add_submenu_page('ciusan-plugin', 'Ciusan Nice Scroll', 'Nice Scroll', 1, 'ciusan-nice-scroll','Ciusan_NiceScroll');
}
function CNS_admin_init(){
	// Create admin menu and page.
	add_action( 'admin_menu' , 'CNS_admin__menu');
	// Enable admin scripts and styles
	if(function_exists(ciusan_admin__head)){
		add_action( 'admin_enqueue_scripts' , 'ciusan_admin__head');
	}
} add_action('init', 'CNS_admin_init');
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
require ('admin_menu.php');
function Ciusan_NiceScroll(){ 
	echo '<div class="wrap"><h2>Ciusan Nice Scroll</h2>';
	if (isset($_POST['save'])) {
		$options['CSN_Enable'] = trim($_POST['CSN_Enable'],'{}');

		update_option('Ciusan_NiceScroll', $options);
		// Show a message to say we've done something
		echo '<div class="updated ciusan-success-messages"><p><strong>'. __("Settings saved.", "Ciusan").'</strong></p></div>';
	} else {
		$options = get_option('Ciusan_NiceScroll');
	}
	echo Ciusan_NiceScroll_Settings();
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function CiusanNiceScroll(){
	global $options;
	$options = get_option('Ciusan_NiceScroll');

	if($options['CSN_Enable'] == 'on') { ?>
	<!-- Ciusan Nice Scroll -->
<script type="text/javascript" language="javascript">
jQuery(document).ready(function() {
	jQuery("html").niceScroll();
});
</script>
	<!-- Ciusan Nice Scroll -->
<?php }} add_action( 'wp_head', 'CiusanNiceScroll' ); ?>