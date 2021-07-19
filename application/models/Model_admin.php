<?php
class Model_admin extends CI_Model
{

    public function getAllAdmin()
    {
        return $this->db->order_by('id_user', 'DECS')
            ->where('id_role', 1)
            ->get('user')
            ->result();
    }
    public function getOneAdmin($id)
    {
        return $this->db->where('id_user', $id)
            ->get('user')
            ->row();
    }

    function editAdmin($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }

    function hapusAdmin($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
    }
}
