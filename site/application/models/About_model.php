<?php
class About_model extends CI_Model {

	public function __construct()
	{
		//
	}

	/**
	 * Get data for About page
	 *
	 * @return array of about data
	 *
	 * @author Vasilesk
	 **/
	public function get_about_data()
	{
		$about_upper = '<br />
			Read about my features below';
		$features = [
			'My feature 1',
			'My feature 2',
			'My feature 3'
		];
		return ['about_upper' => $about_upper, 'features' => $features];
	}
}
