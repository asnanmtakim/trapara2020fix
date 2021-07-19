<?php
class Model_materi extends CI_Model
{

    public function getAllMateri()
    {
        return $this->db->order_by('tgl_materi', 'DECS')
            ->get('materi')
            ->result();
    }
    public function getBerkasMateri($id)
    {
        return $this->db->where('id_materi', $id)
            ->get('berkas_materi')
            ->result_array();
    }
    public function getOneMateri($id)
    {
        return $this->db->where('id_materi', $id)
            ->get('materi')
            ->row();
    }
    function getOneBerkasMateri($id)
    {
        return $this->db->where('id_berkas_materi', $id)
            ->get('berkas_materi')
            ->row();
    }
    function hapusBerkasMateri($id)
    {
        $this->db->where('id_berkas_materi', $id);
        $this->db->delete('berkas_materi');
    }
    function editMateri($id, $data)
    {
        $this->db->where('id_materi', $id);
        $this->db->update('materi', $data);
    }
    function hapusMateri($id)
    {
        $this->db->where('id_materi', $id);
        $this->db->delete('materi');
    }
}
