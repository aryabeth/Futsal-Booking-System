<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class m_cash_deposit_bank extends CI_Model{

   var $table = 'cash_deposit';
   var $column_order = array(null,'tgl_waktu','nama_bank','no_transaksi','nama','jml','keterangan','id_operator','override','status',null); //set column field database for datatable orderable
   var $column_search = array('tgl_waktu','nama_bank','no_transaksi','nama','jml','keterangan','id_operator','override','status'); //set column field database for datatable searchable
   var $order = array('id_deposit' => 'asc'); // default order


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
     $this->db->where('id_deposit',$id);
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
     $this->db->where('id_deposit', $id);
     $this->db->delete($this->table);
   }

   function get_nama_bank() {
    // inspiration :
    // https://jadendreamer.wordpress.com/2011/03/16/php-tutorial-put-mysql-enum-values-into-drop-down-select-box/

    $query = $this->db->query("
      SELECT COLUMN_TYPE 
      FROM INFORMATION_SCHEMA.COLUMNS
      WHERE TABLE_NAME = '".$this->table."' 
        AND COLUMN_NAME = 'nama_bank'
    ");

    return $query->row();
   }
}