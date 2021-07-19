<?php
class Model_absensi extends CI_Model
{

    public function getAllAbsen()
    {
        return $this->db->order_by('tgl_absen', 'ASC')
            ->get('absen')
            ->result();
    }
    public function getAllJumPeserta($id_absen)
    {
        return $this->db->get_where('absensi', ['id_absen' => $id_absen])
            ->num_rows();
    }
    public function getAllJumPesertaWithKelas($id_absen, $id_kelas)
    {
        return $this->db->join('peserta', 'absensi.id_peserta = peserta.id_peserta', 'left')
            ->where(['id_absen' => $id_absen, 'peserta.id_kelas' => $id_kelas])
            ->get('absensi')
            ->num_rows();
    }
    public function getJumMasuk($id_absen)
    {
        return $this->db->get_where('absensi', ['id_absen' => $id_absen, 'status' => 2])
            ->num_rows();
    }
    public function getJumMasukWithKelas($id_absen, $id_kelas)
    {
        return $this->db->join('peserta', 'absensi.id_peserta = peserta.id_peserta', 'left')
            ->where(['id_absen' => $id_absen, 'peserta.id_kelas' => $id_kelas, 'status' => 2])
            ->get('absensi')
            ->num_rows();
    }
    public function getOneAbsen($id)
    {
        return $this->db->where('id_absen', $id)
            ->get('absen')
            ->row();
    }
    public function getAbsensi($id_absen)
    {
        return $this->db->join('peserta', 'absensi.id_peserta = peserta.id_peserta', 'left')
            ->join('kelas', 'peserta.id_kelas = kelas.id_kelas', 'right')
            ->join('user', 'peserta.id_user = user.id_user', 'left')
            ->where('id_absen', $id_absen)
            ->get('absensi')
            ->result();
    }
    public function getAbsensiWithKelas($id_absen, $id_kelas)
    {
        return $this->db->join('peserta', 'absensi.id_peserta = peserta.id_peserta', 'left')
            ->join('kelas', 'peserta.id_kelas = kelas.id_kelas', 'right')
            ->join('user', 'peserta.id_user = user.id_user', 'left')
            ->where(['id_absen' => $id_absen, 'peserta.id_kelas' => $id_kelas])
            ->get('absensi')
            ->result();
    }
    public function getOneAbsensi($id_absensi)
    {
        return $this->db->join('peserta', 'absensi.id_peserta = peserta.id_peserta', 'left')
            ->join('kelas', 'peserta.id_kelas = kelas.id_kelas', 'right')
            ->join('user', 'peserta.id_user = user.id_user', 'left')
            ->where('id_absensi', $id_absensi)
            ->get('absensi')
            ->row_array();
    }
    function editAbsensi($id, $data)
    {
        $this->db->where('id_absensi', $id);
        $this->db->update('absensi', $data);
    }
}
