<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_profil');
	}

	public function index()
	{
		$role = $this->session->userdata('role');
		$id_user = $this->session->userdata('id');
		$data['title'] = 'Profil Pengguna';
		if ($role == 4) {
			$data['peserta'] = $this->Model_profil->getProfilPeserta($id_user);
		} else if ($role == 3) {
			$data['pemateri'] = $this->Model_profil->getProfilPemateri($id_user);
		} else if ($role == 2) {
			$data['penjab'] = $this->Model_profil->getProfilPenjab($id_user);
		} else {
			$data['admin'] = $this->Model_profil->getProfilUser($id_user);
		}
		$this->template->load('template/template', 'profil/lihat_profil', $data);
	}

	public function editProfilPeserta()
	{
		$id_user = $this->session->userdata('id');
		$nama = $this->input->post('nama', true);
		$nim = $this->input->post('nim', true);
		$data_peserta = array(
			'nim' => $nim,
		);
		$this->Model_profil->editPeserta($id_user, $data_peserta);
		$data_user = array(
			'nama_user' => $nama,
		);
		$this->Model_profil->editUser($id_user, $data_user);
		$this->session->set_flashdata('message_success', 'Berhasil mengedit data profil.');
		redirect('profil');
	}
	public function editProfilPemateri()
	{
		$id_user = $this->session->userdata('id');
		$nama = $this->input->post('nama', true);
		$no_hp = $this->input->post('no_hp', true);
		$data_pemateri = array(
			'no_hp_pemateri' => $no_hp,
		);
		$this->Model_profil->editPemateri($id_user, $data_pemateri);
		$data_user = array(
			'nama_user' => $nama,
		);
		$this->Model_profil->editUser($id_user, $data_user);
		$this->session->set_flashdata('message_success', 'Berhasil mengedit data profil.');
		redirect('profil');
	}
	public function editProfilPenjab()
	{
		$id_user = $this->session->userdata('id');
		$nama = $this->input->post('nama', true);
		$no_hp = $this->input->post('no_hp', true);
		$data_penjab = array(
			'no_hp_pj' => $no_hp,
		);
		$this->Model_profil->editPenjab($id_user, $data_penjab);
		$data_user = array(
			'nama_user' => $nama,
		);
		$this->Model_profil->editUser($id_user, $data_user);
		$this->session->set_flashdata('message_success', 'Berhasil mengedit data profil.');
		redirect('profil');
	}
	public function editProfilUser()
	{
		$id_user = $this->session->userdata('id');
		$nama = $this->input->post('nama', true);
		$data_user = array(
			'nama_user' => $nama,
		);
		$this->Model_profil->editUser($id_user, $data_user);
		$this->session->set_flashdata('message_success', 'Berhasil mengedit data profil.');
		redirect('profil');
	}
	public function editFotoUser()
	{
		$id_user = $this->session->userdata('id');
		$user = $this->Model_profil->getProfilUser($id_user);
		$email = $user->email_user;
		$config['upload_path']          = './assets/uploads/foto_user/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['max_size']             = 2048;
		$config['remove_spaces'] = TRUE;
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('foto')) {
			$this->session->set_flashdata('message_error', $this->upload->display_errors());
			redirect('profil');
			return false;
		} else {
			$filename = $user->foto;
			if ($filename != 'default.jpg') {
				$filepath = './assets/uploads/foto_user/' . $filename;
				unlink($filepath);
			}
			$data = array('upload_data' => $this->upload->data());
			$foto = $this->upload->data('file_name');
			$data_user = array(
				'foto' => $foto,
			);
			$this->Model_profil->editUser($id_user, $data_user);
			$this->session->set_flashdata('message_success', 'Berhasil foto profil pengguna.');
			redirect('profil');
		}
	}
	public function editPasswordUser()
	{
		$id_user = $this->session->userdata('id');
		$user = $this->Model_profil->getProfilUser($id_user);
		$password_lm = $this->input->post('password_lm', true);
		$password_br = $this->input->post('password_br', true);
		if ($user->password_user != md5($password_lm)) {
			$this->session->set_flashdata('message_error', 'Password lama salah!.');
			redirect('profil');
		} else {
			$data_user = array(
				'password_user' => md5($password_br),
			);
			$this->Model_profil->editUser($id_user, $data_user);
			$this->session->set_flashdata('message_success', 'Berhasil mengubah password.');
			redirect('profil');
		}
	}
}
