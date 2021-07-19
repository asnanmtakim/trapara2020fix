<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_auth');
	}

	public function login()
	{
		if (isset($_POST['submit'])) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$hasil	= $this->Model_auth->login($email, $password);
			if ($hasil == TRUE) {
				$this->session->set_userdata(array(
					'id' => $hasil->id_user,
					'status_login' => 'oke',
					'role' => $hasil->id_role
				));
				redirect('');
			} else {
				$this->session->set_flashdata('message_error', 'Username atau Password salah!!!');
				redirect('auth/login');
			}
		} else {
			$data['title'] = 'Login TRAPARA 2020';
			$this->load->view('auth/form_login', $data);
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login');
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'asnanmustakim126@gmail.com',
			'smtp_pass' => '1234asnan',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];
		$this->load->library('email', $config);
		$this->email->from('asnanmustakim126@gmail.com', 'Asnan Mustakim');
		$this->email->to($this->input->post('email'));
		if ($type == 'forgot') {
			$this->email->subject('Reset Password Trapara 2020');
			$this->email->message('Silahkan klik link berikut untuk mereset password. <br>
			Link reset berlaku untuk hanya 30 menit.<br>
			<a href="' . base_url() . 'auth/reset_pass?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '" target:"_blank">Reset Password</a>
			');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
		}
	}

	public function forgot_pass()
	{
		$config = array(
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email'
			],
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'TRAPARA | Lupa Password';
			$this->load->view('auth/forgot_pass', $data);
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email_user' => $email])->row();
			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'token' => $token,
					'tgl_token' => time()
				];
				$this->db->where('email_user', $email);
				$this->db->update('user', $user_token);

				$this->_sendEmail($token, 'forgot');
				$this->session->set_flashdata('message_success', 'Berhasil mengirimkan link reset password. Silahkan cek email anda untuk reset password!');
				redirect('auth/forgot_pass');
			} else {
				$this->session->set_flashdata('message_error', 'Email salah / tidak terdaftar!!!');
				redirect('auth/forgot_pass');
			}
		}
	}

	public function reset_pass()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$user = $this->db->get_where('user', ['email_user' => $email])->row();
		if ($user) {
			$user_token = $this->db->get_where('user', ['token' => $token])->row();
			if ($user_token) {
				$tgl = $user_token->tgl_token;
				$today = time();
				$selisih = ($today - $tgl) / 60;
				if ($selisih <= 30) {
					$this->session->set_userdata('reset_email', $email);
					$this->change_pass();
				} else {
					$this->session->set_flashdata('message_error', 'Gagal reset password! Token kadaluarsa!!');
					redirect('auth/forgot_pass');
				}
			} else {
				$this->session->set_flashdata('message_error', 'Gagal reset password! Token salah!!');
				redirect('auth/forgot_pass');
			}
		} else {
			$this->session->set_flashdata('message_error', 'Gagal reset password! Email salah!!');
			redirect('auth/forgot_pass');
		}
	}

	public function change_pass()
	{
		$config = array(
			[
				'field' => 'password1',
				'label' => 'Password',
				'rules' => 'trim|required|min_length[6]|matches[password2]'
			],
			[
				'field' => 'password2',
				'label' => 'Confirm Password',
				'rules' => 'trim|required|min_length[6]|matches[password1]'
			],
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'TRAPARA | Ubah Password';
			$this->load->view('auth/ubah_pass', $data);
		} else {
			$password = md5($this->input->post('password1'));
			$email = $this->session->userdata('reset_email');

			$this->db->set('password_user', $password);
			$this->db->where('email_user', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message_success', 'Berhasil mengubah password. Silahkan login dengan password baru anda!');
			redirect('auth/login');
		}
	}
}
