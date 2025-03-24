<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Viezo
 */

/**
 * Returns true if a blog has more than 1 category, else false.
 *
 * @author WebDevStudios
 *
 * @return bool Whether the blog has more than one category.
 */
function vzo__categorized_blog() {
	$category_count = get_transient( 'vzo__categories' );

	if ( false === $category_count ) {
		$category_count_query = get_categories( [ 'fields' => 'count' ] );

		$category_count = isset( $category_count_query[0] ) ? (int) $category_count_query[0] : 0;

		set_transient( 'vzo__categories', $category_count );
	}

	return $category_count > 1;
}

/**
 * Get an attachment ID from it's URL.
 *
 * @author WebDevStudios
 *
 * @param string $attachment_url The URL of the attachment.
 *
 * @return int    The attachment ID.
 */
function vzo__get_attachment_id_from_url( $attachment_url = '' ) {
	global $wpdb;

	$attachment_id = false;

	// If there is no url, return.
	if ( '' === $attachment_url ) {
		return false;
	}

	// Get the upload directory paths.
	$upload_dir_paths = wp_upload_dir();

	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image.
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

		// If this is the URL of an auto-generated thumbnail, get the URL of the original image.
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

		// Remove the upload path base directory from the attachment URL.
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

		// Do something with $result.
		// phpcs:ignore phpcs:ignore WordPress.DB -- db call ok, cache ok, placeholder ok.
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM {$wpdb->posts} wposts, {$wpdb->postmeta} wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = %s AND wposts.post_type = 'attachment'", $attachment_url ) );
	}

	return $attachment_id;
}

/**
 * Shortcode to display copyright year.
 *
 * @author Haris Zulfiqar
 *
 * @param array $atts Optional attributes.
 *     $starting_year Optional. Define starting year to show starting year and current year e.g. 2015 - 2018.
 *     $separator Optional. Separator between starting year and current year.
 *
 * @return string Copyright year text.
 */
function vzo__copyright_year( $atts ) {
	// Setup defaults.
	$args = shortcode_atts(
		[
			'starting_year' => '',
			'separator'     => ' - ',
		],
		$atts
	);

	$current_year = gmdate( 'Y' );

	// Return current year if starting year is empty.
	if ( ! $args['starting_year'] ) {
		return $current_year;
	}

	return esc_html( $args['starting_year'] . $args['separator'] . $current_year );
}

add_shortcode( 'vzo__copyright_year', 'vzo__copyright_year', 15 );

/**
 * Retrieve the URL of the custom logo uploaded, if one exists.
 *
 * @author Corey Collins
 */
function vzo__get_custom_logo_url() {

	$custom_logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $custom_logo_id ) {
		return;
	}

	$custom_logo_image = wp_get_attachment_image_src( $custom_logo_id, 'full' );

	if ( ! isset( $custom_logo_image[0] ) ) {
		return;
	}

	return $custom_logo_image[0];
}


/*
* Callback function to filter the MCE settings
*/

function my_mce_before_init_insert_formats( $init_array ) {

// Define the style_formats array

	$style_formats = array(
/*
* Each array child is a format with it's own settings
* Notice that each array has title, block, classes, and wrapper arguments
* Title is the label which will be visible in Formats menu
* Block defines whether it is a span, div, selector, or inline style
* Classes allows you to define CSS classes
* Wrapper whether or not to add a new block-level element around any selected elements
*/
		array(
			'title' => 'None',
			'block' => 'p',
			'classes' => ''
		),
		array(
			'title' => 'Hightlight',
			'block' => 'div',
			'classes' => 'highlighted',
			'wrapper' => true,

		),
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

function wpb_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');


if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Viezo Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'parent_slug' 	=> 'options-general.php',
		'redirect'		=> false
	));



}


add_action('wpcf7_before_send_mail', 'contactform7_before_send_mail', 10, 3);

function contactform7_before_send_mail( $contact_form, &$abort, $submission ) {

	$listId = get_field('mailchimp_list_id', 'option');
	$apiKey = get_field('mailchimp_api_key', 'option');

	if ( !isset($contact_form->posted_data) && class_exists('WPCF7_Submission') ) {
        $submission = WPCF7_Submission::get_instance();
        if ( $submission ) {
            $formData = $submission->get_posted_data();
        }
    } else {
        // We can't retrieve the form data
        return $contact_form;
    }

	// nothing's here... do nothing...
	if ( empty ($formData)){
		return;
	}

    if ( '_newsletter-form' == $contact_form->title()) {
		$email = strtolower($formData['your-email']);
		//$name = $formData['your-name'];
		$emailHash = md5($email);


		$MailChimp = new DrewM\MailChimp\MailChimp($apiKey);

		$result = $MailChimp->put("lists/$listId/members/$emailHash", [
			'email_address' => $email,
			'status'        => 'subscribed',
			'status_if_new' => 'subscribed',
			//'merge_fields' => [
				//'FNAME' => $name,
			//]
		]);



		if(empty($result)){
			return;
		}
		/*if($result['status']==400){
			//user exists, use PUT to update status
			$result = $MailChimp->post("lists/$listId/members", [
				'email_address' => $email,
				'status'        => 'subscribed',
				'merge_fields' => [
					'FNAME' => $name,
				]
			]);
		}*/


	}
}


function exclude_category_home( $query ) {
	if ( $query->is_home ) {
		$query->set( 'cat', '-7' );
	}
	return $query;
}

add_filter( 'pre_get_posts', 'exclude_category_home' );


/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}


add_filter('wpseo_breadcrumb_output',function($output, $presenter){
	if(!empty($output)){
		$links = [];
		$breadcrumbs = $presenter->breadcrumbs;
		foreach($breadcrumbs as $i => $b){
			if($i == count($breadcrumbs)-1){
				$links[] = '<span class="breadcrumb_last" aria-current="page">'.$b['text'].'</span>';
			}else{
				$links[] = '<a href="'.$b['url'].'">'.$b['text'].'</a>';
			}

		}
		return implode('<span class="sep">/</span>', $links);
	}
	return $output;
}, 99, 2);


add_filter('wp_get_attachment_image_attributes', function($attr, $attachment, $size) {
    //Calculate Image Sizes by type and breakpoint
    //Header Images
    if ($size === 'thumbnail') {
        $attr['sizes'] = '(max-width:320px)33vw,
        (max-width:768px)33vw,
        (max-width:1024px)33vw,
        (max-width:1365px)33vw, 320px';
	}
    return $attr;
}, 10 , 3);


function remove_jquery_migrate( $scripts ) {
   if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
	if ( $script->deps ) {
		// Check whether the script has any dependencies

				$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
 }
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );


add_action( 'admin_menu', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
    remove_menu_page('edit-comments.php');
	add_menu_page('Submitted Forms', 'Submitted Forms', 'administrator', 'admin.php?page=flamingo_inbound', '', '', 2);
}
