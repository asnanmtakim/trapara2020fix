<?php
class Model_peserta extends CI_Model
{

    public function getAllPeserta()
    {
        return $this->db->join('user', 'peserta.id_user = user.id_user', 'left')
            ->join('kelas', 'peserta.id_kelas = kelas.id_kelas', 'inner')
            ->order_by('peserta.id_kelas', 'ASC')
            ->get('peserta')
            ->result();
    }
    public function getKelas()
    {
        return $this->db->order_by('id_kelas', 'ASC')
            ->get('kelas')
            ->result();
    }
    public function getOnePeserta($id)
    {
        return $this->db->join('user', 'peserta.id_user = user.id_user', 'left')
            ->join('kelas', 'peserta.id_kelas = kelas.id_kelas', 'inner')
            ->order_by('peserta.id_kelas', 'ASC')
            ->where('id_peserta', $id)
            ->get('peserta')
            ->row();
    }

    function editUser($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }

    function editPeserta($id, $data)
    {
        $this->db->where('id_peserta', $id);
        $this->db->update('peserta', $data);
    }

    function hapusUser($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
    }
    function hapusPeserta($id)
    {
        $this->db->where('id_peserta', $id);
        $this->db->delete('peserta');
    }
}
