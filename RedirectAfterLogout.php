<?php


namespace AccessManagement;


use AccessManagement\Traits\IsHooked;


class RedirectAfterLogout {
	use IsHooked;


	private $redirect_url;


	/**
	 * @param int $priority
	 * @param $redirect_url
	 */
	public function __construct( $redirect_url = '', $priority = 10 ) {
		$this->set_priority( $priority );
		$this->redirect_url = $redirect_url;
	}


	public function init() {
		add_action( 'wp_logout', [ $this, '_redirect_on_logout' ], $this->priority );
	}


	public function disable() {
		remove_action( 'wp_logout', [ $this, '_redirect_on_logout' ], $this->priority );
	}


	public function set_redirect_url( $url ) {
		$this->redirect_url = $url;
	}


	public function _redirect_on_logout() {
		if ( $this->redirect_url ) {
			wp_redirect( $this->redirect_url );
			exit();
		}
	}


}