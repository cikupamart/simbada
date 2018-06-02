<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    var $table = 'menu';
    var $column_order = array(null, 'a.menu_ket','b.menu_parent','a.menu_url','a.menu_order'); //set column field database for datatable orderable
    var $column_search = array('a.menu_ket','b.menu_parent','a.menu_url','a.menu_order'); //set column field database for datatable searchable
    var $order = array('b.menu_parent' => 'asc', 'a.menu_order' => 'asc'); // default order

    public function __construct()
    {
      parent::__construct();
    }

    private function _get_datatables_query($post)
    {
      $this->db->select('a.menu_id AS menu_id, a.menu_ket, a.menu_parent, b.menu_ket AS menu_ket_parent, a.menu_url, a.menu_order');
      $this->db->from($this->table." a");
      $this->db->join($this->table." b", 'b.menu_id=a.menu_parent', 'left');

      $i = 0;

      foreach ($this->column_search as $item) // loop column
      {
        if($post['search']['value']) // if datatable send POST for search
        {
          if($i===0) // first loop
          {
            $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
            $this->db->like($item, $post['search']['value']);
          }
          else
          {
            $this->db->or_like($item, $post['search']['value']);
          }

          if(count($this->column_search) - 1 == $i) //last loop
          {
            $this->db->group_end(); //close bracket
          }
        }
        $i++;
      }

      if(isset($post['order'])) // here order processing
      {
        $this->db->order_by($this->column_order[$post['order']['0']['column']], $post['order']['0']['dir']);
      }
      else if(isset($this->order))
      {
        $order = $this->order;
        $this->db->order_by(key($order), $order[key($order)]);
      }
    }

    function get_datatables($post)
    {
      $this->_get_datatables_query($post);
      if($post['length'] != -1)
      {
          $this->db->limit($post['length'], $post['start']);
      }
      $query = $this->db->get();
      return $query->result();
    }

    function count_filtered($post)
    {
      $this->_get_datatables_query($post);
      $query = $this->db->get();
      return $query->num_rows();
    }

    public function count_all()
    {
      $this->db->from($this->table);
      return $this->db->count_all_results();
    }

    function get_data($where = FALSE)
    {
      if ($where !== FALSE)
      {
        foreach ($where as $key => $value)
        {
          $this->db->where($key, $value);
        }
      }
      return $this->db->get($this->table);
    }

    function get_menu_by_id($id)
    {
      $this->db->where('id', $id);
      $qry = $this->db->get($this->table);
      return $qry->num_rows() > 0 ? $qry->row() : FALSE;
    }

    function get_menu_child()
    {
      $this->db->where('menu_parent', 0);
      $qry = $this->db->get($this->table);
      return $qry->num_rows() > 0 ? $qry->result() : FALSE;
    }

    function save_menu($data)
    {
      $this->db->insert($this->table, $data);
    }

    function update_menu($id, $data)
    {
      $this->db->where('menu_id', $id);
      $this->db->update($this->table, $data);
    }

    function save_ha($data)
    {
      $this->db->insert('hak_akses', $data);
    }

    function update_ha($where, $data)
    {
      foreach ($where as $key => $value)
      {
        $this->db->where($key, $value);
      }
      $this->db->update('hak_akses', $data);
    }

    function get_detail_menu($where)
    {
      if (is_array($where))
      {
        foreach ($where as $key_where => $val_where)
        {
          $this->db->where($key_where, $val_where);
        }
      }
      else
      {
        $this->db->where($where);
      }

      $qry = $this->db->get($this->table);
      return $qry->num_rows() > 0 ? $qry->row() : FALSE;
    }

    function delete_menu($id)
    {
      // delete di table menu
      $this->db->where('id', $id);
      $this->db->delete($this->table);

      // delete di table hak akses
      $this->db->where('ha_menu', $id);
      $this->db->delete('hak_akses');
    }

    function count_data($table, $where)
    {
      foreach ($where as $key => $value)
      {
        $this->db->where($key, $value);
      }
      $this->db->from($table);
      return $this->db->count_all_results();
    }
}
