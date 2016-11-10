<?php 
class m_koreksi extends CI_Model{
	function __construct()
    {
      parent::__construct();
    }

    function get_list_koreksi_barang(){
      $sql = "SELECT * FROM koreksi_barang";
        $query = $this->db->query($sql);
      return $query->result();   
   }

   function get_list_koreksi_cash(){
      $sql = "SELECT * FROM koreksi_cash";
        $query = $this->db->query($sql);
      return $query->result();   
   }

    
    function add_koreksi_barang($data){
      $this->db->insert('koreksi_barang', $data);
      return TRUE;
    }

    function add_koreksi_cash($data){
      $this->db->insert('koreksi_cash', $data);
      return TRUE;
    }

    function create_nota_barang($year,$month){
      $sql = "SELECT SUBSTR(id_nota, 10, 4)'id_nota' FROM koreksi_barang 
              WHERE SUBSTR(id_nota, 4, 4) = '$year' 
              AND SUBSTR(id_nota, 8, 2) = '$month' 
              ORDER BY id_nota 
              DESC LIMIT 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $id_nota = $query->row_array();
            $id_nota = intval($id_nota['id_nota']) + 1;

            if (strlen($id_nota) == '1') {
                $id_nota = '000' . $id_nota;
            } elseif (strlen($id_nota) == '2') {
                $id_nota = '00' . $id_nota;
            } elseif (strlen($id_nota) == '3') {
                $id_nota = '0' . $id_nota;
            } else {
                $id_nota = strlen($id_nota);
            }
            return $year . $month . $id_nota;
        } else {
            return $year . $month . '0001';
        }
    }

    function create_nota_cash($year,$month){
      $sql = "SELECT SUBSTR(id_nota, 10, 4)'id_nota' FROM koreksi_cash
              WHERE SUBSTR(id_nota, 4, 4) = '$year' 
              AND SUBSTR(id_nota, 8, 2) = '$month' 
              ORDER BY id_nota 
              DESC LIMIT 1";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $id_nota = $query->row_array();
            $id_nota = intval($id_nota['id_nota']) + 1;

            if (strlen($id_nota) == '1') {
                $id_nota = '000' . $id_nota;
            } elseif (strlen($id_nota) == '2') {
                $id_nota = '00' . $id_nota;
            } elseif (strlen($id_nota) == '3') {
                $id_nota = '0' . $id_nota;
            } else {
                $id_nota = strlen($id_nota);
            }
            return $year . $month . $id_nota;
        } else {
            return $year . $month . '0001';
        }
    }

    //buat autocomplate
    function get_list_barang(){
      $sql = "SELECT id_barang, nama_barang, harga_jual from data_barang";
      $query = $this->db->query($sql);
      if ($query) {
          return $query->result_array();
      }else{
          return false;
      }
    }

    
}