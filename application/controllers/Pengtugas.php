<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengtugas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_pengtugas');
	}

	public function index()
	{
		$data['title'] = 'Data Tugas Trapara';
		$id_peserta = $this->Model_pengtugas->getOnePeserta($this->session->userdata('id'))->id_peserta;
		$tugas = $this->Model_pengtugas->getAllTugas();
		foreach ($tugas as $tgs) {
			$id_tugas = $tgs->id_tugas;
			$pengtugas = $this->Model_pengtugas->getOnePengtugas($id_tugas, $id_peserta);
			if ($pengtugas->num_rows() == 0) {
				$status_pengtugas = 0;
			} else {
				if ($pengtugas->row()->nilai == '') {
					$status_pengtugas = 1;
				} else {
					$status_pengtugas = 2;
				}
			}
			$data['tugas'][] = array(
				'id_tugas' => $id_tugas,
				'judul_tugas' => $tgs->judul_tugas,
				'deskripsi_tugas' => $tgs->deskripsi_tugas,
				'batas_tgl' => $tgs->batas_tgl,
				'status_pengtugas' => $status_pengtugas
			);
		}
		$this->template->load('template/template', 'pengtugas/lihat_data', $data);
		$this->load->view('template/datatable');
	}

	public function kumpul($id)
	{
		$data['title'] = 'Pengumpulan Tugas Trapara';
		$data['one_tugas'] = $this->Model_pengtugas->getOneTugas($id);
		$id_peserta = $this->Model_pengtugas->getOnePeserta($this->session->userdata('id'))->id_peserta;
		$pengtugas = $this->Model_pengtugas->getOnePengtugas($id, $id_peserta);
		if ($pengtugas->num_rows() == 0) {
			$status_pengtugas = 0;
		} else {
			if ($pengtugas->row()->nilai == '') {
				$status_pengtugas = 1;
			} else {
				$status_pengtugas = 2;
			}
			$one_pengtugas = $pengtugas->row();
			$filename = 'assets/uploads/tugas/' . $id . '/' . $one_pengtugas->berkas_peng;
			$fileinfo = get_file_info($filename);
			if ($one_pengtugas->berkas_revisi != '') {
				$filename2 = 'assets/uploads/revisi/' . $id . '/' . $one_pengtugas->berkas_revisi;
				$fileinfo2 = get_file_info($filename2);
			} else {
				$fileinfo2 = '';
			}
			$data['one_pengtugas'] = array(
				'id_pengtugas' => $one_pengtugas->id_pengtugas,
				'id_tugas' => $one_pengtugas->id_tugas,
				'id_peserta' => $one_pengtugas->id_peserta,
				'berkas_peng' => $fileinfo,
				'tgl_peng' => $one_pengtugas->tgl_peng,
				'nilai' => $one_pengtugas->nilai,
				'komentar' => $one_pengtugas->komentar,
				'berkas_revisi' => $fileinfo2,
			);
		}

		$data['status_pengtugas'] = $status_pengtugas;
		$data['id_peserta'] = $id_peserta;
		$this->template->load('template/template', 'pengtugas/form_pengtugas', $data);
	}

	public function uploadTugas()
	{
		$id_tugas = $this->input->post('id_tugas');
		$id_peserta = $this->input->post('id_peserta');
		// 5 minutes execution time
		@set_time_limit(5 * 60);
		// Uncomment this one to fake upload time
		// usleep(5000);

		// Settings

		$targetDir = './assets/uploads/tugas/' . $id_tugas . '/';
		//$targetDir = 'uploads';
		$cleanupTargetDir = true; // Remove old files
		$maxFileAge = 5 * 3600; // Temp file age in seconds


		// Create target dir
		if (!file_exists($targetDir)) {
			@mkdir($targetDir);
		}

		// Get a file name
		if (isset($_REQUEST["name"])) {
			$fileName = $_REQUEST["name"];
		} elseif (!empty($_FILES)) {
			$fileName = $_FILES["file"]["name"];
		} else {
			$fileName = uniqid("file_");
		}
		$data_peng = array(
			'id_tugas' => $id_tugas,
			'id_peserta' => $id_peserta,
			'berkas_peng' => $fileName,
			'tgl_peng' => time(),
		);

		$filePath = $targetDir . $fileName;

		// Chunking might be enabled
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


		// Remove old temp files	
		if ($cleanupTargetDir) {
			if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}

			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

				// If temp file is current file proceed to the next
				if ($tmpfilePath == "{$filePath}.part") {
					continue;
				}

				// Remove temp file if it is older than the max age and is not the current file
				if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);
		}


		// Open temp file
		if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}

		if (!empty($_FILES)) {
			if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
			}

			// Read binary input stream and append it to temp file
			if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		} else {
			if (!$in = @fopen("php://input", "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		}

		while ($buff = fread($in, 4096)) {
			fwrite($out, $buff);
		}

		@fclose($out);
		@fclose($in);

		// Check if file has been uploaded
		if (!$chunks || $chunk == $chunks - 1) {
			// Strip the temp .part suffix off 
			rename("{$filePath}.part", $filePath);
			$this->db->insert('pengtugas', $data_peng);
		}

		// Return Success JSON-RPC response
		die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
	}

	public function uploadRevisi()
	{
		$id_tugas = $this->input->post('id_tugas');
		$id_pengtugas = $this->input->post('id_pengtugas');
		// 5 minutes execution time
		@set_time_limit(5 * 60);
		// Uncomment this one to fake upload time
		// usleep(5000);

		// Settings

		$targetDir = './assets/uploads/revisi/' . $id_tugas . '/';
		//$targetDir = 'uploads';
		$cleanupTargetDir = true; // Remove old files
		$maxFileAge = 5 * 3600; // Temp file age in seconds


		// Create target dir
		if (!file_exists($targetDir)) {
			@mkdir($targetDir);
		}

		// Get a file name
		if (isset($_REQUEST["name"])) {
			$fileName = $_REQUEST["name"];
		} elseif (!empty($_FILES)) {
			$fileName = $_FILES["file"]["name"];
		} else {
			$fileName = uniqid("file_");
		}

		$filePath = $targetDir . $fileName;

		// Chunking might be enabled
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


		// Remove old temp files	
		if ($cleanupTargetDir) {
			if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}

			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

				// If temp file is current file proceed to the next
				if ($tmpfilePath == "{$filePath}.part") {
					continue;
				}

				// Remove temp file if it is older than the max age and is not the current file
				if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);
		}


		// Open temp file
		if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}

		if (!empty($_FILES)) {
			if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
			}

			// Read binary input stream and append it to temp file
			if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		} else {
			if (!$in = @fopen("php://input", "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		}

		while ($buff = fread($in, 4096)) {
			fwrite($out, $buff);
		}

		@fclose($out);
		@fclose($in);

		// Check if file has been uploaded
		if (!$chunks || $chunk == $chunks - 1) {
			// Strip the temp .part suffix off 
			rename("{$filePath}.part", $filePath);
			$data_peng = array(
				'berkas_revisi' => $fileName,
			);
			$this->Model_pengtugas->updateRevisi($id_pengtugas, $data_peng);
		}

		// Return Success JSON-RPC response
		die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');


		// $config['upload_path']   = './assets/uploads/revisi/' . $id_tugas . '/';
		// $config['allowed_types'] = '*';
		// $this->upload->initialize($config);
		// if ($this->upload->do_upload('berkas_revisi')) {
		// 	$file_name = $this->upload->data('file_name');
		// 	$data_peng = array(
		// 		'berkas_revisi' => $file_name,
		// 	);
		// 	$this->Model_pengtugas->updateRevisi($id_pengtugas, $data_peng);
		// }
	}

	public function hapusTugas($id)
	{
		$berkas = $this->Model_pengtugas->getOneBerkasPeng($id);
		$filename = $berkas->berkas_peng;
		$filepath = './assets/uploads/tugas/' . $berkas->id_tugas . '/' . $filename;
		unlink($filepath);
		$this->Model_pengtugas->hapusPengtugas($id);
		$this->session->set_flashdata('message_success', 'Berhasil menghapus file pengumpulan tugas Trapara.');
		redirect('pengtugas/kumpul/' . $berkas->id_tugas);
	}
	public function hapusRevisi($id)
	{
		$berkas = $this->Model_pengtugas->getOneBerkasPeng($id);
		$filename = $berkas->berkas_revisi;
		$filepath = './assets/uploads/revisi/' . $berkas->id_tugas . '/' . $filename;
		unlink($filepath);
		$data_peng = array(
			'berkas_revisi' => '',
		);
		$this->Model_pengtugas->updateRevisi($id, $data_peng);
		$this->session->set_flashdata('message_success', 'Berhasil menghapus file revisi tugas Trapara.');
		redirect('pengtugas/kumpul/' . $berkas->id_tugas);
	}
}
