<?php
/**
 * Restricted Access
 */
if ( ! defined( 'ABSPATH') || !defined( 'booty_metaboxes') ) :
    die( 'Cheatin\' huh?' );
endif;


//Saves new custom options for navigation
add_action('wp_update_nav_menu_item', 'booty_custom_nav_update', 10, 3);

function booty_custom_nav_update($menu_id, $menu_item_db_id, $args) {
    if(isset($_POST['menu-item-use_megamenu'][$menu_item_db_id])) {
        update_post_meta($menu_item_db_id, '_menu_item_use_megamenu', $_POST['menu-item-use_megamenu'][$menu_item_db_id]);
    }else{
		update_post_meta($menu_item_db_id, '_menu_item_use_megamenu', '0');
	}	
    if(isset($_POST['menu-item-mega_item_type'][$menu_item_db_id])) {
        update_post_meta($menu_item_db_id, '_menu_item_mega_item_type', $_POST['menu-item-mega_item_type'][$menu_item_db_id]);
    }else{
		update_post_meta($menu_item_db_id, '_menu_item_mega_item_type', '0');
	}
    if(isset($_POST['menu-item-mega_column_start'][$menu_item_db_id])) {
        update_post_meta($menu_item_db_id, '_menu_item_mega_column_start', $_POST['menu-item-mega_column_start'][$menu_item_db_id]);
    }else{
		update_post_meta($menu_item_db_id, '_menu_item_mega_column_start', '0');
	}
    if(isset($_POST['booty_selected_menu_icon'][$menu_item_db_id])) {
        update_post_meta($menu_item_db_id, '_booty_selected_menu_icon', $_POST['booty_selected_menu_icon'][$menu_item_db_id]);
    }else{
		update_post_meta($menu_item_db_id, '_booty_selected_menu_icon', '');
	}
    if(isset($_POST['booty_show_menu_icon'][$menu_item_db_id])) {
        update_post_meta($menu_item_db_id, '_booty_show_menu_icon', $_POST['booty_show_menu_icon'][$menu_item_db_id]);
    }else{
		update_post_meta($menu_item_db_id, '_booty_show_menu_icon', '0');
	}
}

//Adds value of custom option to $item object that will be passed to booty_Walker_Nav_Menu_Edit
add_filter('wp_setup_nav_menu_item', 'booty_custom_nav_item');

function booty_custom_nav_item($menu_item) {
    $menu_item->use_megamenu = get_post_meta($menu_item->ID, '_menu_item_use_megamenu', true); 
    $menu_item->mega_item_column_start = get_post_meta($menu_item->ID, '_menu_item_mega_column_start', true);
    $menu_item->mega_item_type = get_post_meta($menu_item->ID, '_menu_item_mega_item_type', true);
    $menu_item->mega_item_icon = get_post_meta($menu_item->ID, '_booty_selected_menu_icon', true);
    $menu_item->mega_item_icon_show = get_post_meta($menu_item->ID, '_booty_show_menu_icon', true);
    return $menu_item;
}

add_filter('wp_edit_nav_menu_walker', 'booty_custom_nav_edit_walker', 10, 2);

function booty_custom_nav_edit_walker($walker, $menu_id) {
    return 'Booty_Walker_Nav_Menu_Edit';
}

