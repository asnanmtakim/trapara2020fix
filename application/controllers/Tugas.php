<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tugas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_tugas');
	}

	public function index()
	{
		$data['title'] = 'Data Tugas Trapara';
		$data['tugas'] = $this->Model_tugas->getAllTugas();
		$this->template->load('template/template', 'tugas/lihat_data', $data);
		$this->load->view('template/datatable');
	}

	public function post()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'judul',
					'label' => 'Judul tugas',
					'rules' => 'trim|required|min_length[3]|max_length[50]'
				],
				[
					'field' => 'deskripsi',
					'label' => 'Deskripsi tugas',
					'rules' => 'trim|required|min_length[3]'
				],
				[
					'field' => 'batas_tgl',
					'label' => 'Batas pengumpulan',
					'rules' => 'trim|required'
				],
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$data['title'] = 'Input Tugas Trapara';
				$this->template->load('template/template', 'tugas/form_input', $data);
			} else {
				$id = '';
				$judul = $this->input->post('judul', true);
				$deskripsi = $this->input->post('deskripsi', true);
				$batas_tgl = $this->input->post('batas_tgl', true);
				$buat = time();
				$data_tugas = array(
					'judul_tugas' => $judul,
					'deskripsi_tugas' => $deskripsi,
					'batas_tgl' => $batas_tgl,
					'tgl_tugas' => $buat
				);
				$this->db->insert('tugas', $data_tugas);
				$id_tugas = $this->db->get_where('tugas', ['tgl_tugas' => $buat])->row()->id_tugas;
				if (!is_dir('assets/uploads/tugas/' . $id_tugas)) {
					mkdir('./assets/uploads/tugas/' . $id_tugas, 0777, TRUE);
				}
				if (!is_dir('assets/uploads/revisi/' . $id_tugas)) {
					mkdir('./assets/uploads/revisi/' . $id_tugas, 0777, TRUE);
				}
				$this->session->set_flashdata('message_success', 'Berhasil menambah data tugas Trapara.');
				redirect('tugas');
			}
		} else {
			$data['title'] = 'Input Tugas Trapara';
			$this->template->load('template/template', 'tugas/form_input', $data);
		}
	}

	public function edit()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'judul',
					'label' => 'Judul tugas',
					'rules' => 'trim|required|min_length[3]|max_length[50]'
				],
				[
					'field' => 'deskripsi',
					'label' => 'Deskripsi tugas',
					'rules' => 'trim|required|min_length[3]'
				],
				[
					'field' => 'batas_tgl',
					'label' => 'Batas pengumpulan',
					'rules' => 'trim|required'
				],
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$id_tugas = $this->input->post('id');
				$data['title'] = 'Edit Tugas Trapara';
				$data['one_tugas'] = $this->Model_tugas->getOneTugas($id_tugas);
				$this->template->load('template/template', 'tugas/form_edit', $data);
			} else {
				$id_tugas = $this->input->post('id', true);
				$judul = $this->input->post('judul', true);
				$deskripsi = $this->input->post('deskripsi', true);
				$batas_tgl = $this->input->post('batas_tgl', true);
				$data_tugas = array(
					'judul_tugas' => $judul,
					'deskripsi_tugas' => $deskripsi,
					'batas_tgl' => $batas_tgl
				);
				$this->Model_tugas->editTugas($id_tugas, $data_tugas);
				$this->session->set_flashdata('message_success', 'Berhasil mengedit data tugas Trapara.');
				redirect('tugas');
			}
		} else {
			$id_tugas = $this->uri->segment(3);
			$data['title'] = 'Edit Tugas Trapara';
			$data['one_tugas'] = $this->Model_tugas->getOneTugas($id_tugas);
			$this->template->load('template/template', 'tugas/form_edit', $data);
		}
	}

	public function hapus()
	{
		$id_tugas = $this->uri->segment(3);
		$path = './assets/uploads/tugas/' . $id_tugas . '/';
		delete_files($path, TRUE);
		$this->Model_tugas->hapusTugas($id_tugas);
		$this->session->set_flashdata('message_success', 'Berhasil menghapus data tugas Trapara.');
		redirect('tugas');
	}
}
