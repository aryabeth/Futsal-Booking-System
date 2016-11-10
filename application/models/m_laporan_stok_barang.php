<?php 
class m_laporan_stok_barang extends CI_Model{
	function __construct()
   	{
    	parent::__construct();
   		$this->load->database();
   	}

   
   	function get_laporan_now($bulan){
   		
   		$sql = "SELECT nota as nota, tanggal_pembelian as tanggal, concat(kode,' - ',nama) as keterangan, '0' AS debet, ((hargabeli*jumlah)-disc) as kredit FROM `pembelian` WHERE SUBSTR(tanggal_pembelian,6,2) = '$bulan' UNION SELECT id_nota as nota, tgl_jual as tanggal, concat(id_barang, ' - ', nama) as keterangan, ((harga_jual*jml)-disc) as debet, '0' as kredit FROM `nota_penjualan_barang` WHERE SUBSTR(tgl_jual,6,2) = '$bulan'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
   	}
   
}