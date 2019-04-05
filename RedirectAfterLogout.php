<?php


namespace AccessManagement;


class RedirectAfterLogout {


	private $priority;
	private $redirect_url;


	/**
	 * @param int $priority
	 * @param $redirect_url
	 */
	public function __construct( $redirect_url = '', $priority = 10 ) {
		$this->priority     = $priority;
		$this->redirect_url = $redirect_url;
	}


	public function init() {
		add_action( 'wp_logout', [ $this, '_redirect_on_logout' ], $this->priority );
	}


	public function _redirect_on_logout() {
		if ( $this->redirect_url ) {
			wp_redirect( $this->redirect_url );
			exit();
		}
	}


	public function disable() {
		remove_action( 'wp_logout', [ $this, '_redirect_on_logout' ], $this->priority );
	}


	public function set_redirect_url( $url ) {
		$this->redirect_url = $url;
	}


	public function set_priority( $priority ) {
		$this->redirect_url = intval( $priority );
	}


}