<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class m_transaksi_deposit extends CI_Model{
	function __construct()
    {
        parent::__construct();  
        $this->load->helper(array('html','url'));
    }

    function get_list_customer(){
     	$sql = "SELECT nama, telp as id_customer, `e-mail` as email, saldo, password FROM customer";
	  	$query = $this->db->query($sql);
        $pass = $query->result_array();
        for ($i=0; $i < count($pass); $i++) { 
            if($pass[$i]['password'] != "" && !is_null($pass[$i]['password'])){
                $pass[$i]['password'] = "ok";
            } else {
                $pass[$i]['password'] = "no";
            }

        }
    	return $pass;	
  	}

    function get_data_transaksi(){
    	$result = $this->db->query('SELECT n.*, c.nama as nama, c.`e-mail` as email, saldo FROM `nota_deposit` n LEFT JOIN `customer` c ON c.telp = n.id_customer');    	
    	return $result->result_array();
    }

    function batal_transaksi($id, $id_customer){
        $sql = "SELECT `jml_deposit`, `jml_bonus` FROM `nota_deposit` WHERE `id_nota_deposit` = ".$id;       
        $res = $this->db->query($sql);
        $res = $res->result_array();
        //print_r($res);

        $sql = "UPDATE `customer` SET `jml_transaksi`=`jml_transaksi`-1,`saldo` = (`saldo` - ".($res[0]['jml_deposit']+$res[0]['jml_bonus']).") WHERE `telp` = ".$id_customer;
        $res = $this->db->query($sql);

        $sql = "UPDATE `nota_deposit` SET `status` = 'BATAL' WHERE `id_nota_deposit` = ".$id;
        $res = $this->db->query($sql);            
                
        if ($res) {            
            return true;
        }else{
            return false;
        }
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
        $check_cashflow = $this->check_cashflow_today($array['tgl_deposit']);

        if($check_cashflow == TRUE){           
                $sql="UPDATE `cashflow` SET `total_kredit`=`total_kredit`+".$array['jml_deposit'].",`saldo`=`saldo`+".$array['jml_deposit'];                           
        }else{ //Today's cashflow not exist                    
                $sql="INSERT INTO `cashflow`(`tanggal`, `total_kredit`, `total_debet`, `saldo`) SELECT '".$array['tgl_deposit']."',".$array['jml_deposit'].",0,a.saldo+".$array['jml_deposit']." FROM `cashflow` a INNER JOIN (SELECT max(tanggal) as max_tgl FROM `cashflow`) b WHERE a.tanggal=b.max_tgl";                           
        }
        $this->db->query($sql);   		        	
   		
        $result = $this->db->insert('nota_deposit', $array);
        if($result){        	
        	$sql = "UPDATE `customer` SET `jml_transaksi`=`jml_transaksi`+1,`saldo`=".$array['saldo_akhir']." WHERE telp='".$array['id_customer']."'";
	  		$result = $this->db->query($sql);
        	
        	if($result)
            	return TRUE;            
        }
        return FALSE;
   	}

    function cek_password_customer($id_customer, $password){
        $sql = "SELECT * FROM `customer` WHERE `telp`='".$id_customer."' AND `password`='".$password."'";
        $query = $this->db->query($sql);

        if(mysql_num_rows($query) > 0){
            return true;
        }
        return false;
    }

    function save_password_customer($id_customer, $password){
        $sql = "UPDATE `customer` SET `password`='".$password."' WHERE `telp`='".$id_customer."'";
        $query = $this->db->query($sql);

        return $query;
    }

    function save_password_new_customer($id_customer, $password){
        $sql = "UPDATE `customer` SET `password`='".$password."' WHERE `telp`='".$id_customer."'";
        $query = $this->db->query($sql);

        return $query;
    }
}
