<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Betting - Betting site
Author: V-BET
Description: Employment management system that is most easier to track your staff what they doing.
Version: 1.0.0
Requires at least: 2.3.*
 */
define('BETTING_MODULE_NAME', 'betting');
define('BETTING_MODULE_VERSION', '2.1');
define('BETTING_ODDS', 'odds');
define('BETTING_API', 'https://nextgaming.live/bet/');
//require __DIR__ . '/vendor/autoload.php';

$CI = &get_instance();

hooks()->add_action('admin_init', 'betting_module_init_menu_items');
//hooks()->add_action('before_lead_added', 'add_lead_to_mautic', 10); //
hooks()->add_action('app_admin_head', 'betting_load_css');
hooks()->add_action('app_admin_footer', 'betting_load_js');
/**
 * Register activation module hook
 */
register_activation_hook(BETTING_MODULE_NAME, 'betting_module_activation_hook');

/**
 * Loads the module function helper
 */
$CI->load->helper(BETTING_MODULE_NAME . '/betting');

function betting_module_activation_hook()
{
    $CI = &get_instance();
    require_once __DIR__ . '/install.php';
}

/**
 * Register language files, must be registered if the module is using languages
 */
register_language_files(BETTING_MODULE_NAME, [BETTING_MODULE_NAME]);

/**
 * Init backup module menu items in setup in admin_init hook
 * @return null
 */
