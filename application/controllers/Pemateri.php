<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemateri extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_pemateri');
	}

	public function index()
	{
		$data['title'] = 'Data Pemateri Trapara';
		$data['pemateri'] = $this->Model_pemateri->getAllPemateri();
		$this->template->load('template/template', 'pemateri/lihat_data', $data);
		$this->load->view('template/datatable');
	}

	public function post()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'nama',
					'label' => 'Nama Pemateri',
					'rules' => 'trim|required|min_length[3]|max_length[40]'
				],
				[
					'field' => 'email',
					'label' => 'Email Pemateri',
					'rules' => 'trim|required|valid_email|is_unique[user.email_user]'
				],
				[
					'field' => 'no_hp',
					'label' => 'No HP Pemateri',
					'rules' => 'trim|required|min_length[10]|max_length[14]|is_numeric'
				],
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$data['title'] = 'Input Pemateri Trapara';
				$this->template->load('template/template', 'pemateri/form_input', $data);
			} else {
				$id = '';
				$nama = $this->input->post('nama', true);
				$email = $this->input->post('email', true);
				$no_hp = $this->input->post('no_hp', true);
				$password = '123456';
				$role = 3;
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
				$data_user = array(
					'nama_user' => $nama,
					'email_user' => $email,
					'password_user' => md5($password),
					'id_role' => $role,
					'foto' => $foto
				);
				$this->db->insert('user', $data_user);

				$id_user = $this->db->get_where('user', ['email_user' => $email])->row()->id_user;
				$data_pemateri = array(
					'id_user' => $id_user,
					'no_hp_pemateri' => $no_hp
				);
				$this->db->insert('pemateri', $data_pemateri);
				$this->session->set_flashdata('message_success', 'Berhasil menambah data pemateri Trapara.');
				redirect('pemateri');
			}
		} else {
			$data['title'] = 'Input Pemateri Trapara';
			$this->template->load('template/template', 'pemateri/form_input', $data);
		}
	}

	public function edit()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'nama',
					'label' => 'Nama Pemateri',
					'rules' => 'trim|required|min_length[3]|max_length[40]'
				],
				[
					'field' => 'email',
					'label' => 'Email Pemateri',
					'rules' => 'trim|required|valid_email'
				],
				[
					'field' => 'no_hp',
					'label' => 'No HP Pemateri',
					'rules' => 'trim|required|min_length[10]|max_length[14]|is_numeric'
				],
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$id_pemateri = $this->input->post('id');
				$data['title'] = 'Edit Pemateri';
				$data['one_pemateri'] = $this->Model_pemateri->getOnePemateri($id_pemateri);
				$this->template->load('template/template', 'pemateri/form_edit', $data);
			} else {
				$id_pemateri = $this->input->post('id', true);
				$nama = $this->input->post('nama', true);
				$email = $this->input->post('email', true);
				$no_hp = $this->input->post('no_hp', true);
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
				$id_usr = $this->db->get_where('pemateri', ['id_pemateri' => $id_pemateri])->row()->id_user;
				if ($foto != '') {
					$data_user = array(
						'nama_user' => $nama,
						'email_user' => $email,
						'foto' => $foto
					);
				} else {
					$data_user = array(
						'nama_user' => $nama,
						'email_user' => $email
					);
				}
				$this->Model_pemateri->editUser($id_usr, $data_user);

				$data_pemateri = array(
					'no_hp_pemateri' => $no_hp
				);
				$this->Model_pemateri->editPemateri($id_pemateri, $data_pemateri);
				$this->session->set_flashdata('message_success', 'Berhasil mengedit data pemateri Trapara.');
				redirect('pemateri');
			}
		} else {
			$id_pemateri = $this->uri->segment(3);
			$data['title'] = 'Edit Pemateri';
			$data['one_pemateri'] = $this->Model_pemateri->getOnePemateri($id_pemateri);
			$this->template->load('template/template', 'pemateri/form_edit', $data);
		}
	}
	public function hapus()
	{
		$id_pemateri = $this->uri->segment(3);
		$id_usr = $this->db->get_where('pemateri', ['id_pemateri' => $id_pemateri])->row()->id_user;
		$this->Model_pemateri->hapusUser($id_usr);
		$this->Model_pemateri->hapusPemateri($id_pemateri);
		$this->session->set_flashdata('message_success', 'Berhasil menghapus data pemateri Trapara.');
		redirect('pemateri');
	}
}
