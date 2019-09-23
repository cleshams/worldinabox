<?php
function get_breadcrumbs($unit, $title)
{
    echo '<a href="'.HOME_URI.'/dashboard">Dashboard</a>';
    echo ' > ';
    echo '<a href="'.HOME_URI.'/dashboard/unit-'.$unit->slug.'">'.$unit->name.'</a>';
    echo ' > ';
    echo '<span>'.$title.'</span>';
}

add_filter('woocommerce_account_menu_items', 'change_available_links', 1000, 2);

function change_available_links($menu_items, $menu_endpoints)
{
    
    unset($menu_items['dashboard']);
    $account = array('dashboard' => 'Account');
    $dash = array('custom' => 'Dashboard');
    $menu_items = $account + $dash + $menu_items;
    return $menu_items;
}


add_filter( 'woocommerce_login_redirect', 'dashboard_login_redirect', 10, 2 );

function dashboard_login_redirect($redirect, $user)
{
    $redirect_page_id = url_to_postid( $redirect );
    $checkout_page_id = wc_get_page_id( 'checkout' );
    if( $redirect_page_id == $checkout_page_id ) {
		return $redirect;
    }
    return get_site_url() . '/dashboard';
}