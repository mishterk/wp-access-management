<?php


namespace AccessManagement\Traits;


trait IsHooked {

	protected $priority = 10;
	protected $number_of_args = 0;

	/**
	 * @param int $priority
	 */
	public function set_priority( int $priority ) {
		$this->priority = $priority;
	}

	/**
	 * @param int $number_of_args
	 */
	public function set_number_of_args( int $number_of_args ) {
		$this->number_of_args = $number_of_args;
	}

}