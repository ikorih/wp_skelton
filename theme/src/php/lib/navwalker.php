<?php

class Global_Nav extends Walker_Nav_Menu {
  /**
   * Filter used to remove built in WordPress-generated classes
   * @param  mixed $var The array item to verify
   * @return boolean      Whether or not the item matches the filter
   */
  function filter_builtin_classes( $var ) {
    return ( FALSE === strpos( $var, 'menu-item' ) ) ? $var : '';
  }

  function start_lvl(&$output, $depth = 0, $args = array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent" .'<div class="l-nav__child-toggle"></div>';
    $output .= "\n$indent" . '<div class="l-nav__child-box"><div class="l-nav__child-innr"><ul class="l-nav__child-list">';
  }
  function end_lvl(&$output, $depth = 0, $args = array()) {
    $output .= "\n" .'</ul></div></div>';
  }

  function start_el( &$output, $item, $depth = 0, $args =  array(), $id = 0 ) {
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $class_names = $value = '';
    $unfiltered_classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes = array_filter( $unfiltered_classes, array( $this, 'filter_builtin_classes' ) );
    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $custom_item_class = 'l-nav__item';
    if($depth > 0){
      $custom_item_class = 'l-nav__child-item';
    }
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) .' ' .  $custom_item_class .'"' : ' class="' . $custom_item_class . '"';
    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
    $output .= $indent . '<li '. $class_names . '>';
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
    $item_output = "";
    $item_output .= '<a class="l-nav__link"'. $attributes .'>';
    $item_output .= '<span class="l-nav__title">';
    $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
    $item_output .= '</span>';
    $item_output .= '</a>';
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }


} // Walker_Nav_Menu