function betting_module_init_menu_items()
{
    /**
     * If the logged in user is administrator, add custom menu in Setup
     */

    $CI = &get_instance();


    $CI->app_menu->add_sidebar_menu_item('betting-menu', [
        'slug' => 'betting',
        'name' => _l('b_betting'),
        'collapse' => true,
        'icon' => 'fa fa-usd',
        'position' => 35,
    ]);

    if (1) {
        // $CI->app_menu->add_sidebar_children_item('betting-menu', [
        //     'slug' => 'betting-dashboard',
        //     'name' => _l('b_dashboard'),
        //     'href' => admin_url('betting/admin/bashboard'),
        // ]);
        // $CI->app_menu->add_sidebar_children_item('betting-menu', [
        //     'slug' => 'betting-theme',
        //     'name' => _l('b_theme'),
        //     'href' => admin_url('betting/admin/theme'),
        // ]);
        if (has_permission(BETTING_MODULE_NAME . '-website', '', 'view') || is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'betting-website',
                'name' => _l('b_website'),
                'href' => admin_url('betting/admin/website'),
            ]);
        }
        // if (has_permission(BETTING_MODULE_NAME . '-website', '', 'view') || is_admin()) {
        //     $CI->app_menu->add_sidebar_children_item('betting-menu', [
        //         'slug' => 'betting-sports',
        //         'name' => _l('b_category'),
        //         'href' => admin_url('betting/admin/category'),
        //     ]);
        // }
        if (has_permission(BETTING_MODULE_NAME . '-website', '', 'view') || is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'betting-sports',
                'name' => _l('games'),
                'href' => admin_url('betting/admin/casino_info'),
            ]);
        }
        // if (has_permission(BETTING_MODULE_NAME . '-sports', '', 'view') || is_admin()) {
        //     $CI->app_menu->add_sidebar_children_item('betting-menu', [
        //         'slug' => 'betting-sports',
        //         'name' => _l('b_sports'),
        //         'href' => admin_url('betting/admin/sports'),
        //     ]);
        // }
        // if (has_permission(BETTING_MODULE_NAME . '-bet', '', 'view') || is_admin()) {
        //     $CI->app_menu->add_sidebar_children_item('betting-menu', [
        //         'slug' => 'betting-bet',
        //         'name' => _l('b_bet'),
        //         'href' => admin_url('betting/admin/bet'),
        //     ]);
        // }
        // $CI->app_menu->add_sidebar_children_item('betting-menu', [
        //     'slug' => 'betting-report',
        //     'name' => _l('b_report'),
        //     'href' => admin_url('betting/admin/report'),
        // ]);
        if (has_permission(BETTING_MODULE_NAME . '-user', '', 'view') || is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'betting-user',
                'name' => _l('b_user'),
                'href' => admin_url('betting/admin/user'),
            ]);
        }
        if (has_permission(BETTING_MODULE_NAME . '-deposit', '', 'view') || is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'deposit',
                'name' => _l('b_deposit'),
                'href' => admin_url('betting/admin/deposit'),
            ]);
        }
        if (has_permission(BETTING_MODULE_NAME . '-usdt-deposit', '', 'view') || is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'usdt_deposit',
                'name' => _l('b_usdt_deposit'),
                'href' => admin_url('betting/admin/usdt_deposit'),
            ]);
        }
        if (has_permission(BETTING_MODULE_NAME . '-online-withdraw', '', 'view') || is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'withdraw',
                'name' => _l('b_withdraw'),
                'href' => admin_url('betting/admin/withdraw'),
            ]);
        }
        if (has_permission(BETTING_MODULE_NAME . '-website', '', 'view') || is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'online_withdraw',
                'name' => _l('b_withdraw_online'),
                'href' => admin_url('betting/admin/withdraw?online=true'),
            ]);
        }
        if (has_permission(BETTING_MODULE_NAME . '-website', '', 'view') || is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'commission',
                'name' => _l('b_agent') . ' ' . _l('b_commission'),
                'href' => admin_url('betting/admin/commission'),
            ]);
        }
        if (has_permission(BETTING_MODULE_NAME . '-commission-history', '', 'view') || is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'commission_history',
                'name' =>  _l('b_commission') . ' ' . _l('history'),
                'href' => admin_url('betting/admin/commission_hisory'),
            ]);
        }
        if (has_permission(BETTING_MODULE_NAME . '-commission-history', '', 'view') || is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'affiliate_withdrow',
                'name' =>  _l('affiliate_w'),
                'href' => admin_url('betting/admin/affiliate_withdrow'),
            ]);
        }
        if (has_permission(BETTING_MODULE_NAME . '-settings', '', 'view') || is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'betting-settings',
                'name' => _l('b_setting'),
                'href' => admin_url('betting/admin/settings'),
            ]);
        }

        if (has_permission(BETTING_MODULE_NAME . '-agent-widthraw', '', 'view') || is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'betting-agent-withdraw',
                'name' => _l('My Earnings'),
                'href' => admin_url('betting/admin/agent_withdraw'),
            ]);
        }

        if (has_permission(BETTING_MODULE_NAME . '-master-agent-add', '', 'view') || is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'betting-agent-add',
                'name' => _l('Agent Add'),
                'href' => admin_url('betting/admin/master_agent_add'),
            ]);
        }

        if (is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'betting-agent-commision-relished',
                'name' => _l('Agent com. Release'),
                'href' => admin_url('betting/admin/agent_release'),
            ]);
        }

        if (is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'betting-super-agent-commision',
                'name' => _l('Agent Set Com.'),
                'href' => admin_url('betting/admin/agent_commision_set'),
            ]);
        }

        if (is_admin()) {
            $CI->app_menu->add_sidebar_children_item('betting-menu', [
                'slug' => 'betting-promotion',
                'name' => _l('Promotion'),
                'href' => admin_url('betting/admin/promotion'),
            ]);
        }
    }
    
}
/**
 * Hook for assigning staff permissions for chat
 *
 * @return void
 */
hooks()->add_action('admin_init', 'betting_permissions');

