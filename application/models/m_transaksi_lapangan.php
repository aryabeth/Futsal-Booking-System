<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class m_transaksi_lapangan extends CI_Model{
	function __construct()
    {
        parent::__construct();  
        $this->load->helper(array('html','url'));
    }

    function get_data_transaksi(){
        $result = $this->db->query('SELECT n.*, c.nama FROM `nota_lapangan` n LEFT JOIN `customer` c ON n.id_customer = c.telp');
        //$result = $this->db->query("SELECT n.id_nota_lapangan, n.bayar_dp, n.tgl_dp, n.bayar_lunas, n.tgl_lunas, n.diskon, u.name as override, n.total_bayar, n.id_customer, n.lapangan, n.tgl_main, n.jam_mulai, n.jam_selesai, n.bonus, n.keterangan, u2.name as id_operator, n.status FROM nota_lapangan n INNER JOIN user u ON n.override = u.user_id LEFT JOIN user u2 ON n.id_operator = u2.user_id");
        return $result->result_array();
    }

    function get_data_transaksi_home($enum, $start, $end){
        $result = $this->db->query('SELECT n.*, c.nama FROM `nota_lapangan` n LEFT JOIN `customer` c ON n.id_customer = c.telp WHERE n.lapangan+0 = '.$enum.' AND n.tgl_main BETWEEN "'.$start.'" AND "'.$end.'" AND n.status != "BATAL"');
        //$result = $this->db->query("SELECT n.id_nota_lapangan, n.bayar_dp, n.tgl_dp, n.bayar_lunas, n.tgl_lunas, n.diskon, u.name as override, n.total_bayar, n.id_customer, n.lapangan, n.tgl_main, n.jam_mulai, n.jam_selesai, n.bonus, n.keterangan, u2.name as id_operator, n.status FROM nota_lapangan n INNER JOIN user u ON n.override = u.user_id LEFT JOIN user u2 ON n.id_operator = u2.user_id");
        return $result->result_array();
    }

    function search_nama_customer($nama = ""){
        $result = $this->db->query('SELECT * FROM `customer` WHERE nama LIKE '.$nama);
        return $result->result_array();
    }

    function simpan_customer($array = ""){
    	$result = $this->db->query('SELECT * FROM `customer` WHERE telp = "'.$array["telp"].'"');
    	if($result->num_rows() > 0){
            $result = $result->result_array()[0];
            $jml_jam = $result["jml_jam"] + $array["jml_jam"];
            /*echo "UPDATE `customer` SET `jml_jam`=".$jml_jam.",`jml_transaksi`=".($result["jml_transaksi"]+1).",`main_terakhir`='CURRENT_TIMESTAMP' WHERE `telp` = ".$array["telp"]; die;*/
            $result = $this->db->query("UPDATE `customer` SET `jml_jam`=".$jml_jam.",`jml_transaksi`=".($result["jml_transaksi"]+1).",`main_terakhir`='".$array["main_terakhir"]."' WHERE `telp` = ".$array["telp"]);
    	} else {
    		$this->db->insert('customer', $array);
    	}
    	return $result;
    }

    function simpan_edit_customer($array = ""){        
        $result = $this->db->query('SELECT * FROM `customer` WHERE telp = "'.$array["telp"].'"');
        if($result->num_rows() > 0){
            $result = $result->result_array()[0];
            $jml_jam = $result["jml_jam"] - $array["jml_jam"];
            /*echo "UPDATE `customer` SET `jml_jam`=".$jml_jam.",`jml_transaksi`=".($result["jml_transaksi"]+1).",`main_terakhir`='CURRENT_TIMESTAMP' WHERE `telp` = ".$array["telp"]; die;*/
            $result = $this->db->query("UPDATE `customer` SET `jml_jam`=".$jml_jam.",`main_terakhir`='".$array["main_terakhir"]."' WHERE `telp` = ".$array["telp"]);
        } else {
            $this->db->insert('customer', $array);
        }
        return $result;
    }

    function check_cashflow_today($tanggal = ""){
        $sql = "SELECT * FROM `cashflow`WHERE `tanggal`='".$tanggal."'";
        $result = $this->db->query($sql);
        if($result->num_rows() > 0){
            return TRUE;    
        } else {
            return FALSE;
        }
    }

   	function simpan_transaksi($array = ""){
        $check_cashflow;
        if($array['status'] == "DP")            
            $check_cashflow = $this->check_cashflow_today($array['tgl_dp']);
        else
            $check_cashflow = $this->check_cashflow_today($array['tgl_lunas']);

        //Today's cashflow exist
        if($check_cashflow == TRUE){
            if($array['status'] == "DP")
                $sql="UPDATE `cashflow` SET `total_kredit`=`total_kredit`+".$array['bayar_dp'].",`saldo`=`saldo`+".$array['bayar_dp'];
            else
                $sql="UPDATE `cashflow` SET `total_kredit`=`total_kredit`+".$array['bayar_lunas'].",`saldo`=`saldo`+".$array['bayar_lunas'];                        
        }else{ //Today's cashflow not exist
            if($array['status'] == "DP")                
                $sql="INSERT INTO `cashflow`(`tanggal`, `total_kredit`, `total_debet`, `saldo`) SELECT '".$array['tgl_dp']."',".$array['bayar_dp'].",0,a.saldo+".$array['bayar_dp']." FROM `cashflow` a INNER JOIN (SELECT max(tanggal) as max_tgl FROM `cashflow`) b WHERE `tanggal`=b.max_tgl";
            else
                $sql="INSERT INTO `cashflow`(`tanggal`, `total_kredit`, `total_debet`, `saldo`) SELECT '".$array['tgl_lunas']."',".$array['bayar_lunas'].",0,a.saldo+".$array['bayar_lunas']." FROM `cashflow` a INNER JOIN (SELECT max(tanggal) as max_tgl FROM `cashflow`) b WHERE `tanggal`=b.max_tgl";                
        }
        $this->db->query($sql);

   		$result = $this->db->insert('nota_lapangan', $array);
        if($result){
            return TRUE;
        }else{
            return FALSE;
        }
   	}

    function simpan_edit_dp($array = ""){
        print_r($array); die;
        $result = $this->db->query('SELECT * FROM `nota_lapangan` WHERE telp = "'.$array["telp"].'"');
        $result = $this->db->insert('nota_lapangan_log', $array);
        if($result){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function simpan_pelunasan_dp($array = ""){
        $sql = "UPDATE `nota_lapangan` SET `diskon`=".$array["diskon"].",`total_bayar`=".$array["total_bayar"].",`bayar_lunas`=".$array["bayar_lunas"].",`tgl_lunas`='".$array["tgl_lunas"]."',`id_operator`=".$array["id_operator"].",`override`='".$array["override"]."',`status`='".$array["status"]."',`keterangan`='".$array["keterangan"]."' WHERE `id_nota_lapangan`=".$array["id_nota_lapangan"];        
        $result = $this->db->query($sql);
        if($result){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function check_data_transaksi($array = ""){
        $id = "";
        if($array["id_nota_lapangan"] != "")
            $id = "`id_nota_lapangan` != ".$array["id_nota_lapangan"]." AND ";
        $sql = "SELECT * from `nota_lapangan` WHERE
            ".$id."`lapangan`+0 = '".$array["lapangan"]."' AND `tgl_main` = '".$array["tgl_main"]."' AND
            ((`jam_mulai` < '".$array["jam_mulai"]."' AND `jam_selesai` < '".$array["jam_selesai"]."' AND `jam_selesai` > '".$array["jam_mulai"]."') OR
            (`jam_mulai` > '".$array["jam_mulai"]."' AND `jam_selesai` > '".$array["jam_selesai"]."' AND `jam_mulai` < '".$array["jam_selesai"]."') OR
            (`jam_mulai` <= '".$array["jam_mulai"]."' AND `jam_selesai` >= '".$array["jam_selesai"]."') OR
            (`jam_mulai` >= '".$array["jam_mulai"]."' AND `jam_selesai` <= '".$array["jam_selesai"]."'))";
        $result = $this->db->query($sql);
        //return $result->result_array();
        if($result->num_rows() > 0){
            return $result->result_array();    
        } else {
            return FALSE;
        }
    }

    function get_enum_lapangan(){
        $result = $this->db->query("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'nota_lapangan' AND COLUMN_NAME = 'lapangan'");
        $row = $result->result_array()[0];
        $enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));
        return $enumList;
    }

    function decimalHours($time)
    {
        $hms = explode(":", $time);
        return ($hms[0] + ($hms[1]/60));
    }

    function batal_transaksi($id, $id_customer){        
        $sql = "UPDATE `nota_lapangan` SET `status` = 'BATAL' WHERE `id_nota_lapangan` = ".$id;
        $res = $this->db->query($sql);    

        $sql = "SELECT `jam_mulai`, `jam_selesai` FROM `nota_lapangan` WHERE `id_nota_lapangan` = ".$id;
        //$sql = "SELECT `bayar_lunas`, `status`, `jam_mulai`, `jam_selesai` FROM `nota_lapangan` WHERE `id_nota_lapangan` = ".$id;

        $res = $this->db->query($sql);
        $res = $res->result_array();

        /*if($res[0]['status'] == "DP")
            $sql="UPDATE `cashflow` SET `total_kredit`=`total_kredit`-".$array['bayar_dp'].",`saldo`=`saldo`+".$array['bayar_dp'];
        else
            $sql="UPDATE `cashflow` SET `total_kredit`=`total_kredit`-".$array['bayar_lunas'].",`saldo`=`saldo`-".$array['bayar_lunas'];*/

        $res = $this->decimalHours($res[0]['jam_selesai'])-$this->decimalHours($res[0]['jam_mulai']);

        $sql = "UPDATE `customer` SET `jml_transaksi`=`jml_transaksi`-1, `jml_jam`=`jml_jam`-$res, `main_terakhir`=(SELECT max(tgl_main) FROM `nota_lapangan` WHERE `status`!='BATAL' AND `id_customer`='".$id_customer."') WHERE `telp` = ".$id_customer;
        $res = $this->db->query($sql);
        if ($res) {            
            return true;
        }else{
            return false;
        }
    }

    function get_list_customer(){
        $sql = "SELECT nama, telp as id_customer, `e-mail` as email, saldo, password FROM customer";
        $query = $this->db->query($sql);
        
        return $query->result();    
    }
}
?>
