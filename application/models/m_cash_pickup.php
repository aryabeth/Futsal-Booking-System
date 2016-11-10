<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_cash_pickup extends CI_Model{

   var $table = 'cash_pickup';
   var $column_order = array(null,'tgl_waktu','id_nota','nama','jml','keterangan','id_operator','override','status'); //set column field database for datatable orderable
   var $column_search = array('tgl_waktu','nama','jml','keterangan','id_operator','override','status'); //set column field database for datatable searchable
   var $order = array('id_pickup' => 'asc'); // default order


	public function __construct()
   {
      parent::__construct();
      $this->load->database();
   }

   private function _get_datatables_query()
   {

     $this->db->from($this->table);
     $this->db->where('status !=', 'CANCELED');

     $i = 0;

     foreach ($this->column_search as $item) // loop column
     {
         if($_POST['search']['value']) // if datatable send POST for search
         {
            // refs : https://www.codeigniter.com/userguide3/database/query_builder.html#query-grouping
            // $this->db->group_start();
            if($i===0) // first loop
            {
               $this->db->like($item, $_POST['search']['value']);
            }
            else
            {
               $this->db->or_like($item, $_POST['search']['value']);
            }

            // if(count($this->column_search) - 1 == $i) $this->db->group_end();
         }
         $i++;
     }

     if(isset($_POST['order'])) // here order processing
     {
         $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
     }
     else if(isset($this->order))
     {
         $order = $this->order;
         $this->db->order_by(key($order), $order[key($order)]);
     }
   }

   function get_datatables()
   {
     $this->_get_datatables_query();
     if($_POST['length'] != -1) {
      // pagination-related code
      $this->db->limit($_POST['length'], $_POST['start']);
     }

     $query = $this->db->get();
     return $query->result();
   }

   function count_filtered()
   {
     $this->_get_datatables_query();
     $query = $this->db->get();
     return $query->num_rows();
   }

   public function count_all()
   {
     $this->db->from($this->table);
     return $this->db->count_all_results();
   }

   public function get_by_id($id)
   {
     $this->db->from($this->table);
     $this->db->where('id_pickup',$id);
     $query = $this->db->get();

     return $query->row();
   }

   public function save($data)
   {
     $this->db->insert($this->table, $data);
     return $this->db->insert_id();
   }

   public function update($where, $data)
   {
     $this->db->update($this->table, $data, $where);
     return $this->db->affected_rows();
   }

   public function delete_by_id($id)
   {
     $this->db->where('id_pickup', $id);
     $this->db->delete($this->table);
   }

   public function get_id_nota_this_month($date)
   {
    $this->db->select('id_nota, tgl_waktu');
    $this->db->from($this->table);
    $this->db->where('status !=', 'CANCELED');
    $this->db->like('tgl_waktu', $date, 'after');
    $this->db->order_by('id_pickup', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get();

    // if found, return proper id_nota
    if($query->num_rows != 0) return $query->result()[0];
    // if not found, return YYYY-MM back
    else return $date;
   }

   public function get_data($o, $s, $e) {
    if($s > $e) {
      return "error_format";
    }
    elseif($o == "semua") {
      $this->db->from($this->table);
    }
    elseif ($o == 'tahun') {
      // format : YYYY
      $this->db->from($this->table);
      $this->db->like('tgl_waktu', $s, 'after');
    }
    elseif ($o == 'bulan') {
      // format : YYYYMM
      $this->db->from($this->table);
      $this->db->like('tgl_waktu', substr($s, 0, 4).'-'.substr($s, 4, 2), 'after');
    }
    elseif ($o == 'tahunToTahun') {
      // format : YYYY
      $this->db->from($this->table);
      $this->db->where('tgl_waktu >=', $s.'-01-01 00:00:00');
      $this->db->where('tgl_waktu <=', $e.'-12-31 23:59:59');
    }
    elseif ($o == 'bulanToBulan') {
      // format : YYYYMM
      $this->db->from($this->table);
      $this->db->where('tgl_waktu >=', substr($s, 0, 4).'-'.substr($s, 4, 2).'-01 00:00:00');
      $this->db->where('tgl_waktu <=', substr($e, 0, 4).'-'.substr($e, 4, 2).'-31 23:59:59');
    }
    elseif ($o == 'tglToTgl') {
      // format : YYYYMM
      $this->db->from($this->table);
      $this->db->where('tgl_waktu >=', substr($s, 0, 4).'-'.substr($s, 4, 2).'-'.substr($s, 6, 2).' 00:00:00');
      $this->db->where('tgl_waktu <=', substr($e, 0, 4).'-'.substr($e, 4, 2).'-'.substr($e, 6, 2).' 23:59:59');
    }
    else return false;

    $query = $this->db->get();
    if($query->num_rows != 0) return $query->result();
    else return false;
   }
}
