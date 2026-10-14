<?php
/**
 * ACF Local JSON.
 *
 * Field groups, post types and taxonomies are stored in version-controlled JSON:
 *
 *   acf-json/field-groups/{title-slug}.json   e.g. field-groups/blocks.json
 *   acf-json/post-types/{post-type}.json      e.g. post-types/case-study.json
 *   acf-json/taxonomies/{taxonomy}.json       e.g. taxonomies/case-study-type.json
 *
 * See docs/acf.md.
 *
 * @package Viezo
 */

/**
 * Map of ACF internal post types to their acf-json subfolders.
 *
 * @return array
 */
function vzo__acf_json_folders() {
	return [
		'acf-field-group'     => 'field-groups',
		'acf-post-type'       => 'post-types',
		'acf-taxonomy'        => 'taxonomies',
		'acf-ui-options-page' => 'options-pages',
	];
}

/**
 * Absolute path to an acf-json subfolder.
 *
 * @param string $folder Subfolder name.
 * @return string
 */
function vzo__acf_json_path( $folder = '' ) {
	return untrailingslashit( get_template_directory() . '/acf-json/' . $folder );
}

/**
 * Save each ACF type to its own subfolder.
 *
 * @param array $paths Save paths.
 * @param array $post  ACF field group, post type, taxonomy or options page.
 * @return array
 */
function vzo__acf_json_save_paths( $paths, $post ) {
	$type    = acf_determine_internal_post_type( $post['key'] ?? '' );
	$folders = vzo__acf_json_folders();

	return isset( $folders[ $type ] ) ? [ vzo__acf_json_path( $folders[ $type ] ) ] : [ vzo__acf_json_path() ];
}
add_filter( 'acf/json/save_paths', 'vzo__acf_json_save_paths', 10, 2 );

/**
 * Load JSON from every subfolder.
 *
 * @return array
 */
function vzo__acf_json_load_paths() {
	return array_map( 'vzo__acf_json_path', array_values( vzo__acf_json_folders() ) );
}
add_filter( 'acf/json/load_paths', 'vzo__acf_json_load_paths' );

/**
 * Use readable file names instead of ACF keys.
 *
 * Existing files keep their name, so renaming an item in the admin never leaves an orphaned file.
 *
 * @param string $filename  Default file name ({key}.json).
 * @param array  $post      ACF field group, post type, taxonomy or options page.
 * @param string $load_path Path the item was loaded from, if any.
 * @return string
 */
function vzo__acf_json_file_name( $filename, $post, $load_path ) {
	if ( $load_path ) {
		return basename( $load_path );
	}

	switch ( acf_determine_internal_post_type( $post['key'] ?? '' ) ) {
		case 'acf-post-type':
			$slug = $post['post_type'] ?? '';
			break;
		case 'acf-taxonomy':
			$slug = $post['taxonomy'] ?? '';
			break;
		case 'acf-ui-options-page':
			$slug = $post['menu_slug'] ?? '';
			break;
		default:
			$slug = $post['title'] ?? '';
	}

	$slug = sanitize_title( $slug );

	return $slug ? $slug . '.json' : $filename;
}
add_filter( 'acf/json/save_file_name', 'vzo__acf_json_file_name', 10, 3 );
