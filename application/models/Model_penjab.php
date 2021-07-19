<?php
class Model_penjab extends CI_Model
{

    public function getAllPenjab()
    {
        return $this->db->join('user', 'pj.id_user = user.id_user', 'left')
            ->join('kelas', 'pj.id_kelas = kelas.id_kelas', 'inner')
            ->order_by('pj.id_kelas', 'ASC')
            ->get('pj')
            ->result();
    }
    public function getKelas()
    {
        return $this->db->order_by('id_kelas', 'ASC')
            ->get('kelas')
            ->result();
    }
    public function getOnePenjab($id)
    {
        return $this->db->join('user', 'pj.id_user = user.id_user', 'left')
            ->join('kelas', 'pj.id_kelas = kelas.id_kelas', 'inner')
            ->order_by('pj.id_kelas', 'ASC')
            ->where('id_pj', $id)
            ->get('pj')
            ->row();
    }

    function editUser($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }

    function editPenjab($id, $data)
    {
        $this->db->where('id_pj', $id);
        $this->db->update('pj', $data);
    }

    function hapusUser($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
    }
    function hapusPenjab($id)
    {
        $this->db->where('id_pj', $id);
        $this->db->delete('pj');
    }
}
