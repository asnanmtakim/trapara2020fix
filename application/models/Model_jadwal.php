<?php
class Model_jadwal extends CI_Model
{

    public function getAllJadwal()
    {
        return $this->db->order_by('id_materi', 'ASC')
            ->get('jadwal')
            ->result();
    }
    public function getAllJadwalWithKelas($id)
    {
        return $this->db->where('id_kelas', $id)
            ->order_by('tgl_jadwal', 'DECS')
            ->get('jadwal')
            ->result();
    }
    public function getAllJadwalWithPemateri($id)
    {
        return $this->db->where('id_pemateri', $id)
            ->or_where('id_pemateri2', $id)
            ->order_by('tgl_jadwal', 'DECS')
            ->get('jadwal')
            ->result();
    }
    public function getPemateriJadwal($id)
    {
        return $this->db->join('user', 'pemateri.id_user = user.id_user', 'left')
            ->where('id_pemateri', $id)
            ->get('pemateri')
            ->row();
    }
    public function getKelasJadwal($id)
    {
        return $this->db->where('id_kelas', $id)
            ->get('kelas')
            ->row();
    }
    public function getMateriJadwal($id)
    {
        return $this->db->where('id_materi', $id)
            ->get('materi')
            ->row();
    }
    public function getBerkasMateri($id)
    {
        return $this->db->where('id_materi', $id)
            ->get('berkas_materi')
            ->result_array();
    }
    public function getAllPemateri()
    {
        return $this->db->join('user', 'pemateri.id_user = user.id_user', 'left')
            ->order_by('id_pemateri', 'ASC')
            ->get('pemateri')
            ->result();
    }
    public function getAllKelas()
    {
        return $this->db->order_by('id_kelas', 'ASC')
            ->get('kelas')
            ->result();
    }
    public function getAllMateri()
    {
        return $this->db->order_by('id_materi', 'ASC')
            ->get('materi')
            ->result();
    }
    public function getOneJadwal($id)
    {
        return $this->db->where('id_jadwal', $id)
            ->get('jadwal')
            ->row();
    }
    function editJadwal($id, $data)
    {
        $this->db->where('id_jadwal', $id);
        $this->db->update('jadwal', $data);
    }
    function hapusJadwal($id)
    {
        $this->db->where('id_jadwal', $id);
        $this->db->delete('jadwal');
    }



    public function getBerkasJadwal($id)
    {
        return $this->db->where('id_materi', $id)
            ->get('berkas_materi')
            ->result_array();
    }

    function getOneBerkasJadwal($id)
    {
        return $this->db->where('id_berkas_materi', $id)
            ->get('berkas_materi')
            ->row();
    }
    function hapusBerkasJadwal($id)
    {
        $this->db->where('id_berkas_materi', $id);
        $this->db->delete('berkas_materi');
    }
}
