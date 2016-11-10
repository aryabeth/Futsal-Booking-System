<?php 
class m_datauser extends CI_Model{
	function __construct()
   {
      parent::__construct();
   }

   function get_list_user(){
      $sql = "SELECT * FROM user";
      $query = $this->db->query($sql);
      return $query->result();   
   }

   function add_user($data){
      $this->db->insert('user', $data);
      return TRUE;
   }

   function update_pass($value){
      $this->db->where('user_id', $value['user_id']);
      $update = $this->db->update('user', $value);

      if($update)
         return true;
      else
         return false;   
   }
	

}