<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sebaran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$data['profil'] = chek_session();
		$this->load->model('Model_kelas');
	}

	public function index()
	{
		$data['title'] = 'Data Sebaran Kelas Trapara';
		if ($this->session->userdata('role') == 4) {
			$id_kelas = $this->db->get_where('peserta', ['id_user' => $this->session->userdata('id')])->row()->id_kelas;
			$kelas = $this->Model_kelas->getAllKelasWithKelas($id_kelas);
		} else if ($this->session->userdata('role') == 2) {
			$id_kelas = $this->db->get_where('pj', ['id_user' => $this->session->userdata('id')])->row()->id_kelas;
			$kelas = $this->Model_kelas->getAllKelasWithKelas($id_kelas);
		} else {
			$kelas = $this->Model_kelas->getAllKelas();
		}
		foreach ($kelas as $kls) {
			$pj = $this->Model_kelas->getPJKelas($kls->id_kelas);
			$peserta = $this->Model_kelas->getPesertaKelas($kls->id_kelas)->result_array();
			$data['sebaran'][] = array(
				'id_kelas' => $kls->id_kelas,
				'nama_kelas' => $kls->nama_kelas,
				'link_kelas' => $kls->link_kelas,
				'pj' => $pj,
				'peserta' => $peserta
			);
		}
		$this->template->load('template/template', 'kelas/sebaran', $data);
		$this->load->view('template/datatable');
	}
}
