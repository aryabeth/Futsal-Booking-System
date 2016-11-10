<?php 
class m_pembelian extends CI_Model{
	function __construct()
    {
      parent::__construct();
    }

    function get_list_temp($user_id){
     	$sql = "SELECT *,((hargabeli *jumlah)-disc) as subtotal FROM pembeliantemp WHERE operator_id = $user_id";
		  $query = $this->db->query($sql);
    	return $query->result();	
  	}

    function get_list_nota(){

      $sql = "SELECT *, (grosstotal-discbelitotal) as tagihan FROM pembeliannota";
      $query = $this->db->query($sql);
      return $query->result();  
    }

  	function add_temp($data){

      $sql = "SELECT kode, operator_id FROM pembeliantemp WHERE kode = $data[kode] AND operator_id = $data[operator_id]";
      $query = $this->db->query($sql);
      $num = $query->num_rows();
      if ($num>0) {
        $sql = "UPDATE `pembeliantemp` SET `jumlah`= jumlah + ".$data[jumlah].", hargabeli = ".$data[hargabeli]." WHERE `kode` = ".$data[kode]." AND operator_id = ".$data[operator_id] ;
        $query = $this->db->query($sql);
        return TRUE;
      }else{
        $this->db->insert('pembeliantemp', $data);
        return TRUE;
      }
  	}

    function get_list_detail_nota($id_nota){
      $sql = "SELECT *,((hargabeli*jumlah)-disc) AS subtotal FROM pembelian WHERE nota = '$id_nota'";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

    function get_bayar_hutang($id_nota){
      $sql = "SELECT * FROM pembelianbayarnota WHERE nota = '$id_nota'";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

    function add_pembelian($data, $operator_id){
      $sql = "SELECT kode,nama,hargabeli,jumlah,disc,operator_id,status FROM pembeliantemp WHERE operator_id = $operator_id";
      $query = $this->db->query($sql);
      $pembelian = $query->result(); 
      
      // $not = $data->nota;
      foreach ($pembelian as $nota ) {
        $nota->tanggal_pembelian = $data['tanggal_pembelian'];
        $nota->nota = $data['nota'];
        $nota->operator_id = $data['operator'];
        $nota->override = $data['override'];
        $nota->status = $data['status'];

        $this->db->insert('pembelian', $nota);
        $this->update_data_barang($nota->kode, $nota->hargabeli, $nota->jumlah);
      }

      $this->reset($operator_id);


      return TRUE;
    }

    function update_data_barang($id_barang,$hargabeli,$stok){
      $sql = "UPDATE `data_barang` SET `stok`= stok+'$stok', harga_beli = '$hargabeli' WHERE `id_barang` = '$id_barang'" ;
      $query = $this->db->query($sql);
      return TRUE;
    }

    function add_nota_pembelian($data){
      $this->db->insert('pembeliannota', $data);
      return TRUE;
    }    

    function add_nota_bayar($data){
      $this->db->insert('pembelianbayarnota', $data);
      return TRUE; 
    }

  	function hapus_temp($id){
     	$this->db->where('id',$id);
		  $this->db->delete('pembeliantemp');
     	return TRUE;
  	}

    function get_list_barang(){
      $sql = "SELECT id_barang, nama_barang, harga_beli from data_barang";
      $query = $this->db->query($sql);
      if ($query) {
          return $query->result_array();
      }else{
          return false;
      }
    }

    function reset($id){
      $sql = "DELETE FROM pembeliantemp WHERE operator_id = $id";
      $query = $this->db->query($sql);
      if ($query) {
          return true;
      }else{
          return false;
      }
    }

    function create_nota($year,$month){
      $sql = "SELECT SUBSTR(nota, 7, 4)'id_nota' FROM pembeliannota 
              WHERE SUBSTR(nota, 1, 4) = '$year' 
              AND SUBSTR(nota, 5, 2) = '$month' 
              ORDER BY nota 
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

    function create_nota_bayar($nota){
      $sql = "SELECT MAX(SUBSTR(nota_bayar, 12, 1))as akhir FROM pembelianbayarnota WHERE nota = '$nota'";
      $query = $this->db->query($sql);
      $angka = $query->row_array();
      if ($query->num_rows() > 0) {
        $baru = intval($angka['akhir'])+1;
        
        return $nota . "-" . $baru;
      }else{
        return $nota . "-" . 1;
      }
    }

    function bayar_hutang($dat){
      $this->db->insert('pembelianbayarnota', $dat);
      $this->cek_status_lunas($dat);
      return TRUE;
    }

    function cek_status_lunas($data){
      $sql = 'SELECT SUM(bayar) as total FROM `pembelianbayarnota` WHERE nota = '.$data['nota'];
      $query = $this->db->query($sql);
      $total = $query->result();

      $sql2 = 'SELECT grosstotal FROM `pembeliannota` WHERE nota = '.$data['nota'];
      $query2 = $this->db->query($sql2);
      $tagihan = $query2->result();

      foreach ($total as $not) {
        $tot = $not->total;
      }

      foreach ($tagihan as $not) {
        $tag = $not->grosstotal;   
      }

      // echo $tag;
      // echo $tot;
      if ($tag == $tot) {
        $sql = 'UPDATE `pembeliannota` SET `status`= 1 WHERE `nota` = '.$data['nota'] ;
        $query = $this->db->query($sql);
        return TRUE;
      }else{
        return FALSE;
      }

    }

}