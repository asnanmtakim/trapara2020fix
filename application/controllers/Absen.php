<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_absen');
	}

	public function index()
	{
		$data['title'] = 'Data Absen Trapara';
		$data['absen'] = $this->Model_absen->getAllAbsen();
		$this->template->load('template/template', 'absen/lihat_data', $data);
		$this->load->view('template/datatable');
	}

	public function post()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'judul',
					'label' => 'Judul absen',
					'rules' => 'trim|required|min_length[3]|max_length[100]'
				],
				[
					'field' => 'tgl',
					'label' => 'Tanggal_absen',
					'rules' => 'trim|required'
				],
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$data['title'] = 'Input Absen Trapara';
				$this->template->load('template/template', 'absen/form_input', $data);
			} else {
				$id = '';
				$judul = $this->input->post('judul', true);
				$tgl = $this->input->post('tgl', true);
				$buat = time();
				$data_absen = array(
					'judul_absen' => $judul,
					'tgl_absen' => $tgl,
					'tgl_buat' => $buat
				);
				$this->db->insert('absen', $data_absen);
				$id_absen = $this->db->get_where('absen', ['tgl_buat' => $buat])->row()->id_absen;
				$peserta = $this->Model_absen->getAllPeserta();
				foreach ($peserta as $pst) {
					$data_absensi = array(
						'id_absen' => $id_absen,
						'id_peserta' => $pst->id_peserta,
						'status' => 0
					);
					$this->db->insert('absensi', $data_absensi);
				}
				$this->session->set_flashdata('message_success', 'Berhasil menambah data absen Trapara.');
				redirect('absen');
			}
		} else {
			$data['title'] = 'Input Absen Trapara';
			$this->template->load('template/template', 'absen/form_input', $data);
		}
	}

	public function edit()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'judul',
					'label' => 'Judul absen',
					'rules' => 'trim|required|min_length[3]|max_length[100]'
				],
				[
					'field' => 'tgl',
					'label' => 'Tanggal_absen',
					'rules' => 'trim|required'
				],
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$id_absen = $this->input->post('id');
				$data['title'] = 'Edit Absen Trapara';
				$data['one_absen'] = $this->Model_absen->getOneAbsen($id_absen);
				$this->template->load('template/template', 'absen/form_edit', $data);
			} else {
				$id_absen = $this->input->post('id', true);
				$judul = $this->input->post('judul', true);
				$tgl = $this->input->post('tgl', true);
				$data_absen = array(
					'judul_absen' => $judul,
					'tgl_absen' => $tgl,
				);
				$this->Model_absen->editAbsen($id_absen, $data_absen);
				$this->session->set_flashdata('message_success', 'Berhasil mengedit data absen Trapara.');
				redirect('absen');
			}
		} else {
			$id_absen = $this->uri->segment(3);
			$data['title'] = 'Edit Absen Trapara';
			$data['one_absen'] = $this->Model_absen->getOneAbsen($id_absen);
			$this->template->load('template/template', 'absen/form_edit', $data);
		}
	}

	public function hapus()
	{
		$id_absen = $this->uri->segment(3);
		$this->Model_absen->hapusAbsensi($id_absen);
		$this->Model_absen->hapusAbsen($id_absen);
		$this->session->set_flashdata('message_success', 'Berhasil menghapus data absen Trapara.');
		redirect('absen');
	}
}
