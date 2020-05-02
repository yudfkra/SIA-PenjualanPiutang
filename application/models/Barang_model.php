<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    public function listBarang($where = array(), $where_like = array(), $orderBy = array())
    {
        $this->db->from('barang');

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

        $this->db->order_by("tanggal_input", "DESC");

        $query = $this->db->get();
        return $query->result();
    }

    public function addBarang($data)
    {
        $this->db->insert('barang', $data);
    }

    public function getBarang($id)
    {
        $query = $this->db->get_where('barang', array('id' => $id));
        return $query->row();
    }

    public function updateBarang($id, $data)
    {
        return $this->db->update('barang', $data, array('id' => $id));
    }

    public function deleteBarang($id)
    {
        return $this->db->where('id', $id)->delete('barang');
    }
}
