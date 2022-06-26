<?php 

function getCheckedValue($value) {
    $options = get_option('dewordpressify_settings');
    return isset($options[$value]) ? 'checked' : '';
}

function getInputString($value) {
    $options = get_option('dewordpressify_settings');
    return $options[$value];
}

function dewordpressify_admin_menu() {
    add_options_page('DeWordPressify', 'DeWordPressify', 'manage_options', 'dewordpressify', 'options_page');
}

// adds script.js to settings page
add_action('admin_enqueue_scripts', 'enqueue_script');
function enqueue_script($hook_suffix) {
    // if not settings page
    if ($hook_suffix != 'settings_page_dewordpressify') return;

    $handle = 'dewordpressify';
    wp_register_script($handle, plugin_dir_url( __FILE__ ) . '/script.js');
    wp_enqueue_script($handle);
} 


function options_page() { ?>
    <form action='options.php' method='post'>

        <h2>DeWordPressify</h2>

        <?php
            settings_fields('dewordpressify');
            do_settings_sections('dewordpressify');
            submit_button();
        ?>

    </form>
<?php }

function getSectionDescription() {
    echo __('This Section Description', 'wordpress');
}

function dewordpressify_settings_init() {
    register_setting('dewordpressify', 'dewordpressify_settings');

    add_settings_section(
        'dewordpressify_section',
        __('Our Section Title', 'wordpress'),
        'getSectionDescription',
        'dewordpressify'
    );

    add_settings_field(
        'thank_you',
        __('Hide thank you sentence in admin footer', 'wordpress'),
        'thank_you',
        'dewordpressify',
        'dewordpressify_section'
    );

    add_settings_field(
        'footer_version',
        __('Hide WordPress version number in footer', 'wordpress'),
        'footer_version',
        'dewordpressify',
        'dewordpressify_section'
    );

    add_settings_field(
        'adminbar_logo',
        __('Hide WordPress admin bar logo', 'wordpress'),
        'adminbar_logo',
        'dewordpressify',
        'dewordpressify_section'
    );

    add_settings_field(
        'dashboard_news',
        __('Disable news and events widget in dashboard', 'wordpress'),
        'dashboard_news',
        'dewordpressify',
        'dewordpressify_section'
    );

    add_settings_field(
        'login_logo',
        __('Remove logo on login page', 'wordpress'),
        'login_logo',
        'dewordpressify',
        'dewordpressify_section'
    );

    add_settings_field(
        'emojis',
        __('Remove integrated emojis', 'wordpress'),
        'emojis',
        'dewordpressify',
        'dewordpressify_section'
    );

    add_settings_field(
        'rss',
        __('Remove integrated RSS feed', 'wordpress'),
        'rss',
        'dewordpressify',
        'dewordpressify_section'
    );

    add_settings_field(
        'comments',
        __('Disable comments', 'wordpress'),
        'comments',
        'dewordpressify',
        'dewordpressify_section'
    );

    add_settings_field(
        'css',
        __('Disable global inline styles', 'wordpress'),
        'css',
        'dewordpressify',
        'dewordpressify_section'
    );

    add_settings_field(
        'head',
        __('Remove unnecessary code in <head>', 'wordpress'),
        'head',
        'dewordpressify',
        'dewordpressify_section'
    );

    add_settings_field(
        'email_from',
        __('Change the "From" text of emails sent by your site.', 'wordpress'),
        'email_from',
        'dewordpressify',
        'dewordpressify_section'
    );
}

function thank_you() { ?>
    <input <?php echo getCheckedValue('thank_you') ?> type="checkbox" id="dewordpressify_settings[thank_you]" name="dewordpressify_settings[thank_you]">
    
    <input type='text' placeholder='Set your own phrase' name='dewordpressify_settings[thankyou_string]' value='<?php echo getInputString('thankyou_string') ?>'>
<?php }

function footer_version() { ?>
    <input <?php echo getCheckedValue('footer_version') ?> type='checkbox' name='dewordpressify_settings[footer_version]'>

    <input type='text' placeholder='Set your own phrase' name='dewordpressify_settings[version_string]' value='<?php echo getInputString('version_string') ?>'>
<?php }

function adminbar_logo() { ?>
    <input <?php echo getCheckedValue('adminbar_logo') ?> type='checkbox' name='dewordpressify_settings[adminbar_logo]'>
<?php }

function dashboard_news() { ?>
    <input <?php echo getCheckedValue('dashboard_news') ?> type='checkbox' name='dewordpressify_settings[dashboard_news]'>
<?php }

function login_logo() { ?>
    <input <?php echo getCheckedValue('login_logo') ?> type='checkbox' name='dewordpressify_settings[login_logo]'>
<?php }

function emojis() { ?>
    <input <?php echo getCheckedValue('emojis') ?> type='checkbox' name='dewordpressify_settings[emojis]'>
<?php }

function rss() { ?>
    <input <?php echo getCheckedValue('rss') ?> type='checkbox' name='dewordpressify_settings[rss]'>
<?php }

function comments() { ?>
    <input <?php echo getCheckedValue('comments') ?> type='checkbox' name='dewordpressify_settings[comments]'>
<?php }

function css() { ?>
    <input <?php echo getCheckedValue('css') ?> type='checkbox' name='dewordpressify_settings[css]'>
<?php }

function head() { ?>
    <input <?php echo getCheckedValue('head') ?> type='checkbox' name='dewordpressify_settings[head]'>
<?php }

function email_from() { ?>
    <input type='text' placeholder='Set your own name' name='dewordpressify_settings[email_from]' value='<?php echo getInputString('email_from') ?>'>
<?php }

add_action('admin_menu', 'dewordpressify_admin_menu');
add_action('admin_init', 'dewordpressify_settings_init');