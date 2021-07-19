<?php
class Model_kelas extends CI_Model
{

    public function getAllKelas()
    {
        return $this->db->order_by('id_kelas', 'DECS')
            ->get('kelas')
            ->result();
    }
    public function getAllKelasWithKelas($id_kelas)
    {
        return $this->db->where('id_kelas', $id_kelas)
            ->order_by('id_kelas', 'DECS')
            ->get('kelas')
            ->result();
    }
    public function getPJKelas($id)
    {
        return $this->db->join('user', 'pj.id_user = user.id_user', 'left')
            ->where('id_kelas', $id)
            ->order_by('id_pj', 'ASC')
            ->get('pj')
            ->result_array();
    }
    public function getPesertaKelas($id)
    {
        return $this->db->join('user', 'peserta.id_user = user.id_user', 'left')
            ->where('id_kelas', $id)
            ->get('peserta');
    }
    public function getOneKelas($id)
    {
        return $this->db->where('id_kelas', $id)
            ->get('kelas')
            ->row();
    }

    function editKelas($id, $data)
    {
        $this->db->where('id_kelas', $id);
        $this->db->update('kelas', $data);
    }

    function hapusKelas($id)
    {
        $this->db->where('id_kelas', $id);
        $this->db->delete('kelas');
    }
}
