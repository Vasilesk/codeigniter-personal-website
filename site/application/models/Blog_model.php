<?php
class Blog_model extends CI_Model {

	private $_posts_per_page = 10;

	private $_posts_table = 'blogposts';
	private $_mainpage_status = 2;
	private $_published_status = 1;
	private $_hidden_status = 0;

	private $_posts_count;
	private $_max_node_number;

	public function __construct()
	{
		$this->load->database();

		$query = $this->db->select('COUNT(*)')
						  ->where('status', $this->_mainpage_status)
						  ->get($this->_posts_table);

		$this->_posts_count = $query->row()->count;

		$query = $this->db->select('MAX(id)')
						  ->get($this->_posts_table);

		$this->_max_node_number = $query->row()->max;
	}

	/**
	 * Get data for post of Blog
	 *
	 * @param int $post_id - id of a post
	 * @param bool $time_seconds - flag for seconds in created_time
	 * @return array of post data
	 *
	 * @author Vasilesk
	 **/
	public function get_post_data($post_id, $time_seconds)
	{
		if($time_seconds)
		{
			$time_format = 'HH24:MI:SS YYYY-MM-DD';
		}
		else
		{
			$time_format = 'HH24:MI YYYY-MM-DD';
		}

		$query = $this->db->select('id, title, text_summary, text_main, status, to_char(created, \''. $time_format .'\')')
						  ->where('id', $post_id)
						  ->where_in('status', [$this->_mainpage_status, $this->_published_status])
						  ->limit(1)
						  ->get($this->_posts_table);

		if($query->num_rows() === 1)
		{
			$post_object = $query->row();
			$post = [
				'id' => $post_object->id,
				'title' => $post_object->title,
				'text_summary' => $post_object->text_summary,
				'text_main' => $post_object->text_main,
				'created' => $post_object->to_char
			];

			switch ($post_object->status) {
				case $this->_mainpage_status:
					$post['status'] = 'mainpage';
					break;

				case $this->_published_status:
					$post['status'] = 'published';
					break;

				default:
					$post['status'] = 'hidden';
					break;
			}
		}
		else
		{
			return ['post' => []];
		}

		return ['post' => $post];
	}

	/**
	 * Get data for edit post view
	 *
	 * @param mixed $post_id - post id or FALSE for empty data
	 * @return array of elements for edit form
	 *
	 * @author Vasilesk
	 **/
	public function get_edit_data($post_id)
	{
		if($post_id)
		{
			$post_data = $this->get_post_data($post_id, TRUE);
			$form_data['legend'] = 'Edit post: id ' . $post_id;
		}
		else {
			$post_data['post'] = [
				'title' => '',
				'text_summary' => '',
				'text_main' => '',
				'created' => gmdate("Y-m-d\TH:i:s\Z", time()),
				'status' => 'mainpage'
			];
			$form_data['legend'] = 'Create new post';
		}

		$form_data['field_title'] = [
			'name' => 'field_title',
			'id' => 'field_title',
			'class' => 'form-control',
			'required' => '',
			'placeholder' => 'Enter title',
			'value' => $post_data['post']['title']
		];

		$form_data['field_summary'] = [
			'name' => 'field_summary',
			'id' => 'field_summary',
			'class' => 'form-control',
			'required' => '',
			'cols' => '25',
			'rows' => '10',
			'placeholder' => 'Enter text...',
			'value' => $post_data['post']['text_summary']
		];

		$form_data['field_text'] = [
			'name' => 'field_text',
			'id' => 'field_text',
			'class' => 'form-control',
			'required' => '',
			'cols' => '25',
			'rows' => '25',
			'placeholder' => 'Enter text...',
			'value' => $post_data['post']['text_main']
		];

		$created_datetime = strtotime($post_data['post']['created']);
		$created_date = date('Y-m-d', $created_datetime);
		$created_time = date('H:i:s', $created_datetime);

		$form_data['field_created_date'] = [
			'type' => 'date',
			'name' => 'field_created_date',
			'id' => 'field_created_date',
			'class' => 'form-control',
			'required' => '',
			'value' => $created_date
		];

		$form_data['field_created_time'] = [
			'type' => 'time',
			'name' => 'field_created_time',
			'id' => 'field_created_time',
			'class' => 'form-control',
			'required' => '',
			'value' => $created_time
		];

		$form_data['field_status'] = [
			'options' => [
				'hidden' => 'Hidden',
				'published' => 'Published',
				'mainpage' => 'On main page'
			],
			'chosen' => $post_data['post']['status'],
			'extra' => [
				'class' => 'form-control'
			]
		];

		$form_data['send_button'] = [
			'value' => 'Send',
			'class' => 'btn btn-primary'
		];

		return $post_data + $form_data;
	}

