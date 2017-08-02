<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Email_Customer_On_Hold_Order', false ) ) :

/**
 * Customer On-hold Order Email.
 *
 * An email sent to the customer when a new order is on-hold for.
 *
 * @class       WC_Email_Customer_On_Hold_Order
 * @version     2.6.0
 * @package     WooCommerce/Classes/Emails
 * @author      WooThemes
 * @extends     WC_Email
 */
class WC_Email_Customer_On_Hold_Order extends WC_Email {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id               = 'customer_on_hold_order';
		$this->customer_email   = true;
<<<<<<< HEAD

		$this->title            = __( 'Order on-hold', 'woocommerce' );
		$this->description      = __( 'This is an order notification sent to customers containing order details after an order is placed on-hold.', 'woocommerce' );
=======
		$this->title            = __( 'Order on-hold', 'woocommerce' );
		$this->description      = __( 'This is an order notification sent to customers containing order details after an order is placed on-hold.', 'woocommerce' );
		$this->heading          = __( 'Thank you for your order', 'woocommerce' );
		$this->subject          = __( 'Your {site_title} order receipt from {order_date}', 'woocommerce' );
>>>>>>> bbfbbb9c81f9c36cbaa8e67ea4b62e0932d77aed
		$this->template_html    = 'emails/customer-on-hold-order.php';
		$this->template_plain   = 'emails/plain/customer-on-hold-order.php';

		// Triggers for this email
		add_action( 'woocommerce_order_status_pending_to_on-hold_notification', array( $this, 'trigger' ), 10, 2 );
		add_action( 'woocommerce_order_status_failed_to_on-hold_notification', array( $this, 'trigger' ), 10, 2 );

		// Call parent constructor
		parent::__construct();
	}

	/**
<<<<<<< HEAD
	 * Get email subject.
	 *
	 * @since  3.1.0
	 * @return string
	 */
	public function get_default_subject() {
		return __( 'Your {site_title} order receipt from {order_date}', 'woocommerce' );
	}

	/**
	 * Get email heading.
	 *
	 * @since  3.1.0
	 * @return string
	 */
	public function get_default_heading() {
		return __( 'Thank you for your order', 'woocommerce' );
	}

	/**
=======
>>>>>>> bbfbbb9c81f9c36cbaa8e67ea4b62e0932d77aed
	 * Trigger the sending of this email.
	 *
	 * @param int $order_id The order ID.
	 * @param WC_Order $order Order object.
	 */
	public function trigger( $order_id, $order = false ) {
		if ( $order_id && ! is_a( $order, 'WC_Order' ) ) {
			$order = wc_get_order( $order_id );
		}

		if ( is_a( $order, 'WC_Order' ) ) {
			$this->object       = $order;
			$this->recipient    = $this->object->get_billing_email();

			$this->find['order-date']      = '{order_date}';
			$this->find['order-number']    = '{order_number}';

			$this->replace['order-date']   = wc_format_datetime( $this->object->get_date_created() );
			$this->replace['order-number'] = $this->object->get_order_number();
		}

		if ( ! $this->is_enabled() || ! $this->get_recipient() ) {
			return;
		}

<<<<<<< HEAD
		$this->setup_locale();
		$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
		$this->restore_locale();
=======
		$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
>>>>>>> bbfbbb9c81f9c36cbaa8e67ea4b62e0932d77aed
	}

	/**
	 * Get content html.
	 *
	 * @access public
	 * @return string
	 */
	public function get_content_html() {
		return wc_get_template_html( $this->template_html, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => false,
			'plain_text'    => false,
			'email'         => $this,
		) );
	}

	/**
	 * Get content plain.
	 *
	 * @access public
	 * @return string
	 */
	public function get_content_plain() {
		return wc_get_template_html( $this->template_plain, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => false,
			'plain_text'    => true,
			'email'			=> $this,
		) );
	}
}

endif;

return new WC_Email_Customer_On_Hold_Order();