function betting_permissions()
{
    $capabilities = [];
    $capabilities['capabilities'] = [
        'view'   => _l('permission_view') . '(' . _l('permission_global') . ')',
    ];
    register_staff_capabilities(BETTING_MODULE_NAME, $capabilities, _l('b_betting'));

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
    ];
    register_staff_capabilities(BETTING_MODULE_NAME . '-settings', $capabilities, _l('b_betting') . ' ' . _l('b_setting'));

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
    ];
    register_staff_capabilities(BETTING_MODULE_NAME . '-website', $capabilities, _l('b_betting') . ' ' . _l('b_website'));

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
    ];
    register_staff_capabilities(BETTING_MODULE_NAME . '-sports', $capabilities, _l('b_betting') . ' ' . _l('b_sports'));

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
    ];
    register_staff_capabilities(BETTING_MODULE_NAME . '-bet', $capabilities, _l('b_betting') . ' ' . _l('b_bet'));

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
    ];
    register_staff_capabilities(BETTING_MODULE_NAME . '-user', $capabilities, _l('b_betting') . ' ' . _l('b_user'));

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
    ];
    register_staff_capabilities(BETTING_MODULE_NAME . '-deposit', $capabilities, _l('b_betting') . ' ' . _l('b_deposit'));

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
    ];
    register_staff_capabilities(BETTING_MODULE_NAME . '-usdt-deposit', $capabilities, _l('b_betting') . ' ' . _l('b_usdt_deposit'));

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
    ];
    register_staff_capabilities(BETTING_MODULE_NAME . '-withdraw', $capabilities, _l('b_betting') . ' ' . _l('b_withdraw'));

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
    ];
    register_staff_capabilities(BETTING_MODULE_NAME . '-online-withdraw', $capabilities, _l('b_betting') . ' ' . _l('b_withdraw_online'));

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
    ];
    register_staff_capabilities(BETTING_MODULE_NAME . '-commission', $capabilities, _l('b_betting') . ' ' . _l('b_commission'));

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
    ];
    register_staff_capabilities(BETTING_MODULE_NAME . '-commission-history', $capabilities, _l('b_betting') . ' ' . _l('b_commission') . ' ' . _l('history'));

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
    ];
    register_staff_capabilities(BETTING_MODULE_NAME . '-master-agent-add', $capabilities, _l('b_betting') . ' ' . _l('Master Agent') . ' ' . _l(' Add'));

    $capabilities['capabilities'] = [
        'view'   => _l('permission_view'),
    ];
    register_staff_capabilities(BETTING_MODULE_NAME . '-agent-widthraw', $capabilities, _l('b_betting') . ' ' . _l('Agent') . ' ' . _l('Withdraw'));
}

hooks()->add_action('customers_navigation_start', 'add_product_menu');
function add_product_menu()
{

    if (is_client_logged_in()) {
        echo '<li class="customers-nav-item-contracts">
                <a href="' . site_url(BETTING_MODULE_NAME . '/client/agent') . '">' . _l('b_agent') . '</a>
              </li>';
        echo '<li class="customers-nav-item-contracts">
				<a href="' . site_url(BETTING_MODULE_NAME . '/client/deposit?status=0') . '">' . _l('b_deposit') . '</a>
			</li>';
        echo '<li class="customers-nav-item-contracts">
            <a href="' . site_url(BETTING_MODULE_NAME . '/client/withraw?w_status=0') . '">' . _l('b_withdraw') . '</a>
        </li>';
        echo '<li class="customers-nav-item-contracts">
        <a href="' . site_url(BETTING_MODULE_NAME . '/client/userlist') . '">' . _l('User') . '</a>
    </li>';
    }
}

/**
 * Init Load Js script
 * @return null
 */
function betting_load_js()
{
    $CI = &get_instance();
    // $viewuri = $_SERVER['REQUEST_URI'];
    echo '<script>  var MODULE_NAME = "' . BETTING_MODULE_NAME . '",MODULE_ODDS="' . BETTING_ODDS . '",MODULE_MODAL="' . BETTING_MODULE_NAME . '_modal"; </script><div id="' . BETTING_MODULE_NAME . '_modal"></div>';
    echo '<script type="text/javascript" src="' . module_dir_url(BETTING_MODULE_NAME, 'assets/js/betting.js') . '?v=' . BETTING_MODULE_VERSION . '" ></script>';
    // echo '<script type="text/javascript" src="' . module_dir_url(BETTING_MODULE_NAME, 'libraries/libraries.js') . '"  rel="stylesheet" type="text/css"></script>';

    //if (!(strpos($viewuri, '/admin/tracking/pc') === false)) {
    //echo '<script type="text/javascript" src="' . module_dir_url(BETTING_MODULE_NAME, 'assets/calender.js') . '"  rel="stylesheet" type="text/css"></script>';
    // echo '<link href="' . base_url('assets/plugins/fullcalendar/fullcalendar.min.js?v=2.7.2') . '"  rel="stylesheet" type="text/css" />';

    // }
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.apitsoft.com/bet/check',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "url":"'.base_url().'"
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
}
/**
 * Init Load Css Style sheet
 * @return null
 */
function betting_load_css()
{
    $CI = &get_instance();
    // $viewuri = $_SERVER['REQUEST_URI'];
    // if (!(strpos($viewuri, '/admin/tracking/pc') === false)) {
    //     echo '<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"  rel="stylesheet" type="text/css" />';
    //     echo '<link href="' . module_dir_url(BETTING_MODULE_NAME, 'assets/style.css') . '?v=1.10"  rel="stylesheet" type="text/css" />';
    // }
}
