<?php
class Writeme_model extends CI_Model {

	public function __construct()
	{
		$this->load->library('email');
		$config = Array(
			    'mailtype'  => 'html',
			    'charset'   => 'utf-8',
				'mailtype' => 'html',
				'wordwrap' => TRUE
			);

			$this->email->initialize($config);
	}

	/**
	 * Get data for Writeme form view
	 *
	 * @return array of form elements for Writeme form
	 *
	 * @author Vasilesk
	 **/
	public function get_writeme_form_data()
	{
		$data['sender_name'] = [
			'name' => 'sender_name',
			'id' => 'sender_name',
			'class' => 'form-control',
			'required' => '',
			'placeholder' => 'Enter your name',
		];

		$data['sender_email'] = [
			'name' => 'sender_email',
			'id' => 'sender_email',
			'class' => 'form-control',
			'placeholder' => 'Enter your email',
		];

		$data['message_text'] = [
			'name' => 'message_text',
			'id' => 'message_text',
			'class' => 'form-control',
			'required' => '',
			'cols' => '20',
			'placeholder' => 'Your message...',
		];

		$data['send_button'] = [
			'value' => 'Send',
			'class' => 'btn btn-primary'
		];

		return $data;
	}

	/**
	 * Send email with data from input
	 *
	 * @return void
	 *
	 * @author Vasilesk
	 **/
	public function send_email()
	{
		$data = array(
            'name' => $this->input->post('sender_name'),
            'email' => $this->input->post('sender_email'),
            'message' => $this->input->post('message_text'),
            'send_time' => time()
        );
		$data = $this->security->xss_clean($data);

		$html_message = '<html>
							<body>
								<h4>Sender: '. $data['name'] .' ('.$data['email'].')</h4>
								<h4>Time it was sent: '. date('H:i Y-m-d', $data['send_time']) .'</h4>
								<h4>Message:</h4>
								<pre>'. $data['message'] .'</pre>
							</body>
						</html>';

		$this->email->from('bot@mysite.com', 'Site Bot');
		$this->email->to('i@mysite.com', 'Me');

		$this->email->subject('New message!');
		$this->email->message($html_message);

		$this->email->send();
	}
}
