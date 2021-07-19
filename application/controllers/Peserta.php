<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peserta extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_peserta');
	}

	public function index()
	{
		$data['title'] = 'Data Peserta';
		$data['peserta'] = $this->Model_peserta->getAllPeserta();
		$this->template->load('template/template', 'peserta/lihat_data', $data);
		$this->load->view('template/datatable');
	}

	public function post()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'nim',
					'label' => 'NIM Peserta',
					'rules' => 'trim|required|min_length[9]|max_length[12]|alpha_numeric'
				],
				[
					'field' => 'nama',
					'label' => 'Nama Peserta',
					'rules' => 'trim|required|min_length[3]|max_length[40]'
				],
				[
					'field' => 'email',
					'label' => 'Email Peserta',
					'rules' => 'trim|required|valid_email|is_unique[user.email_user]'
				],
				[
					'field' => 'kelas',
					'label' => 'Kelas',
					'rules' => 'trim|required'
				],
				[
					'field' => 'suara',
					'label' => 'Suara',
					'rules' => 'trim|required'
				]
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$data['title'] = 'Input Peserta';
				$data['kelas'] = $this->Model_peserta->getKelas();
				$data['error'] = $this->upload->display_errors();
				$this->template->load('template/template', 'peserta/form_input', $data);
			} else {
				$id = '';
				$nim = $this->input->post('nim', true);
				$nama = $this->input->post('nama', true);
				$email = $this->input->post('email', true);
				$kelas = $this->input->post('kelas', true);
				$suara = $this->input->post('suara', true);
				$password = '123456';
				$role = 4;
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
				$data_peserta = array(
					'nim' => $nim,
					'id_user' => $id_user,
					'id_kelas' => $kelas,
					'suara' => $suara
				);
				$this->db->insert('peserta', $data_peserta);
				$this->session->set_flashdata('message_success', 'Berhasil menambah data peserta.');
				redirect('peserta');
			}
		} else {
			$data['title'] = 'Input Peserta';
			$data['kelas'] = $this->Model_peserta->getKelas();
			$data['error'] = $this->upload->display_errors();
			$this->template->load('template/template', 'peserta/form_input', $data);
		}
	}

	public function edit()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'nim',
					'label' => 'NIM Peserta',
					'rules' => 'trim|required|min_length[9]|max_length[12]|alpha_numeric'
				],
				[
					'field' => 'nama',
					'label' => 'Nama Peserta',
					'rules' => 'trim|required|min_length[3]|max_length[40]'
				],
				[
					'field' => 'email',
					'label' => 'Email Peserta',
					'rules' => 'trim|required|valid_email'
				],
				[
					'field' => 'kelas',
					'label' => 'Kelas',
					'rules' => 'trim|required'
				],
				[
					'field' => 'suara',
					'label' => 'Suara',
					'rules' => 'trim|required'
				]
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$id_peserta = $this->input->post('id');
				$data['title'] = 'Edit Peserta';
				$data['kelas'] = $this->Model_peserta->getKelas();
				$data['one_peserta'] = $this->Model_peserta->getOnePeserta($id_peserta);
				$this->template->load('template/template', 'peserta/form_edit', $data);
			} else {
				$id_pes = $this->input->post('id', true);
				$nim = $this->input->post('nim', true);
				$nama = $this->input->post('nama', true);
				$email = $this->input->post('email', true);
				$kelas = $this->input->post('kelas', true);
				$suara = $this->input->post('suara', true);
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
				$id_usr = $this->db->get_where('peserta', ['id_peserta' => $id_pes])->row()->id_user;
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
				$this->Model_peserta->editUser($id_usr, $data_user);

				$data_peserta = array(
					'nim' => $nim,
					'id_kelas' => $kelas,
					'suara' => $suara
				);
				$this->Model_peserta->editPeserta($id_pes, $data_peserta);
				$this->session->set_flashdata('message_success', 'Berhasil mengedit data peserta.');
				redirect('peserta');
			}
		} else {
			$id_peserta = $this->uri->segment(3);
			$data['title'] = 'Edit Peserta';
			$data['kelas'] = $this->Model_peserta->getKelas();
			$data['one_peserta'] = $this->Model_peserta->getOnePeserta($id_peserta);
			$this->template->load('template/template', 'peserta/form_edit', $data);
		}
	}
	public function hapus()
	{
		$id_pes = $this->uri->segment(3);
		$id_usr = $this->db->get_where('peserta', ['id_peserta' => $id_pes])->row()->id_user;
		$this->Model_peserta->hapusUser($id_usr);
		$this->Model_peserta->hapusPeserta($id_pes);
		$this->session->set_flashdata('message_success', 'Berhasil menghapus data peserta.');
		redirect('peserta');
	}
}
