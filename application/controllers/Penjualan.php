<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('penjualan_model', 'pelanggan_model', 'barang_model'));
    }

    /**
     * Menampilkan view penjualan.
     *
     * @return void
     */
    public function index()
    {
        $data['list_penjualan'] = $this->penjualan_model->listPenjualan();

        // set tampilan menggunakan view yang berada di views/penjualan/index.php
        $data['view'] = 'penjualan/index';

        // set judul halaman
        $data['title'] = 'Penjualan';
        $this->load->view('layout', $data);
    }

    /**
     * Fungsi untuk menampilkan form penjualan.
     *
     * @return void
     */
    public function tambah()
    {
        // cek jika user menglik submit
        if ($this->input->method() == 'post') {
            // lakukan penambahan data penjualan
            $this->doTambah();
        }

        // mengambil data pelanggan
        $list_pelanggan = $this->pelanggan_model->listPelanggan();
        $pelanggan = array();
        foreach ($list_pelanggan as $_pelanggan) {
            $pelanggan[$_pelanggan->id] = "{$_pelanggan->nama} - {$_pelanggan->no_hp}";
        }

        // mengambil data barang
        $list_barang = $this->barang_model->listBarang();
        $barang = array();
        foreach ($list_barang as $_barang) {
            $barang[$_barang->id] = "{$_barang->nama} - " . format_rp($_barang->harga);
        }

        $data['pelanggan'] = $pelanggan;
        $data['barang'] = $barang;

        // beritahu ke view views/penjualan/form bahwa form adalah tambah.
        $data['form_edit'] = false;

        // set tampillan menggunakan view yang erada di views/penjualan/form.php
        $data['view'] = 'penjualan/form';

        // set judul halaman
        $data['title'] = 'Tambah Penjualan';
        $this->load->view('layout', $data);
    }

    /**
     * Fungsi untuk menambahkan data penjualan.
     *
     * @return void
     */
    public function doTambah()
    {
        // cek jika data yang diinput user telah valid
        if ($this->validasiInput()) {
            $pelanggan = $this->pelanggan_model->getPelanggan($this->input->post('pelanggan_id'));
            $barang = $this->barang_model->getBarang($this->input->post('barang_id'));

            // Total harga barang
            $qty = $this->input->post('qty');
            $total = $qty * $barang->harga;

            // mengumpulkan data yang diinput user untuk disimpan ke database.
            $data = array(
                'kode' => sprintf('TRN-%s', date('Ymd')),
                'pelanggan_id' => $pelanggan->id,
                'barang_id' => $barang->id,
                'harga' => $barang->harga,
                'qty' => $qty,
                'total' => $total,
                'tanggal_jatuh_tempo' => $this->input->post('tanggal_jatuh_tempo'),
                'status' => 'BELUM LUNAS',
                'tanggal' => date('Y-m-d H:i:s'),
            );

            // memanggil fungsi model untuk menyimpan data.
            $this->penjualan_model->addPenjualan($data);

            // set pesan success ke form penjualan.
            $this->session->set_flashdata('success_message', 'Penjualan berhasil ditambahkan.');
            redirect('penjualan');
        }
    }

    /**
     * Fungsi untuk menampilkan detail penjualan.
     *
     * @param int $id
     * @return void
     */
    public function detail($id)
    {
        // mengambil data penjualan dari database
        $penjualan = $this->penjualan_model->getPenjualan($id);
        // jika data penjualan tidak ada di database, arahkan user kembali ke halaman daftar penjualan
        if (empty($penjualan)) {
            // set pesan error ke user.
            $this->session->set_flashdata('error_message', 'Penjualan tidak ditemukan');
            redirect('penjualan');
        }

        $penjualan->pembayaran = $this->penjualan_model->listPembayaran(array('penjualan_id' => $id));

        $data['penjualan'] = $penjualan;

        // set tampillan menggunakan view yang erada di views/penjualan/detail.php
        $data['view'] = 'penjualan/detail';

        // set judul halaman
        $data['title'] = 'Detail';
        $this->load->view('layout', $data);
    }

    /**
     * Fungsi untuk menampilkan form pembayaran.
     *
     * @return void
     */
    public function pembayaran()
    {
        // cek jika user menglik submit
        if ($this->input->method() == 'post') {
            // lakukan penambahan data penjualan
            $this->doPembayaran();
        }

        // mengambil data penjualan
        $list_penjualan = $this->penjualan_model->listPenjualan(array('penjualan.status' => 'BELUM LUNAS'));
        $penjualan = array();
        foreach ($list_penjualan as $_penjualan) {
            $penjualan[$_penjualan->id] = "{$_penjualan->kode} - " . format_rp($_penjualan->total);
        }

        // mengecek jika tidak ada data penjualan yang tersedia
        if (empty($penjualan)) {
            // jika data penjualan kosong beri pesan ke admin untuk menambahkan data penjualan
            $data['warning_message'] = 'Saat ini tidak ada penjualan yang tersedia. silahkan menambahkan <a href="' . site_url('penjualan/tambah') . '">data penjualan</a> terlebih dahulu.';
        }

        $data['penjualan'] = $penjualan;

        // set tampillan menggunakan view yang erada di views/penjualan/pembayaran.php
        $data['view'] = 'penjualan/pembayaran';

        // set judul halaman
        $data['title'] = 'Pembayaran';
        $this->load->view('layout', $data);
    }

    /**
     * Fungsi untuk menambah data pembayaran.
     *
     * @return void
     */
    public function doPembayaran()
    {
        // cek jika data yang diinput user telah valid
        if ($this->validasiPembayaran()) {
            $penjualan = $this->penjualan_model->getPenjualan($this->input->post('penjualan_id'));

            // mengumpulkan data yang diinput user untuk disimpan ke database.
            $data = array(
                'penjualan_id' => $penjualan->id,
                'nominal' => $this->input->post('nominal'),
                'tanggal' => $this->input->post('tanggal'),
            );

            // memanggil fungsi model untuk menyimpan data.
            $this->penjualan_model->addPembayaran($data);

            // memanggil fungsi model untuk mendapatkan total pembayaran.
            $totalTerbayar = $this->penjualan_model->getTotalTerbayar($penjualan->id);

            // melakukan pengecekan jika total pembayaran sudah terpenuhi.
            if ($totalTerbayar >= $penjualan->total) {
                // update status penjualan menjadi lunas.
                $this->penjualan_model->updatePenjualan($penjualan->id, array(
                    'status' => 'LUNAS'
                ));
            }

            // set pesan success ke form penjualan.
            $this->session->set_flashdata('success_message', 'Pembayaran berhasil ditambahkan.');
            redirect('penjualan/detail/' . $penjualan->id);
        }
    }

    /**
     * Fungsi untuk menghapus data penjualan
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $penjualan = $this->penjualan_model->getPenjualan($id);
        // Mengecek apakah data penjualan ada di database.
        if (!empty($penjualan)) {
            // jika ada hapus data penjualan dengan id "$id"
            $this->penjualan_model->deletePenjualan($id);

            // set pesan sukses ke user.
            $this->session->set_flashdata('success_message', 'Penjualan Berhasil dihapus!');
        } else {

            // jika tidak ada data penjualan set pesan error ke user.
            $this->session->set_flashdata('error_message', 'Penjualan tidak ditemukan');
        }

        // arahkan user kembali ke halaman list penjualan.
        redirect('penjualan');
    }

    /**
     * Fungsi untuk memvalidasi data yang diinput user.
     *
     * @return void
     */
    protected function validasiInput()
    {
        $list_pelanggan = $this->pelanggan_model->listPelanggan();

        $pelanggan = [];
        foreach ($list_pelanggan as $_pelanggan) {
            $pelanggan[] = $_pelanggan->id;
        }

        $list_barang = $this->barang_model->listBarang();

        $barang = [];
        foreach ($list_barang as $_barang) {
            $barang[] = $_barang->id;
        }

        $this->form_validation->set_rules('pelanggan_id', 'Pelanggan', 'required|in_list[' . implode(',', $pelanggan) . ']');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required|in_list[' . implode(',', $barang) . ']');
        $this->form_validation->set_rules('qty', 'Kuantitas', 'required|numeric');
        $this->form_validation->set_rules('tanggal_jatuh_tempo', 'Tanggal Jatuh Tempo', 'required');

        return $this->form_validation->run();
    }

    /**
     * Fungsi untuk memvalidasi data pembayaran yang diinput user.
     *
     * @return void
     */
    protected function validasiPembayaran()
    {
        // mengambil data penjualan
        $list_penjualan = $this->penjualan_model->listPenjualan(array('penjualan.status' => 'BELUM LUNAS'));
        $penjualan = array();
        foreach ($list_penjualan as $_penjualan) {
            $penjualan[] = $_penjualan->id;
        }

        $this->form_validation->set_rules('penjualan_id', 'Kode Penjualan', 'required|in_list[' . implode(',', $penjualan) . ']');
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|numeric');
        $this->form_validation->set_rules('tanggal', 'Tanggal Pembayaran', 'required');

        return $this->form_validation->run();
    }
}
