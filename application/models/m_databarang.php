<?php 
class m_databarang extends CI_Model{
	function __construct()
    {
      parent::__construct();
    }

    function get_list_barang(){
     	$sql = "SELECT * FROM data_barang";
		  $query = $this->db->query($sql);
    	return $query->result();	
  	}

  	function add_barang($data){
     	$this->db->insert('data_barang', $data);
     	return TRUE;
  	}

  	function hapus_barang($id){
     	$this->db->where('id_barang',$id);
		  $this->db->delete('data_barang');
     	return TRUE;
  	}

  	function update_list_barang($value){
  		$this->db->where('id_barang', $value['id_barang']);
      $update = $this->db->update('data_barang', $value);

        if($update)
            return true;
        else
            return false;   
  	}

}