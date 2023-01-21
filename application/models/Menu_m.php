<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_m extends CI_Model {
	
	public function getMenuUser(){
		$this->db->select('*');
        $this->db->from('menu_user');
        $this->db->join('user','user.id_user=menu_user.id_user');
        $this->db->join('parent_menu','parent_menu.id_parent=menu_user.parent_id');
        $query = $this->db->get();
        return $query->result();
	}

	public function getMenu(){
        $query = $this->db->get('menu');
        return $query->result();
	}

	public function getMenuWithLevel(){
      	$query = "SELECT `menu`.`menu_id` as `id_menu`, `menu_level`.`level` as `lvl`, `menu_level`.`id_level` as `level_id`, `menu`.`menu_name` as `name_menu`, `menu`.`menu_link` as `link_menu`, `menu`.`menu_icon` as `icon_menu`, `parent_menu`.`id_parent` AS `id_induk`, `parent_menu`.`parent_name` AS `induk`, `menu`.`is_active` as `status` FROM `menu` JOIN `parent_menu` ON `parent_menu`.`id_parent` = `menu`.`parent_id` JOIN `menu_level` ON `menu_level`.`id_level` = `menu`.`id_level`";
        $result = $this->db->query($query);
        return $result->result();
	}

	public function getLevel()
    {
        $query = $this->db->get('menu_level');
        return $query->result();
    }


	public function getParentMenu()
    {
        $query = $this->db->get('parent_menu');
        return $query->result();
    }

    public function getParent(){
		$this->db->select('*');
        $this->db->from('parent_menu');
        $this->db->join('menu','menu.menu_id=parent_menu.menu_id');
        $query = $this->db->get();
        return $query->result();
	}

    public function editMenuUser($where, $data)
    {
    	$this->db->where('no_setting', $where);
        return $this->db->update('menu_user', $data);
    }

    public function hapusMenuUser($id){
    	$this->db->where('no_setting', $id);
		return $this->db->delete('menu_user');
    }

     public function editMenu($where, $data)
    {
    	$this->db->where('menu_id', $where);
        return $this->db->update('menu', $data);
    }

    public function hapusMenu($id){
    	$this->db->where('menu_id', $id);
		return $this->db->delete('menu');
    }
    public function editParent($where, $data)
    {
    	$this->db->where('id_parent', $where);
        return $this->db->update('parent_menu', $data);
    }

    public function hapusParent($id){
    	$this->db->where('id_parent', $id);
		return $this->db->delete('parent_menu');
    }

    public function editLevel($where, $data)
    {
    	$this->db->where('id_level', $where);
        return $this->db->update('menu_level', $data);
    }

    public function hapusLevel($id){
    	$this->db->where('id_level', $id);
		return $this->db->delete('menu_level');
    }

    public function getParentById($id)
    {
        $this->db->from('parent_menu');
        $this->db->where('id_parent',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
}