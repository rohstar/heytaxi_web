<?php

add_action('admin_menu', 'us_add_demo_import_page', 40);

if ( ! function_exists('us_add_demo_import_page'))
{
	function us_add_demo_import_page()
	{
		add_submenu_page( 'us-home', 'Grata: Demo Import', 'Demo Import', 'manage_options', 'us-demo-import', 'us_demo_import' );
	}
}

if ( !function_exists('us_demo_import'))
{
	function us_demo_import()
	{
		?>
		<div class="w-message content" style="display:none;">
			<img src="<?php echo get_template_directory_uri(); ?>/functions/assets/img/spinner.gif" alt="spinner">
			<h1 class="w-message-title">Importing Demo Content...</h1>
			<p class="w-message-text">Please be patient and do not navigate away from this page while the import is in&nbsp;progress. This can take a while if your server is slow (inexpensive hosting).<br>You will be notified via this page when the import is completed.</p>
		</div>

		<div class="w-message success" style="display:none;">
			<h1 class="w-message-title">Import completed successfully!</h1>
			<p class="w-message-text">Now you can see the result at <a href="<?php echo site_url(); ?>" target="_blank">your site</a><br>or start customize via <a href="<?php echo admin_url('themes.php?page=optionsframework'); ?>">Theme Options</a>.
		</div>

		<form class="w-importer" action="?page=us_demo_import" method="post">

			<h1 class="w-importer-title">Choose the Demo which you want to import</h1>

			<div class="w-importer-list">

				<div class="w-importer-item">
					<input class="w-importer-item-radio" id="demo_agency" type="radio" value="agency" name="demo">
					<label class="w-importer-item-preview" for="demo_agency">
						<h2 class="w-importer-item-title">Agency Demo</h2>
						<img src="<?php echo get_template_directory_uri(); ?>/functions/assets/img/demo-1.png" alt="">
					</label>
					<div class="w-importer-item-btn">
						<a class="button" href="http://grata1.us-themes.com/" target="_blank">Preview</a>
					</div>
				</div>
				<div class="w-importer-item">
					<input class="w-importer-item-radio" id="demo_mobile" type="radio" value="mobile" name="demo">
					<label class="w-importer-item-preview" for="demo_mobile">
						<h2 class="w-importer-item-title">Mobile App Demo</h2>
						<img src="<?php echo get_template_directory_uri(); ?>/functions/assets/img/demo-2.png" alt="">
					</label>
					<div class="w-importer-item-btn">
						<a class="button" href="http://grata2.us-themes.com/" target="_blank">Preview</a>
					</div>
				</div>
				<div class="w-importer-item">
					<input class="w-importer-item-radio" id="demo_personal" type="radio" value="personal" name="demo">
					<label class="w-importer-item-preview" for="demo_personal">
						<h2 class="w-importer-item-title">Personal Page Demo</h2>
						<img src="<?php echo get_template_directory_uri(); ?>/functions/assets/img/demo-3.png" alt="">
					</label>
					<div class="w-importer-item-btn">
						<a class="button" href="http://grata3.us-themes.com/" target="_blank">Preview</a>
					</div>
				</div>
				<div class="w-importer-item">
					<input class="w-importer-item-radio" id="demo_event" type="radio" value="event" name="demo">
					<label class="w-importer-item-preview" for="demo_event">
						<h2 class="w-importer-item-title">Event Demo</h2>
						<img src="<?php echo get_template_directory_uri(); ?>/functions/assets/img/demo-4.png" alt="">
					</label>
					<div class="w-importer-item-btn">
						<a class="button" href="http://grata4.us-themes.com/" target="_blank">Preview</a>
					</div>
				</div>
				<div class="w-importer-item">
					<input class="w-importer-item-radio" id="demo_startup" type="radio" value="startup" name="demo">
					<label class="w-importer-item-preview" for="demo_startup">
						<h2 class="w-importer-item-title">Startup Demo</h2>
						<img src="<?php echo get_template_directory_uri(); ?>/functions/assets/img/demo-5.png" alt="">
					</label>
					<div class="w-importer-item-btn">
						<a class="button" href="http://grata4.us-themes.com/" target="_blank">Preview</a>
					</div>
				</div>

			</div>

			<div class="w-importer-options">

				<div class="w-importer-option theme-options">
					<label class="w-importer-option-check">
						<input id="demo_content" type="checkbox" value="ON" name="demo_content" checked="checked">
						<span class="w-importer-option-title">Import Demo Content</span>
					</label>
				</div>
				<div class="w-importer-option theme-options">
					<label class="w-importer-option-check">
						<input id="theme_options" type="checkbox" value="ON" name="theme_options" checked="checked">
						<span class="w-importer-option-title">Import Theme Options</span>
					</label>
				</div>
				<div class="w-importer-option rev-slider">
					<label class="w-importer-option-check">
						<input id="rev_slider" type="checkbox" value="ON" name="rev_slider"<?php if ( ! class_exists('RevSlider')) { echo ' disabled="disabled"'; }?>>
						<span class="w-importer-option-title">Import Revolution Sliders</span> <span class="w-importer-option-desc">(available for Agency Demo only)</span>
					</label>
				</div>

				<?php if ( ! class_exists('RevSlider')) echo '<div class="w-importer-note"><p><strong>Revolution Slider</strong> plugin is not active. Please activate it if you want Sliders to be imported.</p></div>'; ?>

				<div class="w-importer-note">
					<strong>Important Notes:</strong>
					<ol>
						<li>We recommend to run Demo Import on a clean WordPress installation.</li>
						<li>To reset your installation we recommend <a href="http://wordpress.org/plugins/wordpress-database-reset/" target="_blank">Wordpress Database Reset</a> plugin.</li>
						<li>The Demo Import will not import the images we have used in our live demos, due to copyright / license reasons.</li>
						<li>Do not run the Demo Import multiple times one after another, it will result in double content.</li>
					</ol>
				</div>

				<input type="hidden" name="action" value="perform_import">
				<input class="button-primary size_big" type="submit" value="Import" id="import_demo_data">

			</div>

		</form>
		<script>
			jQuery(document).ready(function(){
				var import_running = false;
				jQuery('#import_demo_data').click(function(){
					if (import_running) return false;
					jQuery("html, body").animate({
						scrollTop: 0
					}, {
						duration: 300
					});
					var demo = jQuery('input[name=demo]:checked').val() || 'agency',
						importQueue = [],
						processQueue = function(){
							if (importQueue.length != 0){
								// Importing something
								var importAction = importQueue.shift();
								jQuery.ajax({
									type: 'POST',
									url: '<?php echo admin_url('admin-ajax.php'); ?>',
									data: {
										action: importAction,
										demo: demo
									},
									success: processQueue
								});
							}
							else {
								// Import is completed
								jQuery('.w-message.content, .w-message.options, .w-message.sliders').slideUp();
								jQuery('.w-message.success').slideDown();
								import_running = false;
							}


						};
					if (jQuery('#demo_content').is(':checked')) importQueue.push('us_demo_import_content');
					if (jQuery('#theme_options').is(':checked')) importQueue.push('us_demo_import_options');
					if (jQuery('#rev_slider').is(':checked') && demo == 'agency') importQueue.push('us_demo_import_sliders');

					if (importQueue.length == 0) return false;

					import_running = true;
					jQuery('.w-importer').slideUp(null, function(){
						jQuery('.w-message.content').slideDown();
					});

					processQueue();

					return false;
				});
			});
		</script>
		<?php
	}

	// Content Import
	function us_demo_import_content(){
		set_time_limit(0);

		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

		require_once(get_template_directory().'/vendor/wordpress-importer/wordpress-importer.php');

		//select which files to import
		$aviable_demos = array ('agency', 'mobile', 'personal', 'event', 'startup', );
		$demo_version = 'agency';
		if (in_array($_POST['demo'], $aviable_demos)) {
			$demo_version = $_POST['demo'];
		}


		$wp_import = new WP_Import();
		$wp_import->fetch_attachments = true;

		ob_start();
		$wp_import->import(get_template_directory().'/xml/'.$demo_version.'.xml');
		ob_end_clean();

		// Set menu
		$locations = get_theme_mod('nav_menu_locations');
		$menus  = wp_get_nav_menus();

		if(!empty($menus))
		{
			foreach($menus as $menu)
			{
				if(is_object($menu) && $menu->name == 'Grata Main Menu')
				{
					$locations['grata-main-menu'] = $menu->term_id;
				}
			}
		}

		set_theme_mod('nav_menu_locations', $locations);

		//Set Front Page
		$front_page = get_page_by_title('Grata Home');

		if(isset($front_page->ID)) {
			update_option('show_on_front', 'page');
			update_option('page_on_front',  $front_page->ID);
		}

		echo 'ok';
		die();

	}

	add_action('wp_ajax_us_demo_import_content', 'us_demo_import_content');

	//Import Options
	function us_demo_import_options()
	{
		//select which files to import
		$aviable_demos = array ('agency', 'mobile', 'personal', 'event', 'startup', );
		$demo_version = 'agency';
		if (in_array($_POST['demo'], $aviable_demos)) {
			$demo_version = $_POST['demo'];
		}

		$smof_data = unserialize(base64_decode(file_get_contents(get_template_directory().'/xml/'.$demo_version.'_options.txt'))); //100% safe - ignore theme check nag
		of_save_options($smof_data);
		us_save_styles($smof_data);

		echo 'ok';
		die();
	}

	add_action('wp_ajax_us_demo_import_options', 'us_demo_import_options');

	//Import Slider
	function us_demo_import_sliders()
	{
		//select which files to import
		$aviable_demos = array ('agency', 'mobile', 'personal', 'event', 'startup', );
		$demo_version = 'agency';
		if (in_array($_POST['demo'], $aviable_demos)) {
			$demo_version = $_POST['demo'];
		}

		ob_start();
		$_FILES["import_file"]["tmp_name"] = get_template_directory().'/xml/agency_rs_home.zip';

		$slider = new RevSlider();
		$response = $slider->importSliderFromPost();

		unset($slider);

		$_FILES["import_file"]["tmp_name"] = get_template_directory().'/xml/agency_rs_portfolio.zip';

		$slider = new RevSlider();
		$response = $slider->importSliderFromPost();
		ob_end_clean();

		echo 'ok';
		die();
	}

	add_action('wp_ajax_us_demo_import_sliders', 'us_demo_import_sliders');
}
