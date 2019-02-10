<div class="wrap">
    <h1><?php esc_html_e( get_admin_page_title() ); ?></h1>

    <form method="post" action="options.php">
        <?php
        settings_fields( PLUGIN_SLUG_NAME . '_settings' );
        do_settings_sections( PLUGIN_SLUG_NAME );
        submit_button();
        ?>
    </form>
</div>