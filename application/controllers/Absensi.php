<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_absensi');
	}

	public function index()
	{
		$data['title'] = 'Data Absen Trapara';
		$absen = $this->Model_absensi->getAllAbsen();
		foreach ($absen as $abs) {
			if ($this->session->userdata('role') == 2) {
				$id_kelas = $this->db->get_where('pj', ['id_user' => $this->session->userdata('id')])->row()->id_kelas;
				$jumPeserta = $this->Model_absensi->getAllJumPesertaWithKelas($abs->id_absen, $id_kelas);
				$jumMasuk = $this->Model_absensi->getJumMasukWithKelas($abs->id_absen, $id_kelas);
			} else {
				$jumPeserta = $this->Model_absensi->getAllJumPeserta($abs->id_absen);
				$jumMasuk = $this->Model_absensi->getJumMasuk($abs->id_absen);
			}
			$data['absen'][] = array(
				'id_absen' => $abs->id_absen,
				'judul_absen' => $abs->judul_absen,
				'tgl_absen' => $abs->tgl_absen,
				'jum_peserta' => "$jumMasuk/$jumPeserta"
			);
		}
		$this->template->load('template/template', 'absensi/lihat_data', $data);
		$this->load->view('template/datatable');
	}

	public function absen($id_absen)
	{
		$data['title'] = 'Absensi Peserta Trapara';
		$one_absen = $this->Model_absensi->getOneAbsen($id_absen);
		if ($this->session->userdata('role') == 2) {
			$id_kelas = $this->db->get_where('pj', ['id_user' => $this->session->userdata('id')])->row()->id_kelas;
			$jumPeserta = $this->Model_absensi->getAllJumPesertaWithKelas($one_absen->id_absen, $id_kelas);
			$jumMasuk = $this->Model_absensi->getJumMasukWithKelas($one_absen->id_absen, $id_kelas);
			$data['absensi'] = $this->Model_absensi->getAbsensiWithKelas($id_absen, $id_kelas);
		} else {
			$jumPeserta = $this->Model_absensi->getAllJumPeserta($one_absen->id_absen);
			$jumMasuk = $this->Model_absensi->getJumMasuk($one_absen->id_absen);
			$data['absensi'] = $this->Model_absensi->getAbsensi($id_absen);
		}
		$data['one_absen'] = array(
			'id_absen' => $one_absen->id_absen,
			'judul_absen' => $one_absen->judul_absen,
			'tgl_absen' => $one_absen->tgl_absen,
			'jum_peserta' => "$jumMasuk/$jumPeserta"
		);
		$this->template->load('template/template', 'absensi/form_absensi', $data);
		$this->load->view('template/datatable');
	}

	public function absensiPeserta()
	{
		$id_absensi = $this->input->post('id_absensi');
		$one_absensi = $this->Model_absensi->getOneAbsensi($id_absensi);
		echo json_encode($one_absensi);
	}

	public function editAbsensi()
	{
		$id_absensi = $this->input->post('id_absensi', true);
		$id_absen = $this->input->post('id_absen', true);
		$status = $this->input->post('status', true);
		$keterangan = $this->input->post('keterangan', true);
		$data_absensi = array(
			'status' => $status,
			'keterangan' => $keterangan,
		);
		$this->Model_absensi->editAbsensi($id_absensi, $data_absensi);
		$this->session->set_flashdata('message_success', 'Berhasil mengabsen peserta.');
		redirect('absensi/absen/' . $id_absen);
	}
}
