<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{
    public function listPelanggan($where = array(), $where_like = array(), $orderBy = array())
    {
        $this->db->from('pelanggan');

        if ($where) {
            $this->db->where($where);
        }

        if ($where_like) {
            $this->db->group_start();
            foreach ($where_like as $kolom => $keyword) {
                $this->db->or_like($kolom, $keyword);
            }
            $this->db->group_end();
        }

        $this->db->order_by("id", "DESC");

        $query = $this->db->get();
        return $query->result();
    }

    public function addPelanggan($data)
    {
        $this->db->insert('pelanggan', $data);
    }

    public function getPelanggan($id)
    {
        $query = $this->db->get_where('pelanggan', array('id' => $id));
        return $query->row();
    }

    public function updatePelanggan($id, $data)
    {
        return $this->db->update('pelanggan', $data, array('id' => $id));
    }

    public function deletePelanggan($id)
    {
        return $this->db->where('id', $id)->delete('pelanggan');
    }
}
