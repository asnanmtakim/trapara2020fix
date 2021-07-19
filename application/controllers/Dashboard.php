<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$data['profil'] = chek_session();
		$this->load->model('Model_lap_absensi');
	}

	public function index()
	{
		$data['title'] = 'Beranda';
		if ($this->session->userdata('role') == 4) {
			$id_peserta = $this->db->get_where('peserta', ['id_user' => $this->session->userdata('id')])->row()->id_peserta;
			$absen = $this->Model_lap_absensi->getAllAbsen();
			$peserta = $this->Model_lap_absensi->getOnePeserta($id_peserta);
			$masuk = $this->Model_lap_absensi->getAbsensiMasuk($id_peserta);
			$izin = $this->Model_lap_absensi->getAbsensiIzin($id_peserta);
			$alfa = $this->Model_lap_absensi->getAbsensiAlfa($id_peserta);
			$data['lap_absensi'] = array(
				'peserta' => $peserta,
				'masuk' => "$masuk/$absen",
				'izin' => "$izin/$absen",
				'alfa' => "$alfa/$absen",
			);
		}
		$this->template->load('template/template', 'dashboard/dashboard', $data);
	}
}
