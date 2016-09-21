<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

if ( !class_exists( 'Shadower_Dropdown_Walker_Nav_Menu' ) ) {
	
	class Shadower_Dropdown_Walker_Nav_Menu extends Walker_Nav_Menu {
		
		
		/**
		 * Starts the list before the elements are added.
		 *
		 * Adds classes to the unordered list sub-menus.
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 * @link https://developer.wordpress.org/reference/functions/wp_nav_menu/s
		 */
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			
			// Depth-dependent classes.
			$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
			
			if ( $depth == 1 ) {
				$output .= "\n$indent<ul class=\"sub-menu section-menu\">\n";
			} else {
				$output .= "\n$indent<ul class=\"sub-menu\">\n";
			}
	
		}
		
		/**
		 * Start the element output.
		 *
		 * @link https://developer.wordpress.org/reference/classes/walker_nav_menu/start_el/
		 *
		 */
		var $number = 1;
	
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
			$class_names = $value = '';
	
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
	
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
	
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
	
			$output .= $indent . '<li' . $id . $value . $class_names .'>';
	
			// add span with number here
			if ( $depth == 0 ) { // remove if statement if depth check is not required
				$output .= sprintf( '<!--<span>%02s.</span>-->', $this->number++ );
			}
	
			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
	
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
	
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
			
			$data_title = esc_attr( wp_strip_all_tags( $item->title ) );
	
	
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= '<span data-title="'.$data_title.'">'.$args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after.'</span>';
			$item_output .= '</a>';
			$item_output .= $args->after;
	
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}	
		

		/**
		 * Traverse elements to create list from elements.
		 *
		 * @link https://developer.wordpress.org/reference/classes/walker/display_element/
		 *
		 */
		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		
			if ( ! $element ) {
				return;
			}
		 
			$id_field = $this->db_fields['id'];
			$id       = $element->$id_field;
			
			
			if ( $depth == 0 ) {
				$element->classes[] = 'mega-menu';
			}	
			
			
			if ( !empty( $children_elements[$element->$id_field] ) && ( $depth == 1 ) ) {
				$element->classes[] = 'title';
			}
			
			/*
			if ( !empty( $children_elements[$element->$id_field] ) && ( $depth == 0 ) ) {
				$element->classes[] = 'dropdown';
				$element->title .= ' <i class="fa fa-angle-down"></i>';
				
			}
			
			if ( !empty( $children_elements[$element->$id_field] ) && ( $depth > 0 ) ) {
				$element->classes[] = 'dropdown';
				$element->title .= ' <i class="fa fa-angle-right"></i>';
			}
			*/
			 
			
			Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
			
			
		}
			
		
	}
}
