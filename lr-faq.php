<?php

/**
 * Plugin Name: LR Faq
 * Version: 1.3
 * Description: LR Faq to the admin panel which allows you to show your faq on your website the easy with deffernt styles
 * Author: Logicrays
 * Author URI: http://logicrays.com/
 */

define("lr-faq", "lr_faq");
define('lr_faq_plugin_url', plugins_url('', __FILE__));
ini_set('allow_url_fopen', 1);

add_action('admin_menu', 'lr_faq_settings_page');

function lr_faq_settings_page()
{
    add_submenu_page('edit.php?post_type=lrfaq', __('Settings', 'lr-faq'), __('Settings', 'lr-faq'), 'manage_options', 'lr-faq-setting-page', 'lr_faq_setting_page');
}
add_action('plugin_action_links_' . plugin_basename(__FILE__), 'lr_faq_action_links');

function lr_faq_action_links($links)
{
    $links = array_merge(array(
        '<a href="' . esc_url(admin_url('/edit.php?post_type=lrfaq&page=lr-faq-setting-page')) . '">' . __('Settings', 'lr-faq') . '</a>'
    ), $links);
    return $links;
}

function lr_faq_setting_page()
{ ?>
    <div class="wrap">
        <div class="icon32" id="icon-options-general"><br>
        </div>
        <h3>LR Faq Options [Shortcode: [LRFAQ] ]</h3>
        <form action="options.php" method="post">
            <?php
            settings_fields("section");
            ?>
            <?php
            do_settings_sections("faq-options");
            submit_button();
            ?>
        </form>
    </div>
<?php
}
add_action("admin_init", "lr_faq_fields");
function lr_faq_fields()
{
    add_settings_section("section", "All Settings", null, "faq-options");
    add_settings_field("lr_faq_style", "Faq Style", "lr_faq_style_element", "faq-options", "section");
    add_settings_field("lr_faq_preview", "Preview Style", "lr_faq_preview_element", "faq-options", "section");
    register_setting("section", "lr_faq_style");
    register_setting("section", "lr_faq_preview");
}
function lrfaq_style()
{
    wp_enqueue_style('bootstrap-min', lr_faq_plugin_url . '/css/bootstrap.min.css');
    wp_enqueue_style('font-awesome-min', lr_faq_plugin_url . '/css/font-awesome.min.css');
    wp_enqueue_script('bootstrap-min', lr_faq_plugin_url . '/js/bootstrap.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'lrfaq_style');

include_once 'includes/lr-faq-style.php';

$lr_faq_style = get_option('lr_faq_style');

if ($lr_faq_style['lr_faq_style'] == '1') {
    add_action('wp_head', 'lrfaq_style1');
}
if ($lr_faq_style['lr_faq_style'] == '2') {
    add_action('wp_head', 'lrfaq_style2');
}
if ($lr_faq_style['lr_faq_style'] == '3') {
    add_action('wp_head', 'lrfaq_style3');
}
if ($lr_faq_style['lr_faq_style'] == '4') {
    add_action('wp_head', 'lrfaq_style4');
}
if ($lr_faq_style['lr_faq_style'] == '5') {
    add_action('wp_head', 'lrfaq_style5');
}
function lrfaq_style1()
{
    wp_enqueue_style('faq-style1', lr_faq_plugin_url . '/css/style1.css');
}
function lrfaq_style2()
{
    wp_enqueue_style('faq-style2', lr_faq_plugin_url . '/css/style2.css');
}
function lrfaq_style3()
{
    wp_enqueue_style('faq-style3', lr_faq_plugin_url . '/css/style3.css');
}
function lrfaq_style4()
{
    wp_enqueue_style('faq-style4', lr_faq_plugin_url . '/css/style4.css');
}
function lrfaq_style5()
{
    wp_enqueue_style('faq-style5', lr_faq_plugin_url . '/css/style5.css');
}
add_action('init', 'lr_faqs');
function lr_faqs()
{
    $labels = array(
        'name' => 'LR Faqs',
        'singular_name' => 'LR Faq',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New',
        'edit_item' => 'Edit Faq',
        'new_item' => 'New Faq',
        'view_item' => 'View Faq',
        'search_items' => 'Search Faqs',
        'not_found' =>  'No Faqs found',
        'not_found_in_trash' => 'No Faqs in the trash'
    );
    register_post_type('lrfaq', array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 10,
        'supports' => array('title', 'editor')
    ));
}

function lr_faq_style_element()
{
    $options = get_option('lr_faq_style');
?>
    <select id="lr_faq_style" name='lr_faq_style[lr_faq_style]'>
        <option value='1' <?php selected($options['lr_faq_style'], '1'); ?>><?php _e('Style 1', 'lr-faq'); ?></option>
        <option value='2' <?php selected($options['lr_faq_style'], '2'); ?>><?php _e('Style 2', 'lr-faq'); ?></option>
        <option value='3' <?php selected($options['lr_faq_style'], '3'); ?>><?php _e('Style 3', 'lr-faq'); ?></option>
        <option value='4' <?php selected($options['lr_faq_style'], '4'); ?>><?php _e('Style 4', 'lr-faq'); ?></option>
        <option value='5' <?php selected($options['lr_faq_style'], '5'); ?>><?php _e('Style 5', 'lr-faq'); ?></option>
    </select>
    <p>Please select style</p>
    <?php
}
function lr_faq_preview_element()
{

    $lr_faq_style = get_option('lr_faq_style');

    if ($lr_faq_style['lr_faq_style'] == '1') {
    ?>
        <img src="<?php echo lr_faq_plugin_url ?>/images/screenshot1.png" title="Style 1" width="600" />
    <?php
    }
    if ($lr_faq_style['lr_faq_style'] == '2') {
    ?>
        <img src="<?php echo lr_faq_plugin_url ?>/images/screenshot2.png" title="Style 2" width="600" />
    <?php
    }
    if ($lr_faq_style['lr_faq_style'] == '3') {
    ?>
        <img src="<?php echo lr_faq_plugin_url ?>/images/screenshot3.png" title="Style 3" width="600" />
    <?php
    }
    if ($lr_faq_style['lr_faq_style'] == '4') {
    ?>
        <img src="<?php echo lr_faq_plugin_url ?>/images/screenshot4.png" title="Style 4" width="600" />
    <?php
    }
    if ($lr_faq_style['lr_faq_style'] == '5') {
    ?>
        <img src="<?php echo lr_faq_plugin_url ?>/images/screenshot5.png" title="Style 5" width="600" />
<?php
    }
}
