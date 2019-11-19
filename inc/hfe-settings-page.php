<?php
/**
 * Settings page for compatibility options.
 *
 * @package header-footer-elementor
 */

echo '<h1 class="wp-heading-inline">';
esc_attr_e( 'Elementor Header Footer ' , 'header-footer-elementor' );
echo '</h1>';

	?><h2 class="nav-tab-wrapper">
			<?php
			$tabs = array(
				'hfe_templates' => array(
					'name' => __( 'All templates', 'header-footer-elementor' ),
					'url'  => admin_url( 'edit.php?post_type=elementor-hf' ),
				),
				'hfe_settings' => array(
					'name' => __( 'Settings', 'header-footer-elementor' ),
					'url'  => admin_url( 'admin.php?page=Settings-page' ),
				),
			);

			$tabs       = apply_filters( 'edd_add_ons_tabs', $tabs );
			$active_tab = isset( $_GET['page'] ) && $_GET['page'] === 'Settings-page' ? 'hfe_settings':'hfe_templates';
			foreach( $tabs as $tab_id => $tab ) {

				$active = $active_tab == $tab_id ? ' nav-tab-active' : '';

				echo '<a href="' . esc_url( $tab['url'] ) . '" class="nav-tab' . $active . '">';
				echo esc_html( $tab['name'] );
				echo '</a>';
			}

			?>
		</h2>
		<br />
		<?php
$hfe_radio_button = get_option( 'hfe_all_theme_support_option', '1' );
wp_enqueue_style( 'hfe-admin-style', HFE_URL . 'admin/assets/css/ehf-admin.css', [], HFE_VER );

 function display_options()
    {
        //section name, display name, callback to print description of section, page to which section is attached.
        add_settings_section("header_section", "Header Options", "display_header_options_content", "theme-options");

        //setting name, display name, callback to print form element, page in which field is displayed, section to which it belongs.
        //last field section is optional.
        add_settings_field("header_logo", "Logo Url", "display_logo_form_element", "theme-options", "header_section");
        add_settings_field("advertising_code", "Ads Code", "display_ads_form_element", "theme-options", "header_section");

        //section name, form element name, callback for sanitization
        register_setting("header_section", "header_logo");
        register_setting("header_section", "advertising_code");
    }

    function display_header_options_content(){echo "The header of the theme";}
    function display_logo_form_element()
    {
        //id and name of form element should be same as the setting name.
        ?>
            <input type="text" name="header_logo" id="header_logo" value="<?php echo get_option('header_logo'); ?>" />
        <?php
    }
    function display_ads_form_element()
    {
        //id and name of form element should be same as the setting name.
        ?>
            <input type="text" name="advertising_code" id="advertising_code" value="<?php echo get_option('advertising_code'); ?>" />
        <?php
    }

    //this action is executed after loads its core, after registering all actions, finds out what page to execute and before producing the actual output(before calling any action callback)
    add_action("admin_init", "display_options");