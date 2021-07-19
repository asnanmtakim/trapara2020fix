<?php
class Model_tugas extends CI_Model
{

    public function getAllTugas()
    {
        return $this->db->order_by('tgl_tugas', 'DECS')
            ->get('tugas')
            ->result();
    }
    public function getOneTugas($id)
    {
        return $this->db->where('id_tugas', $id)
            ->get('tugas')
            ->row();
    }
    function editTugas($id, $data)
    {
        $this->db->where('id_tugas', $id);
        $this->db->update('tugas', $data);
    }
    function hapusTugas($id)
    {
        $this->db->where('id_tugas', $id);
        $this->db->delete('tugas');
    }
}
