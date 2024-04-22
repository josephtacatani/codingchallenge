<?php
/*
Plugin Name: Monster Group Leads Plugin
Description: A plugin to capture leads via a custom form and store them in the database.
Version: 1.0
Author: CodingChallenge
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function mg_enqueue_styles() {
    wp_enqueue_style('mg-styles', plugin_dir_url(__FILE__) . 'mg-styles.css');
}

add_action('wp_enqueue_scripts', 'mg_enqueue_styles');

function mg_enqueue_admin_styles($hook) {
    // Load only on ?page=mg_leads
    if($hook != 'toplevel_page_mg_leads') {
        return;
    }
    wp_enqueue_style('mg-admin-styles', plugin_dir_url(__FILE__) . 'mg-admin-styles.css');
}

add_action('admin_enqueue_scripts', 'mg_enqueue_admin_styles');



function mg_activate() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'leads';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name tinytext NOT NULL,
        email varchar(50) NOT NULL,
        phone varchar(20) NOT NULL,
        service varchar(50) NOT NULL,
        time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook( __FILE__, 'mg_activate' );

function mg_leads_form() {
    $content = '<form class="mg-form" action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">
    <p>We\'d love to help, leave us help, leave us your details and well be in touch.</p>
    <p><label>Name</label>
    <input type="text" name="mg-name" value="' . ( isset( $_POST["mg-name"] ) ? esc_attr( $_POST["mg-name"] ) : '' ) . '" /></p>
    <p><label>Email</label>
    <input type="email" name="mg-email" value="' . ( isset( $_POST["mg-email"] ) ? esc_attr( $_POST["mg-email"] ) : '' ) . '" /></p>
    <p><label>Phone number</label>
    <input type="text" name="mg-phone" value="' . ( isset( $_POST["mg-phone"] ) ? esc_attr( $_POST["mg-phone"] ) : '' ) . '" /></p>
    <p><label>Service Required </label>
    <select name="mg-service">
        <option value="Electricity">Electricity</option>
        <option value="Internet">Internet</option>
        <option value="Solar">Solar</option>
    </select></p>
    <p><input type="submit" name="mg-submitted" value="Send"></p>
    </form>';

    return $content;
}


add_shortcode('mg_leads_form', 'mg_leads_form');


function mg_capture_lead() {
    if ( isset( $_POST['mg-submitted'] ) ) {
        global $wpdb;
        
        $name    = sanitize_text_field( $_POST["mg-name"] );
        $email   = sanitize_email( $_POST["mg-email"] );
        $phone   = sanitize_text_field( $_POST["mg-phone"] );
        $service = sanitize_text_field( $_POST["mg-service"] );
        
        $table_name = $wpdb->prefix . 'leads';
        
        $inserted = $wpdb->insert( 
            $table_name, 
            array( 
                'name' => $name, 
                'email' => $email, 
                'phone' => $phone, 
                'service' => $service
            ) 
        );
        
        if($inserted) {
            echo '<script type="text/javascript">';
            echo 'alert("Thank you for your submission!");';
            echo 'window.location.href = "'.esc_url($_SERVER['REQUEST_URI']).'";';
            echo '</script>';
        } else {
            echo '<p>Submission failed. Please try again.</p>';
        }
    }
}


add_action('wp_head', 'mg_capture_lead');

function mg_admin_menu() {
    add_menu_page(
        'Leads', // Page title
        'Leads', // Menu title
        'manage_options', // Capability
        'mg_leads', // Menu slug
        'mg_display_leads', // Function to display the admin page
        'dashicons-list-view', // Icon URL
        6 // Position
    );
}

add_action('admin_menu', 'mg_admin_menu');



function mg_display_leads() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'leads';
    $leads = $wpdb->get_results("SELECT * FROM $table_name ORDER BY time DESC");

    if ($leads) {
        echo '<div class="wrap"><h2>Lead Entries</h2><table class="wp-list-table widefat fixed striped">';
        // Header row without the ID
        echo '<thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Service</th><th>Time</th></tr></thead>';
        echo '<tbody>';
        foreach ( $leads as $lead ) {
            echo '<tr>';
            // Data rows without the ID
            echo '<td>' . esc_html($lead->name) . '</td>';
            echo '<td>' . esc_html($lead->email) . '</td>';
            echo '<td>' . esc_html($lead->phone) . '</td>';
            echo '<td>' . esc_html($lead->service) . '</td>';
            echo '<td>' . esc_html($lead->time) . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table></div>';
    } else {
        echo '<div class="wrap"><h2>No leads found</h2></div>';
    }
}
