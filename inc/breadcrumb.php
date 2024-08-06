<?php
if (!function_exists('output_breadcrumb')){
	function output_breadcrumb() {
		if ( is_front_page() ) return false;
			$wp_obj = get_queried_object();
			$json_array = array();
			echo '<div class="breadarea">'.
			'<ul class="breadcrumb">'.
			'<li>'.
			'<a href="'. esc_url(home_url()) .'"><span>ホーム</span></a>'.
			'</li>';
			if (is_attachment()) {
				$post_title = apply_filters('the_title', $wp_obj->post_title);
				echo '<li><span>'. esc_html($post_title) .'</span></li>';
			} elseif (is_404()) {
				echo '<li>404 Not Found</li>';
			} elseif (is_single()) {
				$post_id = $wp_obj->ID;
				$post_type = $wp_obj->post_type;
				$post_title = apply_filters('the_title', $wp_obj->post_title);
				if ($post_type !== 'post') {
				$the_tax = "";
								$tax_array = get_object_taxonomies($post_type, 'names');
				foreach ($tax_array as $tax_name) {
					if ($tax_name !== 'post_format') {
						$the_tax = $tax_name;
						break;
					}
				}
				$post_type_link = esc_url( get_post_type_archive_link( $post_type ) );
				$post_type_label = esc_html( get_post_type_object( $post_type )->label );
				echo '<li>'.
				'<a href="'. $post_type_link .'">'.
				'<span>'. $post_type_label .'</span>'.
				'</a>'.
				'</li>';

				$json_array[] = array(
					'id' => $post_type_link,
					'name' => $post_type_label
				);
			} else {
				$the_tax = 'category';
			}
			$terms = get_the_terms($post_id, $the_tax);
			if ($terms !== false) {

				$child_terms = array();
				$parents_list = array();
				foreach ($terms as $term) {
					if ($term->parent !== 0) {
						$parents_list[] = $term->parent;
					}
				}
				foreach ($terms as $term) {
					if (!in_array($term->term_id, $parents_list)) {
						$child_terms[] = $term;
					}
				}
				$term = $child_terms[0];
				if ($term->parent !== 0) {
					$parent_array = array_reverse(get_ancestors( $term->term_id, $the_tax));
					foreach ($parent_array as $parent_id) {
						$parent_term = get_term($parent_id, $the_tax);
						$parent_link = esc_url(get_term_link($parent_id, $the_tax));
						$parent_name = esc_html($parent_term->name );
						echo '<li>'.
						' <a href="'. $parent_link .'">'.
						'<span>'. $parent_name .'</span>'.
						'</a>'.
						'</li>';
						$json_array[] = array(
						'id' => $parent_link,
						'name' => $parent_name
						);
					}
				}
				$term_link = esc_url(get_term_link($term->term_id, $the_tax));
				$term_name = esc_html($term->name);
				echo '<li>'.
				' <a href="'. $term_link .'">'.
				'<span>'. $term_name .'</span>'.
				'</a>'.
				'</li>';
				$json_array[] = array(
				'id' => $term_link,
				'name' => $term_name
				);
			}
			echo '<li><span> '. esc_html(strip_tags($post_title)) .'</span></li>';
		} elseif (is_page() || is_home()) {
			$page_id = $wp_obj->ID;
			$page_title = apply_filters( 'the_title', $wp_obj->post_title );
			if ($wp_obj->post_parent !== 0) {
				$parent_array = array_reverse(get_post_ancestors( $page_id));
				foreach($parent_array as $parent_id) {
					$parent_link = esc_url(get_permalink($parent_id));
					$parent_name = esc_html(get_the_title( $parent_id));
					echo '<li>'.
					'<a href="'. $parent_link .'">'.
					'<span>'. $parent_name .'</span>'.
					'</a>'.
					'</li>';
					$json_array[] = array(
					'id' => $parent_link,
					'name' => $parent_name
					);
				}
			}
			echo '<li><span>'. esc_html(strip_tags($page_title)) .'</span></li>';
		} elseif (is_archive()) {
			$term_id = $wp_obj->term_id;
			$term_name = $wp_obj->name;
			$tax_name = $wp_obj->taxonomy;
			if ($wp_obj->parent !== 0) {
				$parent_array = array_reverse(get_ancestors($term_id, $tax_name));
				foreach($parent_array as $parent_id) {
					$parent_term = get_term($parent_id, $tax_name);
					$parent_link = esc_url(get_term_link($parent_id, $tax_name));
					$parent_name = esc_html($parent_term->name);
					echo '<li>'.
					' <a href="'. $parent_link .'">'.
					'<span>'. $parent_name .'</span>'.
					'</a>'.
					'</li>';
					$json_array[] = array(
					'id' => $parent_link,
					'name' => $parent_name
					);
				}
			}
			$term_label = esc_html(get_post_type_object(get_post_type())->label);
			echo '<li>'.
			' <span>'. $term_label .'</span>'.
			'</li>';
		} else {
			echo '<li><span>'. esc_html(get_the_title()) .'</span></li>';
		}
		echo '</ul>';
		if (!empty( $json_array)) :
			$pos = 1;
			$json = '';
			foreach ($json_array as $data) :
				$json .= '{
				"@type": "ListItem",
				"position": '. $pos++ .',
				"item": {
				"@id": "'. $data['id'] .'",
				"name": "'. $data['name'] .'"
				}
				},';
			endforeach;
			echo '<script type="application/ld+json">{
			"@context": "http://schema.org",
			"@type": "BreadcrumbList",
			"itemListElement": ['. rtrim( $json, ',') .']
			}</script>';
		endif;
		echo '</div>';
	}
}