<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_admin');
	}

	public function index()
	{
		$data['title'] = 'Data Admin Trapara';
		$data['admin'] = $this->Model_admin->getAllAdmin();
		$this->template->load('template/template', 'admin/lihat_data', $data);
		$this->load->view('template/datatable');
	}

	public function post()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'nama',
					'label' => 'Nama admin',
					'rules' => 'trim|required|min_length[3]|max_length[40]'
				],
				[
					'field' => 'email',
					'label' => 'Email admin',
					'rules' => 'trim|required|valid_email|is_unique[user.email_user]'
				]
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$data['title'] = 'Input Admin Trapara';
				$this->template->load('template/template', 'admin/form_input', $data);
			} else {
				$id = '';
				$nama = $this->input->post('nama', true);
				$email = $this->input->post('email', true);
				$password = '123456';
				$role = 1;
				if ($_FILES['foto']['name'] != '') {
					$config['upload_path']          = './assets/uploads/foto_user/';
					$config['allowed_types']        = 'gif|jpg|jpeg|png';
					$config['max_size']             = 2048;
					$config['overwrite'] = TRUE;
					$config['remove_spaces'] = TRUE;
					$config['file_name'] = str_replace(".", "-", $email);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('foto')) {
						$this->session->set_flashdata('message_error', $this->upload->display_errors());
						redirect($_SERVER['HTTP_REFERER']);
						return false;
					} else {
						$data = array('upload_data' => $this->upload->data());
						$foto = $this->upload->data('file_name');
					}
				} else {
					$foto = 'default.jpg';
				}
				$data_admin = array(
					'nama_user' => $nama,
					'email_user' => $email,
					'password_user' => md5($password),
					'id_role' => $role,
					'foto' => $foto
				);
				$this->db->insert('user', $data_admin);
				$this->session->set_flashdata('message_success', 'Berhasil menambah data admin Trapara.');
				redirect('admin');
			}
		} else {
			$data['title'] = 'Input Admin Trapara';
			$this->template->load('template/template', 'admin/form_input', $data);
		}
	}

	public function edit()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'nama',
					'label' => 'Nama admin',
					'rules' => 'trim|required|min_length[3]|max_length[40]'
				],
				[
					'field' => 'email',
					'label' => 'Email admin',
					'rules' => 'trim|required|valid_email'
				]
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$id_admin = $this->input->post('id');
				$data['title'] = 'Edit Admin Trapara';
				$data['one_admin'] = $this->Model_admin->getOneAdmin($id_admin);
				$this->template->load('template/template', 'admin/form_edit', $data);
			} else {
				$id_admin = $this->input->post('id', true);
				$nama = $this->input->post('nama', true);
				$email = $this->input->post('email', true);
				if ($_FILES['foto']['name'] != '') {
					$config['upload_path']          = './assets/uploads/foto_user/';
					$config['allowed_types']        = 'gif|jpg|jpeg|png';
					$config['max_size']             = 2048;
					$config['overwrite'] = TRUE;
					$config['remove_spaces'] = TRUE;
					$config['file_name'] = str_replace(".", "-", $email);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('foto')) {
						$this->session->set_flashdata('message_error', $this->upload->display_errors());
						redirect($_SERVER['HTTP_REFERER']);
						return false;
					} else {
						$data = array('upload_data' => $this->upload->data());
						$foto = $this->upload->data('file_name');
					}
				} else {
					$foto = '';
				}
				if ($foto != '') {
					$data_admin = array(
						'nama_user' => $nama,
						'email_user' => $email,
						'foto' => $foto
					);
				} else {
					$data_admin = array(
						'nama_user' => $nama,
						'email_user' => $email
					);
				}
				$this->Model_admin->editAdmin($id_admin, $data_admin);
				$this->session->set_flashdata('message_success', 'Berhasil mengedit data admin Trapara.');
				redirect('admin');
			}
		} else {
			$id_admin = $this->uri->segment(3);
			$data['title'] = 'Edit Admin Trapara';
			$data['one_admin'] = $this->Model_admin->getOneAdmin($id_admin);
			$this->template->load('template/template', 'admin/form_edit', $data);
		}
	}
	public function hapus()
	{
		$id_admin = $this->uri->segment(3);
		$this->Model_admin->hapusAdmin($id_admin);
		$this->session->set_flashdata('message_success', 'Berhasil menghapus data admin Trapara.');
		redirect('admin');
	}
}
