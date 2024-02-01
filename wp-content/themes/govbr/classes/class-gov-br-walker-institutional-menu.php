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

if ( ! class_exists( 'Gov_BR_Walker_Institutional_Menu' ) ) {
	/**
	 * Class for custom menu walker.
	 *
	 * This class is used to define a custom menu walker, with custom css classes.
	 *
	 * @since 0.1.0
	 */
	class Gov_BR_Walker_Institutional_Menu extends \Walker_Nav_Menu {

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
		// public function end_lvl( &$output, $depth = 0, $args = null ) {
        //     $output .= '</ul>';
            
        //     if ( $depth == 0 )
        //         $output .= '</div>';
		// }


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
		public function start_el( &$output, $data_object, $depth = 0, $args = array(), $current_object_id = 0 ) {
            $item_link = $data_object->url ? $data_object->url : 'javascript: void(0)';
            if( $args->walker->has_children && $depth == 0){
                // $output .= '<a class="br-item" href="' . $item_link . '">' . $data_object->title ."ok";

                $output .=   '<div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle button-menu" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'
                                . $data_object->title .
                                '</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>';
            }else{

                // if ( $depth > 0 )
                // $output .= '<li>';


                $output .= '<a class="br-item" href="' . $item_link . '">' . $data_object->title;
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
        public function end_el( &$output, $data_object, $depth = 0, $args = array() ) {
            $output .= '</a>'; 
            
            // if ( !$args->walker->has_children && (substr($output, -strlen('</ul>')) !== '</ul>') && (substr($output, -strlen('</div>')) !== '</div>') ) {
            //     $output .= '</span>';
            //     $output .= '</a>';
            // }

            // if ( $depth > 0 )
            //     $output .= '</li>';    
        }
	}
}
