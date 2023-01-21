<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_m extends CI_Model {

    public function getJabatan()
    {
        $query = $this->db->get('jabatan');
        return $query->result();
    }
	
	public function getById($id)
    {
        $this->db->from('jabatan');
        $this->db->where('id_jabatan',$id);
        $query = $this->db->get();
 
        return $query->row();
    }

	public function editJabatan($where, $data)
    {
    	$this->db->where('id_jabatan', $where);
        return $this->db->update('jabatan', $data);
    }

    public function hapusJabatan($id){
    	$this->db->where('id_jabatan', $id);
		return $this->db->delete('jabatan');
    }

}