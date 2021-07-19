<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_absensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_lap_absensi');
	}

	public function index()
	{
		$data['title'] = 'Absensi Peserta Trapara';
		$absen = $this->Model_lap_absensi->getAllAbsen();
		if ($this->session->userdata('role') == 2) {
			$id_kelas = $this->db->get_where('pj', ['id_user' => $this->session->userdata('id')])->row()->id_kelas;
			$peserta = $this->Model_lap_absensi->getAllPesertaWithKelas($id_kelas);
		} else {
			$peserta = $this->Model_lap_absensi->getAllPeserta();
		}
		foreach ($peserta as $pst) {
			$masuk = $this->Model_lap_absensi->getAbsensiMasuk($pst->id_peserta);
			$izin = $this->Model_lap_absensi->getAbsensiIzin($pst->id_peserta);
			$alfa = $this->Model_lap_absensi->getAbsensiAlfa($pst->id_peserta);
			$data['lap_absensi'][] = array(
				'peserta' => $pst,
				'masuk' => "$masuk/$absen",
				'izin' => "$izin/$absen",
				'alfa' => "$alfa/$absen",
			);
		}
		$this->template->load('template/template', 'absensi/lihat_laporan', $data);
		$this->load->view('template/datatable');
	}
}
