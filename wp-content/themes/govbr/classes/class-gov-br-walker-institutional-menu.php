<?php
/**
 * Class for custom menu walker
 *
 * This file is used to define a custom menu walker, with custom css classes.
 *
 * @link https://developer.wordpress.org/reference/classes/walker_nav_menu/
 *
 * @since 0.1.0
 */

if (!class_exists('Gov_BR_Walker_Institutional_Menu')) {
    /**
     * Class for custom menu walker.
     *
     * This class is used to define a custom menu walker, with custom css classes.
     *
     * @since 0.1.0
     */
    class Gov_BR_Walker_Institutional_Menu extends \Walker_Nav_Menu
    {


        /**
         * Starts the list before the elements are added.
         *
         * @since 3.0.0
         *
         * @see Walker::start_lvl()
         *
         * @param string   $output Used to append additional content (passed by reference).
         * @param int      $depth  Depth of menu item. Used for padding.
         * @param stdClass $args   An object of wp_nav_menu() arguments.
         */
        public function start_lvl(&$output, $depth = 0, $args = null)
        {
            if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
                $t = '';
                $n = '';
            } else {
                $t = "\t";
                $n = "\n";
            }
            $indent = str_repeat($t, $depth);

            if($depth == 0){
                // Default class.
                $classes = array('dropdown-menu');
            }
            
            if($depth > 0){
                // Default class.
                $classes = array('submenu dropdown-menu');
            }
            

            /**
             * Filters the CSS class(es) applied to a menu list element.
             *
             * @since 4.8.0
             *
             * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
             * @param stdClass $args    An object of `wp_nav_menu()` arguments.
             * @param int      $depth   Depth of menu item. Used for padding.
             */
            $class_names = implode(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));

            $atts          = array();
            $atts['class'] = !empty($class_names) ? $class_names : '';

            /**
             * Filters the HTML attributes applied to a menu list element.
             *
             * @since 6.3.0
             *
             * @param array $atts {
             *     The HTML attributes applied to the `<ul>` element, empty strings are ignored.
             *
             *     @type string $class    HTML CSS class attribute.
             * }
             * @param stdClass $args      An object of `wp_nav_menu()` arguments.
             * @param int      $depth     Depth of menu item. Used for padding.
             */
            $atts       = apply_filters('nav_menu_submenu_attributes', $atts, $args, $depth);
            $attributes = $this->build_atts($atts);

            $output .= "{$n}{$indent}<ul{$attributes}>{$n}";
        }

        /**
         * Ends the list before the elements are added.
         *
         * @since 0.1.0
         *
         * @see Walker_Nav_Menu::end_lvl
         * @link https://developer.wordpress.org/reference/classes/walker_nav_menu/end_lvl/
         *
         * @param string   $output Required. Used to append additional content (passed by reference).
         * @param int      $depth Optional. Depth of menu item. Used for padding.
         * @param stdClass $args Optional. An object of wp_nav_menu() arguments. Default value: null.
         */
        public function end_lvl(&$output, $depth = 0, $args = null)
        {
            $output .= '</ul>';

            if ($depth == 0)
                $output .= '</li>';

            if ($depth > 0 )
                $output .= '</li>';
        }


        /**
         * Starts the element output.
         *
         * The $args parameter holds additional values that may be used with the child
         * class methods. Also includes the element output.
         *
         * @since 0.1.0
         *
         * @param string $output            Used to append additional content (passed by reference).
         * @param object $data_object       The data object.
         * @param int    $depth             Depth of the item.
         * @param array  $args              An array of additional arguments.
         * @param int    $current_object_id Optional. ID of the current item. Default 0.
         */
        public function start_el(&$output, $data_object, $depth = 0, $args = array(), $current_object_id = 0)
        {
            // print_r([$data_object, $depth , $args , $current_object_id ] );
            $item_link = $data_object->url ? $data_object->url : 'javascript: void(0)';
            if ($args->walker->has_children && ($depth == 0 || $depth > 0) ) {
                if($depth == 0){
                    $output .=   '<li class="nav-item br-item dropdown">
                                    <a class=" nav-item dropdown-toggle" href="' . $item_link . '" data-bs-toggle="dropdown" data-bs-auto-close="outside">'
                                    . $data_object->title .
                                    '</a>';
                    
                }else{
                    $output .=   '<li ><a class="dropdown-item " data-bs-auto-close="inside" style="display: flex; justify-content: space-between; align-items: flex-end;" 
                                    href="' . $item_link . '">' . $data_object->title . ' <i class="fa-solid fa-angle-right"></i></a>';
                }
            } else {
                if (!$args->walker->has_children && $depth > 0) {
                    $output .= '<li><a class="dropdown-item" href="' . $item_link . '">' . $data_object->title ;
                } else {
                    $output .= '<a class="br-item" href="' . $item_link . '">' . $data_object->title;
                }
            }
        }


        /**
         * Ends the element output, if needed.
         *
         * The $args parameter holds additional values that may be used with the child class methods.
         *
         * @since 0.1.0
         *
         * @param string $output      Used to append additional content (passed by reference).
         * @param object $data_object The data object.
         * @param int    $depth       Depth of the item.
         * @param array  $args        An array of additional arguments.
         */
        public function end_el(&$output, $data_object, $depth = 0, $args = array())
        {
            $output .= '</a>';

            if ($depth > 0) {
                $output .= '</a></li>';
            } else {
                $output .= '</a>';
            }
            
        }
    }
}
