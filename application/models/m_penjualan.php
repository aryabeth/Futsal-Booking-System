<?php 
class m_penjualan extends CI_Model{
	function __construct()
    {
      parent::__construct();
    }

    function get_list_penjualan(){
     	// $sql = "SELECT *,((p.harga_jual*jml)-disc) as subtotal, p.status as status, p.harga_jual as hj, p.keterangan as keterangan FROM nota_penjualan_barang p LEFT JOIN data_barang b ON b.id_barang = p.id_barang";
      $sql = "SELECT *,((harga_jual*jml)-disc) as subtotal, status, harga_jual as hj, keterangan FROM nota_penjualan_barang ";
		  $query = $this->db->query($sql);
    	return $query->result();	
  	}

  	function add_penjualan($data){
     	$this->db->insert('nota_penjualan_barang', $data);
     	return TRUE;
  	}

  	function hapus_penjualan($id){

      $sql = "UPDATE nota_penjualan_barang SET status = 'CANCELED', harga_jual = harga_jual-harga_jual-harga_jual WHERE id_nota = '$id'";
      $query = $this->db->query($sql);
      return TRUE;

    //  	$this->db->where('id_nota',$id);
		  // $this->db->delete('nota_penjualan_barang');
    //  	return TRUE;
  	}

    function create_nota($year,$month){
      $sql = "SELECT SUBSTR(id_nota, 10, 4)'id_nota' FROM nota_penjualan_barang 
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

    function update_stock($kode, $jml){
      $sql = "UPDATE `data_barang` SET `stok`= stok - ".$jml." WHERE `id_barang` = ".$kode ;
      $query = $this->db->query($sql);
      return TRUE;
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