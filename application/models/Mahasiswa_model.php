<?php

class Mahasiswa_model extends CI_Model{
    public function getAll()
    {
        return $this->db->get('mahasiswa')->result_array();
    }
    
    public function getSingle($id)
    {
        return $this->db->get_where('mahasiswa',['id'=>$id])->result_array();
    }

    public function hapusMahasiswa($id)
    {
        $this->db->delete('mahasiswa',['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function tambahMahasiswa($data)
    {
        $this->db->insert('mahasiswa',$data);
        return $this->db->affected_rows();
    }
    
    public function editMahasiswa($data,$id)
    {
        try{
            $cekid = $this->db->get_where('mahasiswa',['id'=>$id])->result_array();
            if(count($cekid) == 0){
                return -1;
            }

            $this->db->update('mahasiswa',$data,['id'=>$id]);
            return $this->db->affected_rows();
        }catch(Error $e){
            return "error";
        }
    }
}

?>