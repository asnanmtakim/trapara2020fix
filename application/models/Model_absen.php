<?php
class Model_absen extends CI_Model
{

    public function getAllAbsen()
    {
        return $this->db->order_by('tgl_absen', 'ASC')
            ->get('absen')
            ->result();
    }
    public function getAllPeserta()
    {
        return $this->db->join('user', 'peserta.id_user = user.id_user', 'left')
            ->join('kelas', 'peserta.id_kelas = kelas.id_kelas', 'inner')
            ->order_by('peserta.id_kelas', 'ASC')
            ->get('peserta')
            ->result();
    }
    public function getOneAbsen($id)
    {
        return $this->db->where('id_absen', $id)
            ->get('absen')
            ->row();
    }
    function editAbsen($id, $data)
    {
        $this->db->where('id_absen', $id);
        $this->db->update('absen', $data);
    }
    function hapusAbsen($id)
    {
        $this->db->where('id_absen', $id);
        $this->db->delete('absen');
    }
    function hapusAbsensi($id)
    {
        $this->db->where('id_absen', $id);
        $this->db->delete('absensi');
    }
}
