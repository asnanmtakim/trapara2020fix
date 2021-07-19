<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_jadwal');
	}

	public function index()
	{
		$data['title'] = 'Data Jadwal Trapara';
		if ($this->session->userdata('role') == 4) {
			$id_kelas = $this->db->get_where('peserta', ['id_user' => $this->session->userdata('id')])->row()->id_kelas;
			$jadwal = $this->Model_jadwal->getAllJadwalWithKelas($id_kelas);
		} else if ($this->session->userdata('role') == 2) {
			$id_kelas = $this->db->get_where('pj', ['id_user' => $this->session->userdata('id')])->row()->id_kelas;
			$jadwal = $this->Model_jadwal->getAllJadwalWithKelas($id_kelas);
		} else if ($this->session->userdata('role') == 3) {
			$id_pemateri = $this->db->get_where('pemateri', ['id_user' => $this->session->userdata('id')])->row()->id_pemateri;
			$jadwal = $this->Model_jadwal->getAllJadwalWithPemateri($id_pemateri);
		} else {
			$jadwal = $this->Model_jadwal->getAllJadwal();
		}
		foreach ($jadwal as $jdl) {
			$id_jadwal = $jdl->id_jadwal;
			$pemateri = $this->Model_jadwal->getPemateriJadwal($jdl->id_pemateri);
			$pemateri2 = $this->Model_jadwal->getPemateriJadwal($jdl->id_pemateri2);
			$kelas = $this->Model_jadwal->getKelasJadwal($jdl->id_kelas);
			$materi = $this->Model_jadwal->getMateriJadwal($jdl->id_materi);
			$berkas_materi = $this->Model_jadwal->getBerkasMateri($jdl->id_materi);
			$data['jadwal'][] = array(
				'id_jadwal' => $id_jadwal,
				'pemateri' => $pemateri,
				'pemateri2' => $pemateri2,
				'kelas' => $kelas,
				'materi' => $materi,
				'berkas_materi' => $berkas_materi
			);
		}
		$this->template->load('template/template', 'jadwal/lihat_data', $data);
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
					'label' => 'Judul Materi',
					'rules' => 'trim|required'
				],
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$data['title'] = 'Input Jadwal Trapara';
				$data['pemateri'] = $this->Model_jadwal->getAllPemateri();
				$data['kelas'] = $this->Model_jadwal->getAllKelas();
				$materi = $this->Model_jadwal->getAllMateri();
				foreach ($materi as $mtr) {
					$tgl_pecah = explode("-", $mtr->tgl_materi);
					$tgl = strtotime($tgl_pecah[0]);
					if (time() <= $tgl) {
						$data['materi'][] = array(
							'id_materi' => $mtr->id_materi,
							'judul_materi' => $mtr->judul_materi,
							'tgl_materi' => $mtr->tgl_materi
						);
					}
				}
				$this->template->load('template/template', 'jadwal/form_input', $data);
			} else {
				$id = '';
				$pemateri = $this->input->post('pemateri', true);
				$pemateri2 = $this->input->post('pemateri2', true);
				$kelas = $this->input->post('kelas', true);
				$judul = $this->input->post('judul', true);
				$buat = time();
				$data_jadwal = array(
					'id_pemateri' => $pemateri,
					'id_pemateri2' => $pemateri2,
					'id_kelas' => $kelas,
					'id_materi' => $judul,
					'tgl_jadwal' => $buat
				);
				$this->db->insert('jadwal', $data_jadwal);
				$this->session->set_flashdata('message_success', 'Berhasil menambah data jadwal Trapara.');
				redirect('jadwal');
			}
		} else {
			$data['title'] = 'Input Jadwal Trapara';
			$data['pemateri'] = $this->Model_jadwal->getAllPemateri();
			$data['kelas'] = $this->Model_jadwal->getAllKelas();
			$materi = $this->Model_jadwal->getAllMateri();
			foreach ($materi as $mtr) {
				$tgl_pecah = explode("-", $mtr->tgl_materi);
				$tgl = strtotime($tgl_pecah[0]);
				if (time() <= $tgl) {
					$data['materi'][] = array(
						'id_materi' => $mtr->id_materi,
						'judul_materi' => $mtr->judul_materi,
						'tgl_materi' => $mtr->tgl_materi
					);
				}
			}
			$this->template->load('template/template', 'jadwal/form_input', $data);
		}
	}

	public function detail($id)
	{
		$data['title'] = 'Detail Jadwal Trapara';
		$jadwal = $this->Model_jadwal->getOneJadwal($id);
		$data['pemateri'] = $this->Model_jadwal->getPemateriJadwal($jadwal->id_pemateri);
		$data['pemateri2'] = $this->Model_jadwal->getPemateriJadwal($jadwal->id_pemateri2);
		$data['kelas'] = $this->Model_jadwal->getKelasJadwal($jadwal->id_kelas);
		$data['materi'] = $this->Model_jadwal->getMateriJadwal($jadwal->id_materi);
		$berkas = $this->Model_jadwal->getBerkasMateri($jadwal->id_materi);
		foreach ($berkas as $bks) {
			$filename = 'assets/uploads/materi/' . $jadwal->id_materi . '/' . $bks['berkas_materi'];
			$fileinfo = get_file_info($filename);
			$data['berkas'][] = array(
				'id_berkas_materi' => $bks['id_berkas_materi'],
				'berkas_materi' => $bks['berkas_materi'],
				'info_berkas' => $fileinfo
			);
		}
		// var_dump($data);
		// die;
		$this->template->load('template/template', 'jadwal/detail_data', $data);
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
					'label' => 'Judul Materi',
					'rules' => 'trim|required'
				],
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$id_jadwal = $this->input->post('id');
				$data['title'] = 'Edit Jadwal Trapara';
				$data['one_jadwal'] = $this->Model_jadwal->getOneJadwal($id_jadwal);
				$data['pemateri'] = $this->Model_jadwal->getAllPemateri();
				$data['kelas'] = $this->Model_jadwal->getAllKelas();
				$materi = $this->Model_jadwal->getAllMateri();
				foreach ($materi as $mtr) {
					$tgl_pecah = explode("-", $mtr->tgl_materi);
					$tgl = strtotime($tgl_pecah[0]);
					if (time() <= $tgl) {
						$data['materi'][] = array(
							'id_materi' => $mtr->id_materi,
							'judul_materi' => $mtr->judul_materi,
							'tgl_materi' => $mtr->tgl_materi
						);
					}
				}
				$this->template->load('template/template', 'jadwal/form_edit', $data);
			} else {
				$id_jadwal = $this->input->post('id', true);
				$pemateri = $this->input->post('pemateri', true);
				$pemateri2 = $this->input->post('pemateri2', true);
				$kelas = $this->input->post('kelas', true);
				$judul = $this->input->post('judul', true);
				$data_jadwal = array(
					'id_pemateri' => $pemateri,
					'id_pemateri2' => $pemateri2,
					'id_kelas' => $kelas,
					'id_materi' => $judul
				);
				$this->Model_jadwal->editJadwal($id_jadwal, $data_jadwal);
				$this->session->set_flashdata('message_success', 'Berhasil mengedit data jadwal Trapara.');
				redirect('jadwal');
			}
		} else {
			$id_jadwal = $this->uri->segment(3);
			$data['title'] = 'Edit Jadwal Trapara';
			$data['one_jadwal'] = $this->Model_jadwal->getOneJadwal($id_jadwal);
			$data['pemateri'] = $this->Model_jadwal->getAllPemateri();
			$data['kelas'] = $this->Model_jadwal->getAllKelas();
			$materi = $this->Model_jadwal->getAllMateri();
			foreach ($materi as $mtr) {
				$tgl_pecah = explode("-", $mtr->tgl_materi);
				$tgl = strtotime($tgl_pecah[0]);
				if (time() <= $tgl) {
					$data['materi'][] = array(
						'id_materi' => $mtr->id_materi,
						'judul_materi' => $mtr->judul_materi,
						'tgl_materi' => $mtr->tgl_materi
					);
				}
			}
			$this->template->load('template/template', 'jadwal/form_edit', $data);
		}
	}

	public function hapus()
	{
		$id_jadwal = $this->uri->segment(3);
		$this->Model_jadwal->hapusJadwal($id_jadwal);
		$this->session->set_flashdata('message_success', 'Berhasil menghapus data jadwal Trapara.');
		redirect('jadwal');
	}
}
