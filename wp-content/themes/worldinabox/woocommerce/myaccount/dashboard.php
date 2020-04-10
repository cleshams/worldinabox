<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<h2>Welcome 
    <?php
    $school = get_user_meta($current_user->ID,'school_org_name', true);
    echo $school;
    ?>
</h2>

<p><?php
	printf(
        __( 'From your account page you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
    ?></p>
<p><a href="../dashboard" class="btn btn--medium dashboard-link">Looking for the digital platform? Click here</a></p>
<p><strong>Active Minutes</strong><br>If you are looking to manage your active minutes or just to find out more about them click the link below.</p>
<a href="../dashboard/active-minutes" class="btn btn--medium dashboard-link">Go to Active Minutes</a>

<hr>

<?php
$resources = get_field('resources'); 
echo '<h3>Resources</h3>';
echo '<p>'.$resources['introduction'].'</p>';
echo '<div class="resources">';
    foreach ($resources['resources'] as $resource) {
        $title = $resource['title'];
        $file = $resource['file'];
        $description = $resource['description'];

        echo '
        <div class="resource">
            <p class="text__med-title">'.$title.'</p>
            <p>'.$description.'</p>
            <div>
                <a class="btn btn--small bg__blue" href="'.$file['url'].'" download>Download Resource</a>
            </div>
        </div>';
    }
    echo '</div>';
?>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
