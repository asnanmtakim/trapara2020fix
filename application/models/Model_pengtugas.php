<?php
class Model_pengtugas extends CI_Model
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
    public function getOnePeserta($id_user)
    {
        return $this->db->get_where('peserta', ['id_user' => $id_user])->row();
    }
    public function getOnePengtugas($id_tugas, $id_peserta)
    {
        return $this->db->get_where('pengtugas', ['id_tugas' => $id_tugas, 'id_peserta' => $id_peserta]);
    }
    public function getOneBerkasPeng($id_pengtugas)
    {
        return $this->db->get_where('pengtugas', ['id_pengtugas' => $id_pengtugas])->row();
    }
    function hapusPengtugas($id)
    {
        $this->db->where('id_pengtugas', $id);
        $this->db->delete('pengtugas');
    }
    function updateRevisi($id, $data)
    {
        $this->db->where('id_pengtugas', $id);
        $this->db->update('pengtugas', $data);
    }
}
