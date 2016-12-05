<?php
class Coding_model extends CI_Model {

	public function __construct()
	{
		//
	}

	/**
	 * Get data for Coding page
	 *
	 * @return array of Coding page data
	 *
	 * @author Vasilesk
	 **/
	public function get_coding_data()
	{
		$projects = [
			0 => [
				'name' => 'Project 1',
				'language' => 'Php',
				'status' => 'ready',
				'description' => 'My best project',
				'link' => [
					'href' => 'https://github.com/',
					'text' => 'github'
				],
			],

			1 => [
				'name' => 'Project 2',
				'language' => 'Python',
				'status' => 'redesign',
				'description' => 'Wanna change it a bit',
				'link' => [
					'href' => 'https://github.com/',
					'text' => 'github'
				],
			],

			2 => [
				'name' => 'Project 3',
				'language' => 'PHP',
				'status' => 'closed',
				'description' => 'I do not want to change it. It is closed.',
				'link' => [
					'href' => 'https://github.com/',
					'text' => 'github'
				],
			]
		];

		$data = [
			'projects' => $projects
		];

		return $data;
	}
}
