<?php
class Model_lap_absensi extends CI_Model
{

    public function getAllPeserta()
    {
        return $this->db->join('user', 'peserta.id_user = user.id_user', 'left')
            ->join('kelas', 'peserta.id_kelas = kelas.id_kelas', 'inner')
            ->order_by('peserta.id_kelas', 'ASC')
            ->get('peserta')
            ->result();
    }
    public function getAllPesertaWithKelas($id_kelas)
    {
        return $this->db->join('user', 'peserta.id_user = user.id_user', 'left')
            ->join('kelas', 'peserta.id_kelas = kelas.id_kelas', 'inner')
            ->where('peserta.id_kelas', $id_kelas)
            ->order_by('peserta.id_kelas', 'ASC')
            ->get('peserta')
            ->result();
    }
    public function getOnePeserta($id)
    {
        return $this->db->join('user', 'peserta.id_user = user.id_user', 'left')
            ->join('kelas', 'peserta.id_kelas = kelas.id_kelas', 'inner')
            ->where('id_peserta', $id)
            ->order_by('peserta.id_kelas', 'ASC')
            ->get('peserta')
            ->row();
    }

    public function getAllAbsen()
    {
        return $this->db->get('absen')
            ->num_rows();
    }

    public function getAbsensiMasuk($id_peserta)
    {
        return $this->db->get_where('absensi', ['id_peserta' => $id_peserta, 'status' => 2])
            ->num_rows();
    }
    public function getAbsensiIzin($id_peserta)
    {
        return $this->db->get_where('absensi', ['id_peserta' => $id_peserta, 'status' => 1])
            ->num_rows();
    }
    public function getAbsensiAlfa($id_peserta)
    {
        return $this->db->get_where('absensi', ['id_peserta' => $id_peserta, 'status' => 0])
            ->num_rows();
    }
}
