<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjab extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_penjab');
	}

	public function index()
	{
		$data['title'] = 'Data PJ Trapara';
		$data['penjab'] = $this->Model_penjab->getAllPenjab();
		$this->template->load('template/template', 'penjab/lihat_data', $data);
		$this->load->view('template/datatable');
	}

	public function post()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'nama',
					'label' => 'Nama PJ',
					'rules' => 'trim|required|min_length[3]|max_length[40]'
				],
				[
					'field' => 'email',
					'label' => 'Email PJ',
					'rules' => 'trim|required|valid_email|is_unique[user.email_user]'
				],
				[
					'field' => 'kelas',
					'label' => 'Kelas',
					'rules' => 'trim|required'
				],
				[
					'field' => 'no_hp',
					'label' => 'No HP PJ',
					'rules' => 'trim|required|min_length[10]|max_length[14]|is_numeric'
				],
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$data['title'] = 'Input PJ Trapara';
				$data['kelas'] = $this->Model_penjab->getKelas();
				$this->template->load('template/template', 'penjab/form_input', $data);
			} else {
				$id = '';
				$nama = $this->input->post('nama', true);
				$email = $this->input->post('email', true);
				$kelas = $this->input->post('kelas', true);
				$no_hp = $this->input->post('no_hp', true);
				$password = '123456';
				$role = 2;
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
				$data_pj = array(
					'id_user' => $id_user,
					'id_kelas' => $kelas,
					'no_hp_pj' => $no_hp
				);
				$this->db->insert('pj', $data_pj);
				$this->session->set_flashdata('message_success', 'Berhasil menambah data PJ Trapara.');
				redirect('penjab');
			}
		} else {
			$data['title'] = 'Input PJ Trapara';
			$data['kelas'] = $this->Model_penjab->getKelas();
			$this->template->load('template/template', 'penjab/form_input', $data);
		}
	}

	public function edit()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'nama',
					'label' => 'Nama PJ',
					'rules' => 'trim|required|min_length[3]|max_length[40]'
				],
				[
					'field' => 'email',
					'label' => 'Email PJ',
					'rules' => 'trim|required|valid_email'
				],
				[
					'field' => 'kelas',
					'label' => 'Kelas',
					'rules' => 'trim|required'
				],
				[
					'field' => 'no_hp',
					'label' => 'No HP PJ',
					'rules' => 'trim|required|min_length[10]|max_length[14]|is_numeric'
				],
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$id_pj = $this->input->post('id');
				$data['title'] = 'Edit PJ';
				$data['kelas'] = $this->Model_penjab->getKelas();
				$data['one_pj'] = $this->Model_penjab->getOnePenjab($id_pj);
				$this->template->load('template/template', 'penjab/form_edit', $data);
			} else {
				$id_pj = $this->input->post('id', true);
				$nama = $this->input->post('nama', true);
				$email = $this->input->post('email', true);
				$kelas = $this->input->post('kelas', true);
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
				$id_usr = $this->db->get_where('pj', ['id_pj' => $id_pj])->row()->id_user;
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
				$this->Model_penjab->editUser($id_usr, $data_user);

				$data_pj = array(
					'id_kelas' => $kelas,
					'no_hp_pj' => $no_hp
				);
				$this->Model_penjab->editPenjab($id_pj, $data_pj);
				$this->session->set_flashdata('message_success', 'Berhasil mengedit data PJ Trapara.');
				redirect('penjab');
			}
		} else {
			$id_pj = $this->uri->segment(3);
			$data['title'] = 'Edit PJ';
			$data['kelas'] = $this->Model_penjab->getKelas();
			$data['one_pj'] = $this->Model_penjab->getOnePenjab($id_pj);
			$this->template->load('template/template', 'penjab/form_edit', $data);
		}
	}
	public function hapus()
	{
		$id_pj = $this->uri->segment(3);
		$id_usr = $this->db->get_where('pj', ['id_pj' => $id_pj])->row()->id_user;
		$this->Model_penjab->hapusUser($id_usr);
		$this->Model_penjab->hapusPenjab($id_pj);
		$this->session->set_flashdata('message_success', 'Berhasil menghapus data PJ Trapara.');
		redirect('penjab');
	}
}
