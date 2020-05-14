<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{
    public function listPenjualan($where = array(), $where_like = array(), $orderBy = array())
    {
        $this->db->select('penjualan.*')
                ->select('pelanggan.nama as nama_pelanggan, pelanggan.no_hp as no_hp, pelanggan.alamat')
                ->select('barang.nama as nama_barang')
                ->select('COALESCE(pembayaran.total_terbayar, 0) as total_terbayar')
                ->select('(penjualan.total - COALESCE(pembayaran.total_terbayar, 0)) as piutang');
        $this->db->from('penjualan')
                ->join('pelanggan', 'penjualan.pelanggan_id = pelanggan.id')
                ->join('barang', 'penjualan.barang_id = barang.id')
                ->join("(SELECT penjualan_id, SUM(nominal) as total_terbayar FROM pembayaran GROUP BY penjualan_id) as pembayaran", "penjualan.id = pembayaran.penjualan_id", "left");

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

        $this->db->order_by("tanggal", "DESC");

        $query = $this->db->get();
        return $query->result();
    }

    public function addPenjualan($data)
    {
        $this->db->insert('penjualan', $data);
        return $this->db->insert_id();
    }

    public function getPenjualan($id)
    {
        $this->db->select('penjualan.*')
                ->select('pelanggan.nama as nama_pelanggan, pelanggan.no_hp as no_hp, pelanggan.alamat')
                ->select('barang.nama as nama_barang')
                ->select('COALESCE(pembayaran.total_terbayar, 0) as total_terbayar')
                ->select('(penjualan.total - COALESCE(pembayaran.total_terbayar, 0)) as piutang');
        $this->db->from('penjualan')
                ->join('pelanggan', 'penjualan.pelanggan_id = pelanggan.id')
                ->join('barang', 'penjualan.barang_id = barang.id')
                ->join("(SELECT penjualan_id, SUM(nominal) as total_terbayar FROM pembayaran GROUP BY penjualan_id) as pembayaran", "penjualan.id = pembayaran.penjualan_id", "left");

        $query = $this->db->where('penjualan.id', $id);
        return $query->get()->row();
    }

    public function updatePenjualan($id, $data)
    {
        return $this->db->update('penjualan', $data, array('id' => $id));
    }

    public function deletePenjualan($id)
    {
        $this->db->where('penjualan_id', $id)->delete('pembayaran');
        return $this->db->where('id', $id)->delete('penjualan');
    }

    public function listPembayaran($where = array())
    {
        $this->db->from('pembayaran');

        if ($where) {
            $this->db->where($where);
        }
        $this->db->order_by("tanggal", "DESC");

        $query = $this->db->get();
        return $query->result();
    }

    public function addPembayaran($data)
    {
        $this->db->insert('pembayaran', $data);
        return $this->db->insert_id();
    }

    public function getTotalTerbayar($id)
    {
        $this->db->select_sum('nominal')
            ->where('penjualan_id', $id)
            ->group_by('penjualan_id');

        $pembayaran = $this->db->get('pembayaran')->row();
        return !empty($pembayaran) ? $pembayaran->nominal : 0;
    }
}