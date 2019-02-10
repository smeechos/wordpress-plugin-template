<?php

class WP_Plugin_Template_Admin_Settings
{
    private $options, $plugin_name, $plugin_menu;

    /**
     * Admin_Settings constructor.
     */
    public function __construct()
    {
        // Actions
        add_action( 'admin_menu', array( $this, 'settings_page' ) );
        add_action( 'admin_init', array( $this, 'add_settings' ) );

        // Filters
        add_filter( 'plugin_action_links_' . PLUGIN_BASE_NAME, array( $this, 'add_settings_link' ) );

        $this->plugin_name = 'WP_Plugin Template';
        $this->plugin_menu = 'WP_Plugin Template';
    }

    /**
     * Adds a link to this plugin's settings page on the plugins overview page.
     *
     * @param array $links The current list of links on the plugins overview page.
     * @return mixed The links to show on the plugins overview page.
     */
    public function add_settings_link( $links ) {
        $addtional_links = array(
            '<a href="admin.php?page=' . PLUGIN_SLUG_NAME . '">' . __('Settings', PLUGIN_SLUG_NAME) . '</a>',
        );
        return array_merge( $links, $addtional_links );
    }

    /**
     * Adds menu item to the dashboard.
     */
    public function settings_page() {
        add_menu_page(
            $this->plugin_name,
            $this->plugin_menu,
            'manage_options',
            PLUGIN_SLUG_NAME,
            array( $this, 'settings_page_markup' ),
            'dashicons-wordpress-alt',
            100
        );
    }

    /**
     * Includes the markup for the settings page.
     */
    public function settings_page_markup() {
        include( PLUGIN_ROOT_DIR . 'templates/admin-settings.php' );
    }

    /**
     * Adds to the options table for our plugin.
     */
    public function add_options() {
        if ( !get_option( PLUGIN_SLUG_NAME . '_option' ) ) {
            add_option( PLUGIN_SLUG_NAME . '_option', $this->plugin_name );
        }

        $this->options = get_option( PLUGIN_SLUG_NAME . '_settings' );

        // TODO: add sections and fields via the settings API

        $sections = [
            'example_section' => 'Example Section'
        ];

        foreach ( $sections as $key => $value ) {
            add_settings_section(
                PLUGIN_SLUG_NAME . '_' . $key,
                __( $value, PLUGIN_SLUG_NAME),
                array( $this, PLUGIN_SLUG_NAME . '_' . $key . '_display' ),
                PLUGIN_SLUG_NAME
            );
        }

        $content_fields = [
            'example_field' => 'Example Content'
        ];

        foreach ( $content_fields as $key => $value) {
            // Gets the section based off of the field prefix
            $type = explode('_', $key);

            add_settings_field(
                PLUGIN_SLUG_NAME . '_' . $key,
                __( $value, PLUGIN_SLUG_NAME ),
                array( $this, PLUGIN_SLUG_NAME . '_' . $key . '_display' ),
                PLUGIN_SLUG_NAME,
                PLUGIN_SLUG_NAME . '_' . $type[0] . '_section'
            );
        }

        register_setting(
            PLUGIN_SLUG_NAME . '_settings',
            PLUGIN_SLUG_NAME . '_settings'
        );
    }

    /**
     * Displays a section.
     */
    public function wpplugintemplate_example_section_display() {
        esc_html_e( 'Example description for a section.', PLUGIN_SLUG_NAME);
    }

    /**
     * Displays a field for a section.
     */
    public function wpplugintemplate_example_field_display() {
        $text = '';

        if ( isset( $this->options['example_field'] ) ) {
            $text = esc_html( $this->options['example_field'] );
        }

        echo '<input class="regular-text" type="text" name="' . PLUGIN_SLUG_NAME . '_settings[example_field]" value="' . $text  .'">';
    }
}

// Initialize Settings
new WP_Plugin_Template_Admin_Settings();