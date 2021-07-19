<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_kelas');
	}

	public function index()
	{
		$data['title'] = 'Data Kelas Trapara';
		$kelas = $this->Model_kelas->getAllKelas();
		foreach ($kelas as $kls) {
			$pj = $this->Model_kelas->getPJKelas($kls->id_kelas);
			$peserta = $this->Model_kelas->getPesertaKelas($kls->id_kelas)->num_rows();
			$data['kelas'][] = array(
				'id_kelas' => $kls->id_kelas,
				'nama_kelas' => $kls->nama_kelas,
				'link_kelas' => $kls->link_kelas,
				'pj' => $pj,
				'peserta' => $peserta
			);
		}
		$this->template->load('template/template', 'kelas/lihat_data', $data);
		$this->load->view('template/datatable');
	}

	public function post()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'nama',
					'label' => 'Nama Kelas',
					'rules' => 'trim|required|min_length[3]|max_length[40]'
				],
				[
					'field' => 'link',
					'label' => 'Link Kelas',
					'rules' => 'trim|required|valid_url'
				]
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$data['title'] = 'Input Kelas Trapara';
				$this->template->load('template/template', 'kelas/form_input', $data);
			} else {
				$id = '';
				$nama = $this->input->post('nama', true);
				$link = $this->input->post('link', true);
				$data_kelas = array(
					'nama_kelas' => $nama,
					'link_kelas' => $link
				);
				$this->db->insert('kelas', $data_kelas);
				$this->session->set_flashdata('message_success', 'Berhasil menambah data kelas Trapara.');
				redirect('kelas');
			}
		} else {
			$data['title'] = 'Input Kelas Trapara';
			$this->template->load('template/template', 'kelas/form_input', $data);
		}
	}

	public function edit()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'nama',
					'label' => 'Nama Kelas',
					'rules' => 'trim|required|min_length[3]|max_length[40]'
				],
				[
					'field' => 'link',
					'label' => 'Link Kelas',
					'rules' => 'trim|required|valid_url'
				]
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$id_kelas = $this->input->post('id');
				$data['title'] = 'Edit Kelas Trapara';
				$data['one_kelas'] = $this->Model_kelas->getOneKelas($id_kelas);
				$this->template->load('template/template', 'kelas/form_edit', $data);
			} else {
				$id_kelas = $this->input->post('id', true);
				$nama = $this->input->post('nama', true);
				$link = $this->input->post('link', true);
				$data_kelas = array(
					'nama_kelas' => $nama,
					'link_kelas' => $link
				);
				$this->Model_kelas->editKelas($id_kelas, $data_kelas);
				$this->session->set_flashdata('message_success', 'Berhasil mengedit data kelas Trapara.');
				redirect('kelas');
			}
		} else {
			$id_kelas = $this->uri->segment(3);
			$data['title'] = 'Edit Kelas Trapara';
			$data['one_kelas'] = $this->Model_kelas->getOneKelas($id_kelas);
			$this->template->load('template/template', 'kelas/form_edit', $data);
		}
	}
	public function hapus()
	{
		$id_kelas = $this->uri->segment(3);
		$this->Model_kelas->hapusKelas($id_kelas);
		$this->session->set_flashdata('message_success', 'Berhasil menghapus data kelas Trapara.');
		redirect('kelas');
	}
}
