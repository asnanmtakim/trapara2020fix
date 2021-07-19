<?php
class Model_koreksi extends CI_Model
{

    public function getAllKoreksi()
    {
        return $this->db->order_by('id_tugas', 'DESC')
            ->get('koreksi')
            ->result();
    }
    public function getAllKoreksiWithPemateri($id)
    {
        return $this->db->where('id_pemateri', $id)
            ->or_where('id_pemateri2', $id)
            ->order_by('tgl_koreksi', 'DECS')
            ->get('koreksi')
            ->result();
    }
    public function getAllKoreksiWithKelas($id)
    {
        return $this->db->where('id_kelas', $id)
            ->order_by('tgl_koreksi', 'DECS')
            ->get('koreksi')
            ->result();
    }
    public function getPemateriKoreksi($id)
    {
        return $this->db->join('user', 'pemateri.id_user = user.id_user', 'left')
            ->where('id_pemateri', $id)
            ->get('pemateri')
            ->row();
    }
    public function getPesertaKoreksi($id)
    {
        return $this->db->join('user', 'peserta.id_user = user.id_user', 'left')
            ->where('id_peserta', $id)
            ->get('peserta')
            ->row();
    }
    public function getKelasKoreksi($id)
    {
        return $this->db->where('id_kelas', $id)
            ->get('kelas')
            ->row();
    }
    public function getTugasKoreksi($id)
    {
        return $this->db->where('id_tugas', $id)
            ->get('tugas')
            ->row();
    }
    public function getPengtugasKoreksi($id_kelas, $id_tugas)
    {
        return $this->db->join('peserta', 'pengtugas.id_peserta = peserta.id_peserta', 'right')
            ->join('user', 'peserta.id_user = user.id_user', 'right')
            ->where(['peserta.id_kelas' => $id_kelas, 'id_tugas' => $id_tugas])
            ->order_by('id_pengtugas', 'ASC')
            ->get('pengtugas');
    }
    public function getPengtugasKoreksiNilai($id_kelas, $id_tugas)
    {
        return $this->db->join('peserta', 'pengtugas.id_peserta = peserta.id_peserta', 'right')
            ->where(['peserta.id_kelas' => $id_kelas, 'id_tugas' => $id_tugas])
            ->where('nilai !=', '')
            ->order_by('id_pengtugas', 'ASC')
            ->get('pengtugas');
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
    public function getAllTugas()
    {
        return $this->db->order_by('id_tugas', 'ASC')
            ->get('tugas')
            ->result();
    }
    public function getOneKoreksi($id)
    {
        return $this->db->where('id_koreksi', $id)
            ->get('koreksi')
            ->row();
    }
    public function getOnePengtugas($id)
    {
        return $this->db->where('id_pengtugas', $id)
            ->get('pengtugas')
            ->row();
    }
    function editNilaiPengtugas($id, $data)
    {
        $this->db->where('id_pengtugas', $id);
        $this->db->update('pengtugas', $data);
    }




    function editKoreksi($id, $data)
    {
        $this->db->where('id_koreksi', $id);
        $this->db->update('koreksi', $data);
    }
    function hapusKoreksi($id)
    {
        $this->db->where('id_koreksi', $id);
        $this->db->delete('koreksi');
    }
}
