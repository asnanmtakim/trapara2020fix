<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Koreksi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_koreksi');
	}

	public function index()
	{
		$data['title'] = 'Data Koreksi Tugas Trapara';
		if ($this->session->userdata('role') == 3) {
			$id_pemateri = $this->db->get_where('pemateri', ['id_user' => $this->session->userdata('id')])->row()->id_pemateri;
			$koreksi = $this->Model_koreksi->getAllKoreksiWithPemateri($id_pemateri);
		} else if ($this->session->userdata('role') == 2) {
			$id_kelas = $this->db->get_where('pj', ['id_user' => $this->session->userdata('id')])->row()->id_kelas;
			$koreksi = $this->Model_koreksi->getAllKoreksiWithKelas($id_kelas);
		} else {
			$koreksi = $this->Model_koreksi->getAllKoreksi();
		}
		foreach ($koreksi as $krs) {
			$pemateri = $this->Model_koreksi->getPemateriKoreksi($krs->id_pemateri);
			$pemateri2 = $this->Model_koreksi->getPemateriKoreksi($krs->id_pemateri2);
			$kelas = $this->Model_koreksi->getKelasKoreksi($krs->id_kelas);
			$tugas = $this->Model_koreksi->getTugasKoreksi($krs->id_tugas);
			$pengtugas = $this->Model_koreksi->getPengtugasKoreksi($krs->id_kelas, $krs->id_tugas)->num_rows();
			$nilaipengtugas = $this->Model_koreksi->getPengtugasKoreksiNilai($krs->id_kelas, $krs->id_tugas)->num_rows();
			$data['koreksi'][] = array(
				'id_koreksi' => $krs->id_koreksi,
				'pemateri' => $pemateri,
				'pemateri2' => $pemateri2,
				'kelas' => $kelas,
				'tugas' => $tugas,
				'jum_pengtugas' => $pengtugas,
				'total_koreksi' => $nilaipengtugas . '/' . $pengtugas
			);
		}
		$this->template->load('template/template', 'koreksi/lihat_data', $data);
		$this->load->view('template/datatable');
	}

	public function post()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'pemateri',
					'label' => 'Pemateri',
					'rules' => 'trim|required'
				],
				[
					'field' => 'kelas',
					'label' => 'Kelas',
					'rules' => 'trim|required'
				],
				[
					'field' => 'judul',
					'label' => 'Judul Tugas',
					'rules' => 'trim|required'
				],
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$data['title'] = 'Input Koreksi Tugas Trapara';
				$data['pemateri'] = $this->Model_koreksi->getAllPemateri();
				$data['kelas'] = $this->Model_koreksi->getAllKelas();
				$tugas = $this->Model_koreksi->getAllTugas();
				foreach ($tugas as $tgs) {
					$tgl = strtotime($tgs->batas_tgl);
					if (time() >= $tgl) {
						$data['tugas'][] = array(
							'id_tugas' => $tgs->id_tugas,
							'judul_tugas' => $tgs->judul_tugas,
							'batas_tgl' => $tgs->batas_tgl
						);
					}
				}
				$this->template->load('template/template', 'koreksi/form_input', $data);
			} else {
				$id = '';
				$pemateri = $this->input->post('pemateri', true);
				$pemateri2 = $this->input->post('pemateri2', true);
				$kelas = $this->input->post('kelas', true);
				$judul = $this->input->post('judul', true);
				$buat = time();
				$data_koreksi = array(
					'id_pemateri' => $pemateri,
					'id_pemateri2' => $pemateri2,
					'id_kelas' => $kelas,
					'id_tugas' => $judul,
					'tgl_koreksi' => $buat
				);
				$this->db->insert('koreksi', $data_koreksi);
				$this->session->set_flashdata('message_success', 'Berhasil menambah data koreksi tugas Trapara.');
				redirect('koreksi');
			}
		} else {
			$data['title'] = 'Input Koreksi Tugas Trapara';
			$data['pemateri'] = $this->Model_koreksi->getAllPemateri();
			$data['kelas'] = $this->Model_koreksi->getAllKelas();
			$tugas = $this->Model_koreksi->getAllTugas();
			foreach ($tugas as $tgs) {
				$tgl = strtotime($tgs->batas_tgl);
				if (time() >= $tgl) {
					$data['tugas'][] = array(
						'id_tugas' => $tgs->id_tugas,
						'judul_tugas' => $tgs->judul_tugas,
						'batas_tgl' => $tgs->batas_tgl
					);
				}
			}
			$this->template->load('template/template', 'koreksi/form_input', $data);
		}
	}

	public function detail($id)
	{
		$data['title'] = 'Koreksi Tugas Trapara';
		$koreksi = $this->Model_koreksi->getOneKoreksi($id);
		$data['id_koreksi'] = $id;
		$data['pemateri'] = $this->Model_koreksi->getPemateriKoreksi($koreksi->id_pemateri);
		$data['pemateri2'] = $this->Model_koreksi->getPemateriKoreksi($koreksi->id_pemateri2);
		$data['kelas'] = $this->Model_koreksi->getKelasKoreksi($koreksi->id_kelas);
		$data['tugas'] = $this->Model_koreksi->getTugasKoreksi($koreksi->id_tugas);
		$data['pengtugas'] = $this->Model_koreksi->getPengtugasKoreksi($koreksi->id_kelas, $koreksi->id_tugas)->result();
		$this->template->load('template/template', 'koreksi/detail_data', $data);
		$this->load->view('template/datatable');
	}

	public function nilai($id_pengtugas, $id_koreksi)
	{
		$data['title'] = 'Pengumpulan Tugas Trapara';
		$pengtugas = $this->Model_koreksi->getOnePengtugas($id_pengtugas);
		$tugas = $this->Model_koreksi->getTugasKoreksi($pengtugas->id_tugas);
		$peserta = $this->Model_koreksi->getPesertaKoreksi($pengtugas->id_peserta);
		$filename = 'assets/uploads/tugas/' . $pengtugas->id_tugas . '/' . $pengtugas->berkas_peng;
		$fileinfo = get_file_info($filename);
		$data['pengtugas'] = array(
			'id_pengtugas' => $pengtugas->id_pengtugas,
			'id_tugas' => $pengtugas->id_tugas,
			'id_peserta' => $pengtugas->id_peserta,
			'berkas_peng' => $fileinfo,
			'tgl_peng' => $pengtugas->tgl_peng,
			'nilai' => $pengtugas->nilai,
			'komentar' => $pengtugas->komentar,
			'berkas_revisi' => $pengtugas->berkas_revisi,
		);
		$data['tugas'] = $tugas;
		$data['peserta'] = $peserta;
		$data['id_koreksi'] = $id_koreksi;
		$this->template->load('template/template', 'koreksi/form_penilaian', $data);
	}

	public function input_nilai()
	{
		$id_koreksi = $this->input->post('id_koreksi', true);
		$id_pengtugas = $this->input->post('id_pengtugas', true);
		$nilai = $this->input->post('nilai', true);
		$komentar = $this->input->post('komentar', true);
		$data_koreksi = array(
			'nilai' => $nilai,
			'komentar' => $komentar
		);
		$this->Model_koreksi->editNilaiPengtugas($id_pengtugas, $data_koreksi);
		$this->session->set_flashdata('message_success', 'Berhasil mengupdate nilai tugas peserta.');
		redirect('koreksi/detail/' . $id_koreksi);
	}

	public function edit()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'pemateri',
					'label' => 'Pemateri',
					'rules' => 'trim|required'
				],
				[
					'field' => 'kelas',
					'label' => 'Kelas',
					'rules' => 'trim|required'
				],
				[
					'field' => 'judul',
					'label' => 'Judul Tugas',
					'rules' => 'trim|required'
				],
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$id_koreksi = $this->input->post('id');
				$data['title'] = 'Edit koreksi tugas Trapara';
				$data['one_koreksi'] = $this->Model_koreksi->getOneKoreksi($id_koreksi);
				$data['pemateri'] = $this->Model_koreksi->getAllPemateri();
				$data['kelas'] = $this->Model_koreksi->getAllKelas();
				$tugas = $this->Model_koreksi->getAllTugas();
				foreach ($tugas as $tgs) {
					$tgl = strtotime($tgs->batas_tgl);
					if (time() >= $tgl) {
						$data['tugas'][] = array(
							'id_tugas' => $tgs->id_tugas,
							'judul_tugas' => $tgs->judul_tugas,
							'batas_tgl' => $tgs->batas_tgl
						);
					}
				}
				$this->template->load('template/template', 'koreksi/form_edit', $data);
			} else {
				$id_koreksi = $this->input->post('id', true);
				$pemateri = $this->input->post('pemateri', true);
				$pemateri2 = $this->input->post('pemateri2', true);
				$kelas = $this->input->post('kelas', true);
				$judul = $this->input->post('judul', true);
				$data_koreksi = array(
					'id_pemateri' => $pemateri,
					'id_pemateri2' => $pemateri2,
					'id_kelas' => $kelas,
					'id_tugas' => $judul
				);
				$this->Model_koreksi->editKoreksi($id_koreksi, $data_koreksi);
				$this->session->set_flashdata('message_success', 'Berhasil mengedit data koreksi tugas Trapara.');
				redirect('koreksi');
			}
		} else {
			$id_koreksi = $this->uri->segment(3);
			$data['title'] = 'Edit koreksi tugas Trapara';
			$data['one_koreksi'] = $this->Model_koreksi->getOneKoreksi($id_koreksi);
			$data['pemateri'] = $this->Model_koreksi->getAllPemateri();
			$data['kelas'] = $this->Model_koreksi->getAllKelas();
			$tugas = $this->Model_koreksi->getAllTugas();
			foreach ($tugas as $tgs) {
				$tgl = strtotime($tgs->batas_tgl);
				if (time() >= $tgl) {
					$data['tugas'][] = array(
						'id_tugas' => $tgs->id_tugas,
						'judul_tugas' => $tgs->judul_tugas,
						'batas_tgl' => $tgs->batas_tgl
					);
				}
			}
			$this->template->load('template/template', 'koreksi/form_edit', $data);
		}
	}

	public function hapus()
	{
		$id_koreksi = $this->uri->segment(3);
		$this->Model_koreksi->hapusKoreksi($id_koreksi);
		$this->session->set_flashdata('message_success', 'Berhasil menghapus data koreksi tugas Trapara.');
		redirect('koreksi');
	}
}