	/**
	 * Get data for page of Blog
	 *
	 * @return array of page data
	 *
	 * @author Vasilesk
	 **/
	public function get_page_data($page_number)
	{
		$offset = ($page_number - 1) * $this->_posts_per_page;
		$query = $this->db->select('id, title, text_summary, to_char(created, \'YYYY-MM-DD\')')
						  ->where('status', $this->_mainpage_status)
						  ->order_by('id', 'DESC')
						  ->limit($this->_posts_per_page, $offset)
						  ->get($this->_posts_table);

		$posts = [];
		foreach ($query->result() as $post) {
			$posts[] = [
				'id' => $post->id,
				'title' => $post->title,
				'text_summary' => $post->text_summary,
				'created' => $post->to_char
			];
		}
		return ['posts' => $posts];
	}

	/**
	 * Edit a post of Blog or create a new one with data from input
	 *
	 * @param mixed $post_id - post id or FALSE for new post creation
	 * @return void
	 *
	 * @author Vasilesk
	 **/
	public function edit_post($post_id)
	{
		$post_status = $this->input->post('field_status');
		switch ($post_status) {
			case 'mainpage':
				$post_status = $this->_mainpage_status;
				break;

			case 'published':
				$post_status = $this->_published_status;
				break;

			default:
				$post_status = $this->_hidden_status;
				break;
		}

		$datetime_str = $this->input->post('field_created_date') . ' ' . $this->input->post('field_created_time');
		$datetime = date_create_from_format('Y-m-d H:i', $datetime_str);

		$post_data = [
			'title' => $this->input->post('field_title'),
			'text_summary' => $this->input->post('field_summary'),
			'text_main' => $this->input->post('field_text'),
			'status' => $post_status,
			'created' => $datetime_str
		];

		if($post_id === FALSE)
		{
			$this->db->insert($this->_posts_table, $post_data);
		}
		else
		{
			$this->db->where('id', $post_id);
			$this->db->update($this->_posts_table, $post_data);
		}
	}

	/**
	 * Get Codeigniter pagination witn Bootstrap style
	 *
	 * @return string Codeigniter pagination
	 *
	 * @author Vasilesk
	 **/
	public function get_pagination()
	{
		$pagination_config = [];
        $pagination_config['base_url'] = '/blog/page/';
		$pagination_config['total_rows'] = $this->_posts_count;
		$pagination_config['per_page'] = $this->_posts_per_page;
		$pagination_config['first_link'] = '1st page';
		$pagination_config['last_link'] = 'Last page';
		$pagination_config['use_page_numbers'] = TRUE;
		$pagination_config['full_tag_open'] = '<ul class="pagination">'; // Bootstrap class 'pagination'
		$pagination_config['full_tag_close'] = '</ul>';
		$pagination_config['num_tag_open'] = '<li>';
		$pagination_config['num_tag_close'] = '</li>';
		$pagination_config['cur_tag_open'] = '<li class="active"><a href="#">'; // <a> for using Bootstrap class 'active'
		$pagination_config['cur_tag_close'] = '</a></li>';
		$pagination_config['prev_tag_open'] = '<li>';
		$pagination_config['prev_tag_close'] = '</li>';
		$pagination_config['next_tag_open'] = '<li>';
		$pagination_config['next_tag_close'] = '</li>';
		$pagination_config['first_tag_open'] = '<li>';
		$pagination_config['first_tag_close'] = '</li>';
		$pagination_config['last_tag_open'] = '<li>';
		$pagination_config['last_tag_close'] = '</li>';

		$this->pagination->initialize($pagination_config);

		return $this->pagination->create_links();
	}
}
