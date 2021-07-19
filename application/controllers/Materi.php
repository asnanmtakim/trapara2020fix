<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_materi');
	}

	public function index()
	{
		$data['title'] = 'Data Materi Trapara';
		$materi = $this->Model_materi->getAllMateri();
		foreach ($materi as $mtr) {
			$id_materi = $mtr->id_materi;
			$berkas_materi = $this->Model_materi->getBerkasMateri($id_materi);
			$data['materi'][] = array(
				'id_materi' => $id_materi,
				'judul_materi' => $mtr->judul_materi,
				'deskripsi_materi' => $mtr->deskripsi_materi,
				'tgl_materi' => $mtr->tgl_materi,
				'berkas_materi' => $berkas_materi
			);
		}
		$this->template->load('template/template', 'materi/lihat_data', $data);
		$this->load->view('template/datatable');
	}

	public function post()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'judul',
					'label' => 'Judul materi',
					'rules' => 'trim|required|min_length[3]|max_length[50]'
				],
				[
					'field' => 'deskripsi',
					'label' => 'Deskripsi materi',
					'rules' => 'trim|required|min_length[3]'
				],
				[
					'field' => 'tgl',
					'label' => 'Tanggal pelaksanaan',
					'rules' => 'trim|required'
				],
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$data['title'] = 'Input Materi Trapara';
				$this->template->load('template/template', 'materi/form_input', $data);
			} else {
				$id = '';
				$judul = $this->input->post('judul', true);
				$deskripsi = $this->input->post('deskripsi', true);
				$tgl = $this->input->post('tgl', true);
				$buat = time();
				$data_materi = array(
					'judul_materi' => $judul,
					'deskripsi_materi' => $deskripsi,
					'tgl_materi' => $tgl,
					'tgl_buat' => $buat
				);
				$this->db->insert('materi', $data_materi);
				$id_materi = $this->db->get_where('materi', ['tgl_buat' => $buat])->row()->id_materi;
				if (!is_dir('assets/uploads/materi/' . $id_materi)) {
					mkdir('./assets/uploads/materi/' . $id_materi, 0777, TRUE);
				}
				$this->session->set_flashdata('message_success', 'Berhasil menambah data materi Trapara.');
				redirect('materi');
			}
		} else {
			$data['title'] = 'Input Materi Trapara';
			$this->template->load('template/template', 'materi/form_input', $data);
		}
	}

	public function berkas($id)
	{
		$data['title'] = 'Input Berkas Materi Trapara';
		$data['det_materi'] = $this->Model_materi->getOneMateri($id);
		$berkas = $this->Model_materi->getBerkasMateri($id);
		foreach ($berkas as $bks) {
			$filename = 'assets/uploads/materi/' . $id . '/' . $bks['berkas_materi'];
			$fileinfo = get_file_info($filename);
			$data['berkas'][] = array(
				'id_berkas_materi' => $bks['id_berkas_materi'],
				'berkas_materi' => $bks['berkas_materi'],
				'info_berkas' => $fileinfo
			);
		}
		// var_dump($data);
		$this->template->load('template/template', 'materi/form_berkas', $data);
	}

	public function uploadBerkas()
	{
		$id_materi = $this->input->post('id');
		$config['upload_path']   = './assets/uploads/materi/' . $id_materi . '/';
		$config['allowed_types'] = '*';
		$this->upload->initialize($config);
		if ($this->upload->do_upload('berkas')) {
			$file_name = $this->upload->data('file_name');
			$this->db->insert('berkas_materi', array('id_materi' => $id_materi, 'berkas_materi' => $file_name));
		}
	}

	public function hapusBerkas($id)
	{
		$berkas = $this->Model_materi->getOneBerkasMateri($id);
		$filename = $berkas->berkas_materi;
		$filepath = './assets/uploads/materi/' . $berkas->id_materi . '/' . $filename;
		unlink($filepath);
		$this->Model_materi->hapusBerkasMateri($id);
		$this->session->set_flashdata('message_success', 'Berhasil menghapus file berkas materi Trapara.');
		redirect('materi/berkas/' . $berkas->id_materi);
	}

	public function edit()
	{
		if (isset($_POST['submit'])) {
			$config = array(
				[
					'field' => 'judul',
					'label' => 'Judul materi',
					'rules' => 'trim|required|min_length[3]|max_length[50]'
				],
				[
					'field' => 'deskripsi',
					'label' => 'Deskripsi materi',
					'rules' => 'trim|required|min_length[3]'
				],
				[
					'field' => 'tgl',
					'label' => 'Tanggal pelaksanaan',
					'rules' => 'trim|required'
				],
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('message_error', 'Data yang diisi harus valid.');
				$id_materi = $this->input->post('id');
				$data['title'] = 'Edit Materi Trapara';
				$data['one_materi'] = $this->Model_materi->getOneMateri($id_materi);
				$this->template->load('template/template', 'materi/form_edit', $data);
			} else {
				$id_materi = $this->input->post('id', true);
				$judul = $this->input->post('judul', true);
				$deskripsi = $this->input->post('deskripsi', true);
				$tgl = $this->input->post('tgl', true);
				$data_materi = array(
					'judul_materi' => $judul,
					'deskripsi_materi' => $deskripsi,
					'tgl_materi' => $tgl
				);
				$this->Model_materi->editMateri($id_materi, $data_materi);
				$this->session->set_flashdata('message_success', 'Berhasil mengedit data materi Trapara.');
				redirect('materi');
			}
		} else {
			$id_materi = $this->uri->segment(3);
			$data['title'] = 'Edit Materi Trapara';
			$data['one_materi'] = $this->Model_materi->getOneMateri($id_materi);
			$this->template->load('template/template', 'materi/form_edit', $data);
		}
	}

	public function hapus()
	{
		$id_materi = $this->uri->segment(3);
		$path = './assets/uploads/materi/' . $id_materi . '/';
		delete_files($path, TRUE);
		$this->Model_materi->hapusMateri($id_materi);
		$this->session->set_flashdata('message_success', 'Berhasil menghapus data materi Trapara.');
		redirect('materi');
	}
}
