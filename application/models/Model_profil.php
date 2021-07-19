<?php
class Model_profil extends CI_Model
{
    public function getProfilPeserta($id)
    {
        return $this->db->join('user', 'peserta.id_user = user.id_user', 'left')
            ->join('kelas', 'peserta.id_kelas = kelas.id_kelas', 'inner')
            ->where('peserta.id_user', $id)
            ->get('peserta')
            ->row();
    }
    public function getProfilPenjab($id)
    {
        return $this->db->join('user', 'pj.id_user = user.id_user', 'left')
            ->join('kelas', 'pj.id_kelas = kelas.id_kelas', 'inner')
            ->where('pj.id_user', $id)
            ->get('pj')
            ->row();
    }
    public function getProfilPemateri($id)
    {
        return $this->db->join('user', 'pemateri.id_user = user.id_user', 'left')
            ->where('pemateri.id_user', $id)
            ->get('pemateri')
            ->row();
    }
    public function getProfilUser($id)
    {
        return $this->db->where('id_user', $id)
            ->get('user')
            ->row();
    }
    function editUser($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }
    function editPeserta($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('peserta', $data);
    }
    function editPemateri($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('pemateri', $data);
    }
    function editPenjab($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('pj', $data);
    }
}
