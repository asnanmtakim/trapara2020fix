<?php
class Model_pemateri extends CI_Model
{

    public function getAllPemateri()
    {
        return $this->db->join('user', 'pemateri.id_user = user.id_user', 'left')
            ->order_by('id_pemateri', 'DECS')
            ->get('pemateri')
            ->result();
    }
    public function getOnePemateri($id)
    {
        return $this->db->join('user', 'pemateri.id_user = user.id_user', 'left')
            ->where('id_pemateri', $id)
            ->get('pemateri')
            ->row();
    }

    function editUser($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }

    function editPemateri($id, $data)
    {
        $this->db->where('id_pemateri', $id);
        $this->db->update('pemateri', $data);
    }

    function hapusUser($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
    }
    function hapusPemateri($id)
    {
        $this->db->where('id_pemateri', $id);
        $this->db->delete('pemateri');
    }
}
