<?php
class Main_model extends CI_Model {

	public function __construct()
	{
		//
	}

	/**
	 * Get data for tabs in menu and on Main page
	 *
	 *
	 * @return array of tabs data
	 *
	 * @author Vasilesk
	 **/
	public function get_title_tabs_data()
	{
		$tabs_data = [
			'main' => [
				'title' => 'Main page',
				'info' => 'Main page of my site',
				'pic' => 'home.png',
				'link' => [
					'href' => '/',
					'text' => 'Open'
				]
			],
			'about' => [
				'title' => 'About me',
				'info' => 'Something about me',
				'pic' => 'person.png',
				'link' => [
					'href' => '/about',
					'text' => 'Go'
				]
			],
			'blog' => [
				'title' => 'My blog',
				'info' => 'Blog of mine',
				'pic' => 'writing.png',
				'link' => [
					'href' => '/blog',
					'text' => 'Read'
				]
			],
			'coding' => [
				'title' => 'My code',
				'info' => 'Some projects',
				'pic' => 'progs.png',
				'link' => [
					'href' => '/coding',
					'text' => 'Go'
				]
			],
			'writeme' => [
				'title' => 'Write me',
				'info' => 'Here you can leave me a message',
				'pic' => 'writeme.png',
				'link' => [
					'href' => '/writeme',
					'text' => 'Write'
				]
			],
			'copyright' => [
				'title' => 'Copyright',
				'info' => 'Copyright info',
				'pic' => 'fav.png',
				'link' => [
					'href' => '#modal-copyright',
					'text' => 'Open'
				]
			]
		];

		return ['tabs' => $tabs_data];
	}

	/**
	 * Get data for copyright notice in modal window
	 *
	 * @return array of copyright notice data
	 *
	 * @author Vasilesk
	 **/
	public function get_copyright_data()
	{
		$text = '<p>Copyright text</p>';

		$copyright_data = [
			'title' => 'Copyright title',
			'subtitle' => 'Copyright subtitle',
			'text' => $text
		];

		return ['copyright' => $copyright_data];
	}
}
