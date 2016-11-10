<?php 
class m_parkir extends CI_Model{
	function __construct()
    {
      parent::__construct();
    }

    function get_list_parkir(){
     	$sql = "SELECT * FROM nota_parkir";
		  $query = $this->db->query($sql);
    	return $query->result();	
  	}

  	function add_parkir($data){
     	$this->db->insert('nota_parkir', $data);
     	return TRUE;
  	}

  	function hapus_parkir($id){
      
      
      $sql = "UPDATE nota_parkir SET status = 'CANCELED', jml = jml-jml-jml WHERE id_nota = '$id'";
      $query = $this->db->query($sql);
      return TRUE;
    //  	$this->db->where('id_nota',$id);
		//    $this->db->delete('nota_parkir');
    //  	return TRUE;
  	}

    function create_nota($year,$month){
      $sql = "SELECT SUBSTR(id_nota, 7, 4)'id_nota' FROM nota_parkir 
              WHERE SUBSTR(id_nota, 1, 4) = '$year' 
              AND SUBSTR(id_nota, 5, 2) = '$month' 
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

}