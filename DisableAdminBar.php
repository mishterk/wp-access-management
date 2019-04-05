<?php


namespace AccessManagement;


use AccessManagement\Traits\IsHooked;
use WPValetBoilerplate\Debug;


class DisableAdminBar {
	use IsHooked;


	private $show_for_user_ids = [];
	private $show_for_roles = [];
	private $show_for_capabilities = [];


	public function __construct() {
		$this->set_number_of_args( 1 );
	}


	public function show_for_user_id( $user_id ) {
		$this->show_for_user_ids = array_merge(
			$this->show_for_user_ids,
			(array) $user_id
		);
	}


	public function show_for_role( $user_role ) {
		$this->show_for_roles = array_merge(
			$this->show_for_roles,
			(array) $user_role
		);
	}


	public function show_for_capability( $capability ) {
		$this->show_for_capabilities = array_merge(
			$this->show_for_capabilities,
			(array) $capability
		);
	}


	public function init() {
		add_filter( 'show_admin_bar', [ $this, '_disable_toolbar' ], $this->priority, $this->number_of_args );
	}


	public function disable() {
		remove_filter( 'show_admin_bar', [ $this, '_disable_toolbar' ], $this->priority );
	}


	public function _disable_toolbar( $show_admin_bar ) {
		$show_admin_bar = false;

		$current_user = wp_get_current_user();

		if ( $this->show_for_user_ids and $this->user_has_id( $current_user ) ) {
			return true;
		}

		if ( $this->show_for_roles and $this->user_has_role( $current_user ) ) {
			return true;
		}

		if ( $this->show_for_capabilities and $this->user_has_capability( $current_user ) ) {
			return true;
		}

		return $show_admin_bar;
	}


	private function user_has_id( \WP_User $user ) {
		return (bool) in_array( $user->ID, $this->show_for_user_ids );
	}


	/**
	 * @param \WP_User $user
	 *
	 * @return bool
	 */
	private function user_has_role( \WP_User $user ) {
		return (bool) array_intersect( $user->roles, $this->show_for_roles );
	}


	/**
	 * @param \WP_User $user
	 *
	 * @return bool
	 */
	private function user_has_capability( \WP_User $user ) {
		foreach ( array_unique( $this->show_for_capabilities ) as $capability ) {
			if ( $user->has_cap( $capability ) ) {
				return true;
			}
		}

		return false;
	}


}