//Add menu item options
if (!class_exists('Booty_Walker_Nav_Menu_Edit')) {
    
    function booty_get_megamenu_columns() {
        return array(
            '2' => esc_html__('2 columns', BOOTY_TXT_DOMAIN),
            '3' => esc_html__('3 columns', BOOTY_TXT_DOMAIN),
            '4' => esc_html__('4 columns', BOOTY_TXT_DOMAIN),
            '5' => esc_html__('5 columns', BOOTY_TXT_DOMAIN),
            '6' => esc_html__('6 columns', BOOTY_TXT_DOMAIN),
        );
    }

	class Booty_Walker_Nav_Menu_Edit extends Walker_Nav_Menu {
		public function start_lvl( &$output, $depth = 0, $args = array() ) {}

		public function end_lvl( &$output, $depth = 0, $args = array() ) {}
			
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $_wp_nav_menu_max_depth;
			$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

			ob_start();
			$item_id = esc_attr( $item->ID );
			$removed_args = array(
				'action',
				'customlink-tab',
				'edit-menu-item',
				'menu-item',
				'page-tab',
				'_wpnonce',
			);

			$original_title = '';
			if ( 'taxonomy' == $item->type ) {
				$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
				if ( is_wp_error( $original_title ) )
					$original_title = false;
			} elseif ( 'post_type' == $item->type ) {
				$original_object = get_post( $item->object_id );
				$original_title = get_the_title( $original_object->ID );
			}

			$classes = array(
				'menu-item menu-item-depth-' . $depth,
				'menu-item-' . esc_attr( $item->object ),
				'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
			);

			$title = $item->title;

			if ( ! empty( $item->_invalid ) ) {
				$classes[] = 'menu-item-invalid'; 
				$title = sprintf( esc_html__( '%s (Invalid)', BOOTY_TXT_DOMAIN ), $item->title );
			} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
				$classes[] = 'pending'; 
				$title = sprintf( esc_html__('%s (Pending)', BOOTY_TXT_DOMAIN), $item->title );
			}

			$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

			$submenu_text = '';
			if ( 0 == $depth )
				$submenu_text = 'style="display: none;"';

			?>
			<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
				<div class="menu-item-bar">
					<div class="menu-item-handle">
						<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo esc_attr($submenu_text); ?>><?php esc_html_e( 'sub item',BOOTY_TXT_DOMAIN ); ?></span></span>
						<span class="item-controls">
							<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
							<span class="item-order hide-if-js">
								<a href="<?php
									echo wp_nonce_url(
										add_query_arg(
											array(
												'action' => 'move-up-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									);
								?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up',BOOTY_TXT_DOMAIN); ?>">&#8593;</abbr></a>
								|
								<a href="<?php
									echo wp_nonce_url(
										add_query_arg(
											array(
												'action' => 'move-down-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									);
								?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down',BOOTY_TXT_DOMAIN); ?>">&#8595;</abbr></a>
							</span>
							<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e('Edit Menu Item',BOOTY_TXT_DOMAIN); ?>" href="<?php
								echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
							?>"><?php esc_html_e( 'Edit Menu Item',BOOTY_TXT_DOMAIN ); ?></a>
						</span>
					</div>
				</div>

				<div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
					<?php if ( 'custom' == $item->type ) : ?>
						<p class="field-url description description-wide">
							<label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
								<?php esc_html_e( 'URL',BOOTY_TXT_DOMAIN ); ?><br />
								<input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
							</label>
						</p>
					<?php endif; ?>
					<p class="description description-wide">
						<label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Navigation Label',BOOTY_TXT_DOMAIN ); ?><br />
							<input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
						</label>
					</p>
					<p class="field-title-attribute description description-wide">
						<label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Title Attribute',BOOTY_TXT_DOMAIN ); ?><br />
							<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
						</label>
					</p>
					<p class="field-link-target description">
						<label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
							<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
							<?php esc_html_e( 'Open link in a new window/tab',BOOTY_TXT_DOMAIN ); ?>
						</label>
					</p>
					<p class="field-css-classes description description-thin">
						<label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'CSS Classes (optional)',BOOTY_TXT_DOMAIN ); ?><br />
							<input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
						</label>
					</p>
					<p class="field-xfn description description-thin">
						<label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Link Relationship (XFN)',BOOTY_TXT_DOMAIN ); ?><br />
							<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
						</label>
					</p>
					<p class="field-description description description-wide">
						<label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'Description',BOOTY_TXT_DOMAIN ); ?><br />
							<textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
							<span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.',BOOTY_TXT_DOMAIN); ?></span>
						</label>
					</p>
									
					<?php
					/*
					 * Add custom options
					 */
					?>  
						<div class="wrap-custom-options-level0-<?php echo esc_attr($item_id); ?>" style="<?php echo ($depth == 0 ? 'display:block;' : 'display:none;') ?>">
							<p class="description">
								<label for="edit-menu-item-use_megamenu-<?php echo esc_attr($item_id); ?>">
									<input type="checkbox" id="edit-menu-item-use_megamenu-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-use_megamenu"
										   <?php if (esc_attr( $item->use_megamenu )) : ?>
											name="menu-item-use_megamenu[<?php echo esc_attr($item_id); ?>]"
											<?php endif; ?>
											data-name="menu-item-use_megamenu[<?php echo esc_attr($item_id); ?>]"
											value="1" <?php echo ($item->use_megamenu && $item->use_megamenu == 1 ? 'checked' : '' )?> />
									<?php echo esc_html__('Mega menu', BOOTY_TXT_DOMAIN); ?>
								</label>
							</p>
							<?php $panel_columns = booty_get_megamenu_columns(); ?>
						</div>
						<?php
						$parent_use_megamenu = 0;
						if($depth == 1) {
							if($item->menu_item_parent) {
								$parent_item = get_post_meta($item->menu_item_parent, '_menu_item_use_megamenu', true);
								$parent_use_megamenu = $parent_item ? $parent_item : 0;
							}
						}
						?>
						<div class="wrap-custom-options-level1-<?php echo esc_attr($item_id); ?>" style="<?php echo ($depth == 1 ? 'display:block;' : 'display:none;' )?>">
							<?php $booty_awesomes = booty_awesome();?>
							<div class="booty_menu_icon" id="booty_menu_icon_<?php echo esc_attr($item_id)?>">
								<label for="booty_select_menu_icon_<?php echo esc_attr($item_id); ?>">
								<input class="booty_select_menu_icon" id="booty_select_menu_icon_<?php echo esc_attr($item_id)?>" type="button" value="<?php echo esc_html__('Select icon', BOOTY_TXT_DOMAIN); ?>" />
								</label><br />
								<ul class="booty_list_awesome" id="booty_list_awesome_<?php echo esc_attr($item_id);?>" style="display:none;">
								<?php foreach ($booty_awesomes as $key => $value): ?>
									<li data-value="<?php echo esc_html ($key)?>"><i class="<?php echo esc_html($key)?>"></i></li>
								<?php endforeach; ?>
								</ul>
								<input name="booty_show_menu_icon[<?php echo esc_attr($item_id)?>]" class="booty_select_menu_icon" id="booty_select_menu_icon<?php echo esc_attr($item_id)?>" type="checkbox" value="1" <?php checked( $item->mega_item_icon_show, '1' ); ?>/><?php echo esc_html__('Show icon ', BOOTY_TXT_DOMAIN); ?><span id="booty_selected_menu_icon_<?php echo esc_attr($item_id)?>"><i class="<?php echo esc_html($item->mega_item_icon)?>"></i></span>
								<input name="booty_selected_menu_icon[<?php echo esc_attr($item_id)?>]" class="booty_select_menu_icon" id="booty_select_menu_icon<?php echo esc_attr($item_id)?>" type="hidden" value="<?php echo esc_html($item->mega_item_icon)?>" />
								<br />
								
							</div>
							<p class="description wrap-edit-menu-item-mega_item_column" id="wrap-edit-menu-item-mega_item_column-<?php echo esc_attr($item_id) ?>" style="<?php echo !($parent_use_megamenu) ? 'display:none;' : '' ?>">
								<label for="edit-menu-item-mega_item_column-<?php echo esc_attr($item_id); ?>">
									<input type="checkbox" id="menu-item-mega_item_type<?php echo esc_attr($item_id); ?>" value="1" name="menu-item-mega_item_type[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->mega_item_type, '1' ); ?> /><?php echo esc_html__('Is item title ?', BOOTY_TXT_DOMAIN); ?><br />
									<input type="checkbox" id="menu-item-mega_column_start<?php echo esc_attr($item_id); ?>" value="1" name="menu-item-mega_column_start[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->mega_item_column_start, '1' ); ?> /><?php echo esc_html__('Start Column', BOOTY_TXT_DOMAIN); ?><br />
									
								</label>
							</p>
						</div>
					<?php
					/*
					 * end custom options
					 */
					?>

					<p class="field-move hide-if-no-js description description-wide">
						<label>
							<span><?php esc_html_e( 'Move', BOOTY_TXT_DOMAIN ); ?></span>
							<a href="#" class="menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one', BOOTY_TXT_DOMAIN ); ?></a>
							<a href="#" class="menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one', BOOTY_TXT_DOMAIN ); ?></a>
							<a href="#" class="menus-move menus-move-left" data-dir="left"></a>
							<a href="#" class="menus-move menus-move-right" data-dir="right"></a>
							<a href="#" class="menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top', BOOTY_TXT_DOMAIN ); ?></a>
						</label>
					</p>

					<div class="menu-item-actions description-wide submitbox">
						<?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
							<p class="link-to-original">
								<?php printf( esc_html__('Original: %s', BOOTY_TXT_DOMAIN), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
							</p>
						<?php endif; ?>
						<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
						echo wp_nonce_url(
							add_query_arg(
								array(
									'action' => 'delete-menu-item',
									'menu-item' => esc_attr($item_id),
								),
								admin_url( 'nav-menus.php' )
							),
							'delete-menu_item_' . esc_attr($item_id)
						); ?>"><?php esc_html_e( 'Remove', BOOTY_TXT_DOMAIN ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => esc_attr($item_id), 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
							?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel', BOOTY_TXT_DOMAIN); ?></a>
					</div>

					<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
					<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
					<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
					<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
					<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
					<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
				</div><!-- .menu-item-settings-->
				<ul class="menu-item-transport"></ul>
			<?php
			$output .= ob_get_clean();
		}
    }

}

//Primary menu
if (!class_exists('Booty_Sublevel_Walker')) {

    class Booty_Sublevel_Walker extends Walker_Nav_Menu { 
        

        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
            $indent = ( $depth ) ? str_repeat("\t", $depth) : '';
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;
            if($item->use_megamenu && $depth == 0) {
                $classes[] = 'megamenu';
            }elseif($depth == 0){
				$classes[] = 'no_megamenu';
			}
            $parent_use_megamenu = false;
            if($depth == 1) {
                if($item->menu_item_parent) {
                    $parent_use_megamenu = get_post_meta($item->menu_item_parent, '_menu_item_use_megamenu', true); 
                    if($parent_use_megamenu) {
						if($item -> mega_item_column_start) $classes[] = 'start_column';
						if($item -> mega_item_type) $classes[] = 'booty_menu_title';
                    }
					
                }
            }
            if($args->has_children){
                $classes[] = 'page_item_has_children';
                $classes[] = 'has-drop';
            }
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $class_names . '>';

            $atts = array();
            $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
            $atts['href'] = !empty($item->url) ? $item->url : '';
            
            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ( 'href' === $attr ) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>'; 
			if($item -> mega_item_icon_show){
				$item_output .= '<i class="'.esc_html($item->mega_item_icon).'"></i>';		
			}
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>'; 
            $item_output .= $args->after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }
        
        public function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
            $id_field = $this->db_fields['id'];
            if ( is_object( $args[0] ) ) {
                $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
            }
            return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
        }

    }

}
function booty_awesome(){
	$booty_awesome = array(
		'fa fa-adjust' => 'Adjust',
		'fa fa-anchor' => 'Anchor',
		'fa fa-archive' => 'Archive',
		'fa fa-area-chart' => 'Area Chart',
		'fa fa-arrows' => 'Arrows',
		'fa fa-arrows-h' => 'Arrows Horizontal',
		'fa fa-arrows-v' => 'Arrows Vertical',
		'fa fa-asterisk' => 'Asterisk',
		'fa fa-at' => 'At',
		'fa fa-ban' => 'Ban',
		'fa fa-bar-chart' => 'Bar Chart (bar-chart-o)',
		'fa fa-barcode' => 'Barcode',
		'fa fa-bars' => 'Bars (navicon, reorder)',
		'fa fa-bed' => 'Bed (hotel)',
		'fa fa-beer' => 'Beer',
		'fa fa-bell' => 'Bell',
		'fa fa-bell-o' => 'Bell Outlined',
		'fa fa-bell-slash' => 'Bell Slash',
		'fa fa-bell-slash-o' => 'Bell Slash Outlined',
		'fa fa-bicycle' => 'Bicycle',
		'fa fa-binoculars' => 'Binoculars',
		'fa fa-birthday-cake' => 'Birthday Cake',
		'fa fa-bolt' => 'Lightning Bolt (flash)',
		'fa fa-bomb' => 'Bomb',
		'fa fa-book' => 'Book',
		'fa fa-bookmark' => 'Bookmark',
		'fa fa-bookmark-o' => 'Bookmark Outlined',
		'fa fa-briefcase' => 'Briefcase',
		'fa fa-bug' => 'Bug',
		'fa fa-building' => 'Building',
		'fa fa-building-o' => 'Building Outlined',
		'fa fa-bullhorn' => 'Bullhorn',
		'fa fa-bullseye' => 'Bullseye',
		'fa fa-bus' => 'Bus',
		'fa fa-calculator' => 'Calculator',
		'fa fa-calendar' => 'Calendar',
		'fa fa-calendar-o' => 'Calendar-o',
		'fa fa-camera' => 'Camera',
		'fa fa-camera-retro' => 'Camera-retro',
		'fa fa-car' => 'Car (automobile)',
		'fa fa-caret-square-o-down' => 'Caret Square Outlined Down (toggle-down)',
		'fa fa-caret-square-o-left' => 'Caret Square Outlined Left (toggle-left)',
		'fa fa-caret-square-o-right' => 'Caret Square Outlined Right (toggle-right)',
		'fa fa-caret-square-o-up' => 'Caret Square Outlined Up (toggle-up)',
		'fa fa-cart-arrow-down' => 'Shopping Cart Arrow Down',
		'fa fa-cart-plus' => 'Add to Shopping Cart',
		'fa fa-cc' => 'Closed Captions',
		'fa fa-certificate' => 'Certificate',
		'fa fa-check' => 'Check',
		'fa fa-check-circle' => 'Check Circle',
		'fa fa-check-circle-o' => 'Check Circle Outlined',
		'fa fa-check-square' => 'Check Square',
		'fa fa-check-square-o' => 'Check Square Outlined',
		'fa fa-child' => 'Child',
		'fa fa-circle' => 'Circle',
		'fa fa-circle-o' => 'Circle Outlined',
		'fa fa-circle-o-notch' => 'Circle Outlined Notched',
		'fa fa-circle-thin' => 'Circle Outlined Thin',
		'fa fa-clock-o' => 'Clock Outlined',
		'fa fa-cloud' => 'Cloud',
		'fa fa-cloud-download' => 'Cloud Download',
		'fa fa-cloud-upload' => 'Cloud Upload',
		'fa fa-code' => 'Code',
		'fa fa-code-fork' => 'Code-fork',
		'fa fa-coffee' => 'Coffee',
		'fa fa-cog' => 'Cog (gear)',
		'fa fa-cogs' => 'Cogs (gears)',
		'fa fa-comment' => 'Comment',
		'fa fa-comment-o' => 'Comment-o',
		'fa fa-comments' => 'Comments',
		'fa fa-comments-o' => 'Comments-o',
		'fa fa-compass' => 'Compass',
		'fa fa-copyright' => 'Copyright',
		'fa fa-credit-card' => 'Credit-card',
		'fa fa-credit-card-alt' => 'Credit Card',
		'fa fa-crop' => 'Crop',
		'fa fa-crosshairs' => 'Crosshairs',
		'fa fa-cube' => 'Cube',
		'fa fa-cubes' => 'Cubes',
		'fa fa-cutlery' => 'Cutlery',
		'fa fa-database' => 'Database',
		'fa fa-desktop' => 'Desktop',
		'fa fa-diamond' => 'Diamond',
		'fa fa-dot-circle-o' => 'Dot Circle Outlined',
		'fa fa-download' => 'Download',
		'fa fa-ellipsis-h' => 'Ellipsis Horizontal',
		'fa fa-ellipsis-v' => 'Ellipsis Vertical',
		'fa fa-envelope' => 'Envelope',
		'fa fa-envelope-o' => 'Envelope Outlined',
		'fa fa-envelope-square' => 'Envelope Square',
		'fa fa-eraser' => 'Eraser',
		'fa fa-exchange' => 'Exchange',
		'fa fa-exclamation' => 'Exclamation',
		'fa fa-exclamation-circle' => 'Exclamation Circle',
		'fa fa-exclamation-triangle' => 'Exclamation Triangle (warning)',
		'fa fa-external-link' => 'External Link',
		'fa fa-external-link-square' => 'External Link Square',
		'fa fa-eye' => 'Eye',
		'fa fa-eye-slash' => 'Eye Slash',
		'fa fa-eyedropper' => 'Eyedropper',
		'fa fa-fax' => 'Fax',
		'fa fa-female' => 'Female',
		'fa fa-fighter-jet' => 'Fighter-jet',
		'fa fa-file-archive-o' => 'Archive File Outlined (file-zip-o)',
		'fa fa-file-audio-o' => 'Audio File Outlined (file-sound-o)',
		'fa fa-file-code-o' => 'Code File Outlined',
		'fa fa-file-excel-o' => 'Excel File Outlined',
		'fa fa-file-image-o' => 'Image File Outlined (file-photo-o, file-picture-o)',
		'fa fa-file-pdf-o' => 'PDF File Outlined',
		'fa fa-file-powerpoint-o' => 'Powerpoint File Outlined',
		'fa fa-file-video-o' => 'Video File Outlined (file-movie-o)',
		'fa fa-file-word-o' => 'Word File Outlined',
		'fa fa-film' => 'Film',
		'fa fa-filter' => 'Filter',
		'fa fa-fire' => 'Fire',
		'fa fa-fire-extinguisher' => 'Fire-extinguisher',
		'fa fa-flag' => 'Flag',
		'fa fa-flag-checkered' => 'Flag-checkered',
		'fa fa-flag-o' => 'Flag Outlined',
		'fa fa-flask' => 'Flask',
		'fa fa-folder' => 'Folder',
		'fa fa-folder-o' => 'Folder Outlined',
		'fa fa-folder-open' => 'Folder Open',
		'fa fa-folder-open-o' => 'Folder Open Outlined',
		'fa fa-frown-o' => 'Frown Outlined',
		'fa fa-futbol-o' => 'Futbol Outlined (soccer-ball-o)',
		'fa fa-gamepad' => 'Gamepad',
		'fa fa-gavel' => 'Gavel (legal)',
		'fa fa-gift' => 'Gift',
		'fa fa-glass' => 'Glass',
		'fa fa-globe' => 'Globe',
		'fa fa-graduation-cap' => 'Graduation Cap (mortar-board)',
		'fa fa-hdd-o' => 'HDD',
		'fa fa-headphones' => 'Headphones',
		'fa fa-heart' => 'Heart',
		'fa fa-heart-o' => 'Heart Outlined',
		'fa fa-heartbeat' => 'Heartbeat',
		'fa fa-history' => 'History',
		'fa fa-home' => 'Home',
		'fa fa-inbox' => 'Inbox',
		'fa fa-info' => 'Info',
		'fa fa-info-circle' => 'Info Circle',
		'fa fa-key' => 'Key',
		'fa fa-keyboard-o' => 'Keyboard Outlined',
		'fa fa-language' => 'Language',
		'fa fa-laptop' => 'Laptop',
		'fa fa-leaf' => 'Leaf',
		'fa fa-lemon-o' => 'Lemon Outlined',
		'fa fa-level-down' => 'Level Down',
		'fa fa-level-up' => 'Level Up',
		'fa fa-life-ring' => 'Life Ring (life-bouy, life-buoy, life-saver, support)',
		'fa fa-lightbulb-o' => 'Lightbulb Outlined',
		'fa fa-line-chart' => 'Line Chart',
		'fa fa-location-arrow' => 'Location-arrow',
		'fa fa-lock' => 'Lock',
		'fa fa-magic' => 'Magic',
		'fa fa-magnet' => 'Magnet',
		'fa fa-male' => 'Male',
		'fa fa-map-marker' => 'Map-marker',
		'fa fa-meh-o' => 'Meh Outlined',
		'fa fa-microphone' => 'Microphone',
		'fa fa-microphone-slash' => 'Microphone Slash',
		'fa fa-minus' => 'Minus',
		'fa fa-minus-circle' => 'Minus Circle',
		'fa fa-minus-square' => 'Minus Square',
		'fa fa-minus-square-o' => 'Minus Square Outlined',
		'fa fa-mobile' => 'Mobile Phone (mobile-phone)',
		'fa fa-money' => 'Money',
		'fa fa-moon-o' => 'Moon Outlined',
		'fa fa-motorcycle' => 'Motorcycle',
		'fa fa-music' => 'Music',
		'fa fa-newspaper-o' => 'Newspaper Outlined',
		'fa fa-paint-brush' => 'Paint Brush',
		'fa fa-paper-plane' => 'Paper Plane (send)',
		'fa fa-paper-plane-o' => 'Paper Plane Outlined (send-o)',
		'fa fa-paw' => 'Paw',
		'fa fa-pencil' => 'Pencil',
		'fa fa-pencil-square' => 'Pencil Square',
		'fa fa-pencil-square-o' => 'Pencil Square Outlined (edit)',
		'fa fa-percent' => 'Percent',
		'fa fa-phone' => 'Phone',
		'fa fa-phone-square' => 'Phone Square',
		'fa fa-picture-o' => 'Picture Outlined (photo, image)',
		'fa fa-pie-chart' => 'Pie Chart',
		'fa fa-plane' => 'Plane',
		'fa fa-plug' => 'Plug',
		'fa fa-plus' => 'Plus',
		'fa fa-plus-circle' => 'Plus Circle',
		'fa fa-plus-square' => 'Plus Square',
		'fa fa-plus-square-o' => 'Plus Square Outlined',
		'fa fa-power-off' => 'Power Off',
		'fa fa-print' => 'Print',
		'fa fa-puzzle-piece' => 'Puzzle Piece',
		'fa fa-qrcode' => 'Qrcode',
		'fa fa-question' => 'Question',
		'fa fa-question-circle' => 'Question Circle',
		'fa fa-quote-left' => 'Quote-left',
		'fa fa-quote-right' => 'Quote-right',
		'fa fa-random' => 'Random',
		'fa fa-recycle' => 'Recycle',
		'fa fa-refresh' => 'Refresh',
		'fa fa-reply' => 'Reply (mail-reply)',
		'fa fa-reply-all' => 'Reply-all (mail-reply-all)',
		'fa fa-retweet' => 'Retweet',
		'fa fa-road' => 'Road',
		'fa fa-rocket' => 'Rocket',
		'fa fa-rss' => 'Rss (feed)',
		'fa fa-rss-square' => 'RSS Square',
		'fa fa-search' => 'Search',
		'fa fa-search-minus' => 'Search Minus',
		'fa fa-search-plus' => 'Search Plus',
		'fa fa-server' => 'Server',
		'fa fa-share' => 'Share (mail-forward)',
		'fa fa-share-alt' => 'Share Alt',
		'fa fa-share-alt-square' => 'Share Alt Square',
		'fa fa-share-square' => 'Share Square',
		'fa fa-share-square-o' => 'Share Square Outlined',
		'fa fa-shield' => 'Shield',
		'fa fa-ship' => 'Ship',
		'fa fa-shopping-cart' => 'Shopping-cart',
		'fa fa-sign-in' => 'Sign In',
		'fa fa-sign-out' => 'Sign Out',
		'fa fa-signal' => 'Signal',
		'fa fa-sitemap' => 'Sitemap',
		'fa fa-sliders' => 'Sliders',
		'fa fa-smile-o' => 'Smile Outlined',
		'fa fa-sort' => 'Sort (unsorted)',
		'fa fa-sort-alpha-asc' => 'Sort Alpha Ascending',
		'fa fa-sort-alpha-desc' => 'Sort Alpha Descending',
		'fa fa-sort-amount-asc' => 'Sort Amount Ascending',
		'fa fa-sort-amount-desc' => 'Sort Amount Descending',
		'fa fa-sort-asc' => 'Sort Ascending (sort-up)',
		'fa fa-sort-desc' => 'Sort Descending (sort-down)',
		'fa fa-sort-numeric-asc' => 'Sort Numeric Ascending',
		'fa fa-sort-numeric-desc' => 'Sort Numeric Descending',
		'fa fa-space-shuttle' => 'Space Shuttle',
		'fa fa-spinner' => 'Spinner',
		'fa fa-spoon' => 'Spoon',
		'fa fa-square' => 'Square',
		'fa fa-square-o' => 'Square Outlined',
		'fa fa-star' => 'Star',
		'fa fa-star-half' => 'Star-half',
		'fa fa-star-half-o' => 'Star Half Outlined (star-half-empty, star-half-full)',
		'fa fa-star-o' => 'Star Outlined',
		'fa fa-street-view' => 'Street View',
		'fa fa-suitcase' => 'Suitcase',
		'fa fa-sun-o' => 'Sun Outlined',
		'fa fa-tablet' => 'Tablet',
		'fa fa-tachometer' => 'Tachometer (dashboard)',
		'fa fa-tag' => 'Tag',
		'fa fa-tags' => 'Tags',
		'fa fa-tasks' => 'Tasks',
		'fa fa-taxi' => 'Taxi (cab)',
		'fa fa-terminal' => 'Terminal',
		'fa fa-thumb-tack' => 'Thumb Tack',
		'fa fa-thumbs-down' => 'Thumbs-down',
		'fa fa-thumbs-o-down' => 'Thumbs Down Outlined',
		'fa fa-thumbs-o-up' => 'Thumbs Up Outlined',
		'fa fa-thumbs-up' => 'Thumbs-up',
		'fa fa-ticket' => 'Ticket',
		'fa fa-times' => 'Times (remove, close)',
		'fa fa-times-circle' => 'Times Circle',
		'fa fa-times-circle-o' => 'Times Circle Outlined',
		'fa fa-tint' => 'Tint',
		'fa fa-toggle-off' => 'Toggle Off',
		'fa fa-toggle-on' => 'Toggle On',
		'fa fa-trash' => 'Trash',
		'fa fa-trash-o' => 'Trash Outlined',
		'fa fa-tree' => 'Tree',
		'fa fa-trophy' => 'Trophy',
		'fa fa-truck' => 'Truck',
		'fa fa-tty' => 'TTY',
		'fa fa-umbrella' => 'Umbrella',
		'fa fa-university' => 'University (institution, bank)',
		'fa fa-unlock' => 'Unlock',
		'fa fa-unlock-alt' => 'Unlock Alt',
		'fa fa-upload' => 'Upload',
		'fa fa-user' => 'User',
		'fa fa-user-plus' => 'Add User',
		'fa fa-user-secret' => 'User Secret',
		'fa fa-user-times' => 'Remove User',
		'fa fa-users' => 'Users (group)',
		'fa fa-video-camera' => 'Video Camera',
		'fa fa-volume-down' => 'Volume-down',
		'fa fa-volume-off' => 'Volume-off',
		'fa fa-volume-up' => 'Volume-up',
		'fa fa-wheelchair' => 'Wheelchair',
		'fa fa-wifi' => 'WiFi',
		'fa fa-wrench' => 'Wrench',
		'fa fa-file' => 'File',
		'fa fa-file-archive-o' => 'Archive File Outlined (file-zip-o)',
		'fa fa-file-audio-o' => 'Audio File Outlined (file-sound-o)',
		'fa fa-file-code-o' => 'Code File Outlined',
		'fa fa-file-excel-o' => 'Excel File Outlined',
		'fa fa-file-image-o' => 'Image File Outlined (file-photo-o, file-picture-o)',
		'fa fa-file-o' => 'File Outlined',
		'fa fa-file-pdf-o' => 'PDF File Outlined',
		'fa fa-file-powerpoint-o' => 'Powerpoint File Outlined',
		'fa fa-file-text' => 'File Text',
		'fa fa-file-text-o' => 'File Text Outlined',
		'fa fa-file-video-o' => 'Video File Outlined (file-movie-o)',
		'fa fa-file-word-o' => 'Word File Outlined',
		'fa fa-circle-o-notch' => 'Circle Outlined Notched',
		'fa fa-cog' => 'Cog (gear)',
		'fa fa-refresh' => 'Refresh',
		'fa fa-spinner' => 'Spinner',
		'fa fa-check-square' => 'Check Square',
		'fa fa-check-square-o' => 'Check Square Outlined',
		'fa fa-circle' => 'Circle',
		'fa fa-circle-o' => 'Circle Outlined',
		'fa fa-dot-circle-o' => 'Dot Circle Outlined',
		'fa fa-minus-square' => 'Minus Square',
		'fa fa-minus-square-o' => 'Minus Square Outlined',
		'fa fa-plus-square' => 'Plus Square',
		'fa fa-plus-square-o' => 'Plus Square Outlined',
		'fa fa-square' => 'Square',
		'fa fa-square-o' => 'Square Outlined',
		'fa fa-cc-amex' => 'American Express Credit Card',
		'fa fa-cc-discover' => 'Discover Credit Card',
		'fa fa-cc-mastercard' => 'MasterCard Credit Card',
		'fa fa-cc-paypal' => 'Paypal Credit Card',
		'fa fa-cc-stripe' => 'Stripe Credit Card',
		'fa fa-cc-visa' => 'Visa Credit Card',
		'fa fa-credit-card' => 'Credit-card',
		'fa fa-credit-card-alt' => 'Credit Card',
		'fa fa-google-wallet' => 'Google Wallet',
		'fa fa-paypal' => 'Paypal',
		'fa fa-area-chart' => 'Area Chart',
		'fa fa-bar-chart' => 'Bar Chart (bar-chart-o)',
		'fa fa-line-chart' => 'Line Chart',
		'fa fa-pie-chart' => 'Pie Chart',
		'fa fa-btc' => 'Bitcoin (BTC) (bitcoin)',
		'fa fa-eur' => 'Euro (EUR) (euro)',
		'fa fa-gbp' => 'GBP',
		'fa fa-ils' => 'Shekel (ILS) (shekel, sheqel)',
		'fa fa-inr' => 'Indian Rupee (INR) (rupee)',
		'fa fa-jpy' => 'Japanese Yen (JPY) (cny, rmb, yen)',
		'fa fa-krw' => 'Korean Won (KRW) (won)',
		'fa fa-money' => 'Money',
		'fa fa-rub' => 'Russian Ruble (RUB) (ruble, rouble)',
		'fa fa-try' => 'Turkish Lira (TRY) (turkish-lira)',
		'fa fa-usd' => 'US Dollar (dollar)',
		'fa fa-align-center' => 'Align-center',
		'fa fa-align-justify' => 'Align-justify',
		'fa fa-align-left' => 'Align-left',
		'fa fa-align-right' => 'Align-right',
		'fa fa-bold' => 'Bold',
		'fa fa-chain-broken' => 'Chain Broken (unlink)',
		'fa fa-clipboard' => 'Clipboard (paste)',
		'fa fa-columns' => 'Columns',
		'fa fa-eraser' => 'Eraser',
		'fa fa-file' => 'File',
		'fa fa-file-o' => 'File Outlined',
		'fa fa-file-text' => 'File Text',
		'fa fa-file-text-o' => 'File Text Outlined',
		'fa fa-files-o' => 'Files Outlined (copy)',
		'fa fa-floppy-o' => 'Floppy Outlined (save)',
		'fa fa-font' => 'Font',
		'fa fa-header' => 'Header',
		'fa fa-indent' => 'Indent',
		'fa fa-italic' => 'Italic',
		'fa fa-link' => 'Link (chain)',
		'fa fa-list' => 'List',
		'fa fa-list-alt' => 'List-alt',
		'fa fa-list-ol' => 'List-ol',
		'fa fa-list-ul' => 'List-ul',
		'fa fa-outdent' => 'Outdent (dedent)',
		'fa fa-paperclip' => 'Paperclip',
		'fa fa-paragraph' => 'Paragraph',
		'fa fa-repeat' => 'Repeat (rotate-right)',
		'fa fa-scissors' => 'Scissors (cut)',
		'fa fa-strikethrough' => 'Strikethrough',
		'fa fa-subscript' => 'Subscript',
		'fa fa-superscript' => 'Superscript',
		'fa fa-table' => 'Table',
		'fa fa-text-height' => 'Text-height',
		'fa fa-text-width' => 'Text-width',
		'fa fa-th' => 'Th',
		'fa fa-th-large' => 'Th-large',
		'fa fa-th-list' => 'Th-list',
		'fa fa-underline' => 'Underline',
		'fa fa-undo' => 'Undo (rotate-left)',
		'fa fa-angle-double-down' => 'Angle Double Down',
		'fa fa-angle-double-left' => 'Angle Double Left',
		'fa fa-angle-double-right' => 'Angle Double Right',
		'fa fa-angle-double-up' => 'Angle Double Up',
		'fa fa-angle-down' => 'Angle-down',
		'fa fa-angle-left' => 'Angle-left',
		'fa fa-angle-right' => 'Angle-right',
		'fa fa-angle-up' => 'Angle-up',
		'fa fa-arrow-circle-down' => 'Arrow Circle Down',
		'fa fa-arrow-circle-left' => 'Arrow Circle Left',
		'fa fa-arrow-circle-o-down' => 'Arrow Circle Outlined Down',
		'fa fa-arrow-circle-o-left' => 'Arrow Circle Outlined Left',
		'fa fa-arrow-circle-o-right' => 'Arrow Circle Outlined Right',
		'fa fa-arrow-circle-o-up' => 'Arrow Circle Outlined Up',
		'fa fa-arrow-circle-right' => 'Arrow Circle Right',
		'fa fa-arrow-circle-up' => 'Arrow Circle Up',
		'fa fa-arrow-down' => 'Arrow-down',
		'fa fa-arrow-left' => 'Arrow-left',
		'fa fa-arrow-right' => 'Arrow-right',
		'fa fa-arrow-up' => 'Arrow-up',
		'fa fa-arrows' => 'Arrows',
		'fa fa-arrows-alt' => 'Arrows Alt',
		'fa fa-arrows-h' => 'Arrows Horizontal',
		'fa fa-arrows-v' => 'Arrows Vertical',
		'fa fa-caret-down' => 'Caret Down',
		'fa fa-caret-left' => 'Caret Left',
		'fa fa-caret-right' => 'Caret Right',
		'fa fa-caret-square-o-down' => 'Caret Square Outlined Down (toggle-down)',
		'fa fa-caret-square-o-left' => 'Caret Square Outlined Left (toggle-left)',
		'fa fa-caret-square-o-right' => 'Caret Square Outlined Right (toggle-right)',
		'fa fa-caret-square-o-up' => 'Caret Square Outlined Up (toggle-up)',
		'fa fa-caret-up' => 'Caret Up',
		'fa fa-chevron-circle-down' => 'Chevron Circle Down',
		'fa fa-chevron-circle-left' => 'Chevron Circle Left',
		'fa fa-chevron-circle-right' => 'Chevron Circle Right',
		'fa fa-chevron-circle-up' => 'Chevron Circle Up',
		'fa fa-chevron-down' => 'Chevron-down',
		'fa fa-chevron-left' => 'Chevron-left',
		'fa fa-chevron-right' => 'Chevron-right',
		'fa fa-chevron-up' => 'Chevron-up',
		'fa fa-exchange' => 'Exchange',
		'fa fa-hand-o-down' => 'Hand Outlined Down',
		'fa fa-hand-o-left' => 'Hand Outlined Left',
		'fa fa-hand-o-right' => 'Hand Outlined Right',
		'fa fa-hand-o-up' => 'Hand Outlined Up',
		'fa fa-long-arrow-down' => 'Long Arrow Down',
		'fa fa-long-arrow-left' => 'Long Arrow Left',
		'fa fa-long-arrow-right' => 'Long Arrow Right',
		'fa fa-long-arrow-up' => 'Long Arrow Up',
		'fa fa-arrows-alt' => 'Arrows Alt',
		'fa fa-backward' => 'Backward',
		'fa fa-compress' => 'Compress',
		'fa fa-eject' => 'Eject',
		'fa fa-expand' => 'Expand',
		'fa fa-fast-backward' => 'Fast-backward',
		'fa fa-fast-forward' => 'Fast-forward',
		'fa fa-forward' => 'Forward',
		'fa fa-pause' => 'Pause',
		'fa fa-pause-circle' => 'Pause Circle',
		'fa fa-pause-circle-o' => 'Pause Circle Outlined',
		'fa fa-play' => 'Play',
		'fa fa-play-circle' => 'Play Circle',
		'fa fa-play-circle-o' => 'Play Circle Outlined',
		'fa fa-random' => 'Random',
		'fa fa-step-backward' => 'Step-backward',
		'fa fa-step-forward' => 'Step-forward',
		'fa fa-stop' => 'Stop',
		'fa fa-stop-circle' => 'Stop Circle',
		'fa fa-stop-circle-o' => 'Stop Circle Outlined',
		'fa fa-youtube-play' => 'YouTube Play',
		'fa fa-ambulance' => 'Ambulance',
		'fa fa-bicycle' => 'Bicycle',
		'fa fa-bus' => 'Bus',
		'fa fa-car' => 'Car (automobile)',
		'fa fa-fighter-jet' => 'Fighter-jet',
		'fa fa-motorcycle' => 'Motorcycle',
		'fa fa-plane' => 'Plane',
		'fa fa-rocket' => 'Rocket',
		'fa fa-ship' => 'Ship',
		'fa fa-space-shuttle' => 'Space Shuttle',
		'fa fa-subway' => 'Subway',
		'fa fa-taxi' => 'Taxi (cab)',
		'fa fa-train' => 'Train',
		'fa fa-truck' => 'Truck',
		'fa fa-wheelchair' => 'Wheelchair',
		'fa fa-mars' => 'Mars',
		'fa fa-mars-double' => 'Mars Double',
		'fa fa-mars-stroke' => 'Mars Stroke',
		'fa fa-mars-stroke-h' => 'Mars Stroke Horizontal',
		'fa fa-mars-stroke-v' => 'Mars Stroke Vertical',
		'fa fa-mercury' => 'Mercury',
		'fa fa-neuter' => 'Neuter',
		'fa fa-transgender' => 'Transgender (intersex)',
		'fa fa-transgender-alt' => 'Transgender Alt',
		'fa fa-venus' => 'Venus',
		'fa fa-venus-double' => 'Venus Double',
		'fa fa-venus-mars' => 'Venus Mars',
		'fa fa-adn' => 'App.net',
		'fa fa-android' => 'Android',
		'fa fa-angellist' => 'AngelList',
		'fa fa-apple' => 'Apple',
		'fa fa-behance' => 'Behance',
		'fa fa-behance-square' => 'Behance Square',
		'fa fa-bitbucket' => 'Bitbucket',
		'fa fa-bitbucket-square' => 'Bitbucket Square',
		'fa fa-bluetooth' => 'Bluetooth',
		'fa fa-bluetooth-b' => 'Bluetooth',
		'fa fa-btc' => 'Bitcoin (BTC) (bitcoin)',
		'fa fa-buysellads' => 'BuySellAds',
		'fa fa-cc-amex' => 'American Express Credit Card',
		'fa fa-cc-jcb' => 'JCB Credit Card',
		'fa fa-cc-mastercard' => 'MasterCard Credit Card',
		'fa fa-cc-paypal' => 'Paypal Credit Card',
		'fa fa-cc-stripe' => 'Stripe Credit Card',
		'fa fa-cc-visa' => 'Visa Credit Card',
		'fa fa-codepen' => 'Codepen',
		'fa fa-codiepie' => 'Codie Pie',
		'fa fa-connectdevelop' => 'Connect Develop',
		'fa fa-css3' => 'CSS 3 Logo',
		'fa fa-dashcube' => 'DashCube',
		'fa fa-delicious' => 'Delicious Logo',
		'fa fa-deviantart' => 'DeviantART',
		'fa fa-digg' => 'Digg Logo',
		'fa fa-dribbble' => 'Dribbble',
		'fa fa-dropbox' => 'Dropbox',
		'fa fa-drupal' => 'Drupal Logo',
		'fa fa-edge' => 'Edge Browser',
		'fa fa-empire' => 'Galactic Empire (ge)',
		'fa fa-facebook' => 'Facebook (facebook-f)',
		'fa fa-facebook-official' => 'Facebook Official',
		'fa fa-facebook-square' => 'Facebook Square',
		'fa fa-flickr' => 'Flickr',
		'fa fa-fort-awesome' => 'Fort Awesome',
		'fa fa-forumbee' => 'Forumbee',
		'fa fa-gg-circle' => 'GG Currency Circle',
		'fa fa-git' => 'Git',
		'fa fa-git-square' => 'Git Square',
		'fa fa-github' => 'GitHub',
		'fa fa-github-alt' => 'GitHub Alt',
		'fa fa-github-square' => 'GitHub Square',
		'fa fa-google' => 'Google Logo',
		'fa fa-google-plus' => 'Google Plus',
		'fa fa-google-plus-square' => 'Google Plus Square',
		'fa fa-google-wallet' => 'Google Wallet',
		'fa fa-gittip' => 'Gratipay (Gittip) (gittip)',
		'fa fa-hacker-news' => 'Hacker News (y-combinator-square, yc-square)',
		'fa fa-html5' => 'HTML 5 Logo',
		'fa fa-instagram' => 'Instagram',
		'fa fa-ioxhost' => 'Ioxhost',
		'fa fa-joomla' => 'Joomla Logo',
		'fa fa-jsfiddle' => 'JsFiddle',
		'fa fa-lastfm' => 'Last.fm',
		'fa fa-lastfm-square' => 'Last.fm Square',
		'fa fa-leanpub' => 'Leanpub',
		'fa fa-linkedin' => 'LinkedIn',
		'fa fa-linkedin-square' => 'LinkedIn Square',
		'fa fa-linux' => 'Linux',
		'fa fa-maxcdn' => 'MaxCDN',
		'fa fa-meanpath' => 'Meanpath',
		'fa fa-medium' => 'Medium',
		'fa fa-mixcloud' => 'Mixcloud',
		'fa fa-openid' => 'OpenID',
		'fa fa-pagelines' => 'Pagelines',
		'fa fa-paypal' => 'Paypal',
		'fa fa-pied-piper' => 'Pied Piper Logo',
		'fa fa-pied-piper-alt' => 'Pied Piper Alternate Logo',
		'fa fa-pinterest' => 'Pinterest',
		'fa fa-pinterest-p' => 'Pinterest P',
		'fa fa-pinterest-square' => 'Pinterest Square',
		'fa fa-product-hunt' => 'Product Hunt',
		'fa fa-qq' => 'QQ',
		'fa fa-rebel' => 'Rebel Alliance (ra)',
		'fa fa-reddit' => 'Reddit Logo',
		'fa fa-reddit-alien' => 'Reddit Alien',
		'fa fa-reddit-square' => 'Reddit Square',
		'fa fa-renren' => 'Renren',
		'fa fa-scribd' => 'Scribd',
		'fa fa-sellsy' => 'Sellsy',
		'fa fa-share-alt' => 'Share Alt',
		'fa fa-share-alt-square' => 'Share Alt Square',
		'fa fa-shirtsinbulk' => 'Shirts in Bulk',
		'fa fa-simplybuilt' => 'SimplyBuilt',
		'fa fa-skyatlas' => 'Skyatlas',
		'fa fa-skype' => 'Skype',
		'fa fa-slack' => 'Slack Logo',
		'fa fa-slideshare' => 'Slideshare',
		'fa fa-soundcloud' => 'SoundCloud',
		'fa fa-spotify' => 'Spotify',
		'fa fa-stack-exchange' => 'Stack Exchange',
		'fa fa-stack-overflow' => 'Stack Overflow',
		'fa fa-steam' => 'Steam',
		'fa fa-steam-square' => 'Steam Square',
		'fa fa-stumbleupon' => 'StumbleUpon Logo',
		'fa fa-stumbleupon-circle' => 'StumbleUpon Circle',
		'fa fa-tencent-weibo' => 'Tencent Weibo',
		'fa fa-trello' => 'Trello',
		'fa fa-tumblr' => 'Tumblr',
		'fa fa-tumblr-square' => 'Tumblr Square',
		'fa fa-twitch' => 'Twitch',
		'fa fa-twitter' => 'Twitter',
		'fa fa-twitter-square' => 'Twitter Square',
		'fa fa-usb' => 'USB',
		'fa fa-viacoin' => 'Viacoin',
		'fa fa-vimeo-square' => 'Vimeo Square',
		'fa fa-vine' => 'Vine',
		'fa fa-vk' => 'VK',
		'fa fa-weibo' => 'Weibo',
		'fa fa-weixin' => 'Weixin (WeChat) (wechat)',
		'fa fa-whatsapp' => 'What\'s App',
		'fa fa-windows' => 'Windows',
		'fa fa-wordpress' => 'WordPress Logo',
		'fa fa-xing' => 'Xing',
		'fa fa-xing-square' => 'Xing Square',
		'fa fa-yahoo' => 'Yahoo Logo',
		'fa fa-yelp' => 'Yelp',
		'fa fa-youtube' => 'YouTube',
		'fa fa-youtube-play' => 'YouTube Play',
		'fa fa-youtube-square' => 'YouTube Square',
		'fa fa-ambulance' => 'Ambulance',
		'fa fa-h-square' => 'H Square',
		'fa fa-heart' => 'Heart',
		'fa fa-heart-o' => 'Heart Outlined',
		'fa fa-heartbeat' => 'Heartbeat',
		'fa fa-hospital-o' => 'Hospital Outlined',
		'fa fa-medkit' => 'Medkit',
		'fa fa-plus-square' => 'Plus Square',
		'fa fa-stethoscope' => 'Stethoscope',
		'fa fa-user-md' => 'User-md',
		'fa fa-wheelchair' => 'Wheelchair',
	);
	return $booty_awesome;
}
