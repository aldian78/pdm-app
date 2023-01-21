<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan_m extends CI_Model {
	
	public function getKaryawan()
	{
		$this->db->select('*');
        $this->db->from('karyawan');
        $this->db->join('jabatan','jabatan.id_jabatan=karyawan.jabatan');
        $query = $this->db->get();
        return $query->result();
	}

	 public function getById($id)
    {
        $this->db->from('karyawan');
        $this->db->where('id_karyawan',$id);
        $query = $this->db->get();
 
        return $query->row();
    }

	public function editKaryawan($where, $data)
    {
    	$this->db->where('id_karyawan', $where);
        return $this->db->update('karyawan', $data);
    }

    public function hapusKaryawan($id){
    	$this->db->where('id_karyawan', $id);
		return $this->db->delete('karyawan');
    }
}