<?php 
class m_login extends CI_Model{
	function __construct()
   {
      parent::__construct();
   }

   function login_validation(){  
      $this->db->where('username', $this->input->post('username'));
      $this->db->where('password', md5($this->input->post('password')));   
      $query = $this->db->get('user');

      if( $query->num_rows == 1 )  {
         return true;
      }
   }

   function get_user($username){
      $this->db->select('*');
      $this->db->from('user');
      $this->db->where('username',$username);
      $query = $this->db->get();
      return $query->result();   
   }
   
   
}