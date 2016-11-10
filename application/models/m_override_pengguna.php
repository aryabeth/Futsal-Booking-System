<?php 
class m_override_pengguna extends CI_Model {

  var $table = "user";

  function __construct() {
    parent::__construct();
  }

  function user_check($username, $password) {
    $this->db->from($this->table);
    $this->db->where('username',$username);
    $this->db->where('password',md5($password));
    $query = $this->db->get();

    if($query->row()) {
      foreach($query->result() as $row) {
        $data_user = array(
          'user_id' => $row->user_id,
          'username' => $username,
          'level' => $row->level,
          'status' => TRUE
        );
      }

      if($row->level == 0 || $row->level == 1) {
        return $data_user;
      }
      else {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();

        $data['inputerror'][] = 'username';
        $data['error_string'][] = 'must be overrided by root/supervisor';
        $data['inputerror'][] = 'password';
        $data['error_string'][] = 'must be overrided by root/supervisor';
        $data['status'] = FALSE;

        return $data;
      }
      
    }
    else {
      $data = array();
      $data['error_string'] = array();
      $data['inputerror'] = array();

      $data['inputerror'][] = 'username';
      $data['error_string'][] = 'wrong username/password';
      $data['inputerror'][] = 'password';
      $data['error_string'][] = 'wrong username/password';
      $data['status'] = FALSE;

      return $data;
    }
  }

  function get_username_by_id($id) {
    $this->db->from($this->table);
    $this->db->where('user_id',$id);
    $query = $this->db->get();

    if ($query->row()) return $query->result()[0]->username;
  }
}