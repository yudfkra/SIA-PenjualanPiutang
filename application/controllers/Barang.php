<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('barang_model');
    }

    /**
     * Menampilkan view barang.
     *
     * @return void
     */
    public function index()
    {
        $data['list_barang'] = $this->barang_model->listBarang();

        // set tampilan menggunakan view yang berada di views/barang/index.php
        $data['view'] = 'barang/index';

        // set judul halaman
        $data['title'] = 'Barang';
        $this->load->view('layout', $data);
    }

    /**
     * Fungsi untuk menampilkan form barang.
     *
     * @return void
     */
    public function tambah()
    {
        // cek jika user menglik submit
        if ($this->input->method() == 'post') {
            // lakukan penambahan data barang
            $this->doTambah();
        }

        // beritahu ke view views/barang/form bahwa form adalah tambah.
        $data['form_edit'] = false;

        // set tampillan menggunakan view yang erada di views/barang/form.php
        $data['view'] = 'barang/form';

        // set judul halaman
        $data['title'] = 'Tambah Barang';
        $this->load->view('layout', $data);
    }

    /**
     * Fungsi untuk menambahkan data barang.
     *
     * @return void
     */
    public function doTambah()
    {
        // cek jika data yang diinput user telah valid
        if ($this->validasiInput()) {
            // mengumpulkan data yang diinput user untuk disimpan ke database.
            $data = array(
                'nama' => $this->input->post('nama'),
                'harga' => $this->input->post('harga'),
                'tanggal_input' => date('Y-m-d H:i:s'),
            );

            // memanggil fungsi model untuk menyimpan data.
            $this->barang_model->addBarang($data);

            // set pesan success ke form barang.
            $this->session->set_flashdata('success_message', 'Barang berhasil ditambahkan.');
            redirect('barang');
        }
    }

    /**
     * Fungsi dari controller untuk menampilkan dan merubah data mobil.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        // mengambil data barang dari database
        $barang = $this->barang_model->getBarang($id);
        // jika data barang tidak ada di database, arahkan user kembali ke halaman daftar barang
        if (empty($barang)) {
            // set pesan error ke user.
            $this->session->set_flashdata('error_message', 'Barang tidak ditemukan');
            redirect('barang');
        }

        // jika pada user mengklik submit
        if ($this->input->method() == 'post') {
            // lakukan edit barang.
            $this->doEdit($barang);
        }

        $data['barang'] = $barang;

        // beritahu ke view views/barang/form bahwa form adalah edit.
        $data['form_edit'] = true;

        // set tampillan menggunakan view yang erada di views/barang/form.php
        $data['view'] = 'barang/form';

        // set judul halaman
        $data['title'] = 'Edit Barang';
        $this->load->view('layout', $data);
    }

    /**
     * Fungsi untuk menambahkan data barang.
     *
     * @return void
     */
    public function doEdit($barang)
    {
        // cek jika data yang diinput user telah valid
        if ($this->validasiInput()) {
            // mengumpulkan data yang diinput user untuk disimpan ke database.
            $data = array(
                'nama' => $this->input->post('nama') ? $this->input->post('nama') : $barang->nama,
                'harga' => $this->input->post('harga') ? $this->input->post('harga') : $barang->harga,
            );

            // memanggil fungsi model untuk menyimpan data.
            $this->barang_model->updateBarang($barang->id, $data);

            // set pesan success ke form barang.
            $this->session->set_flashdata('success_message', 'Barang berhasil diubah.');
            redirect('barang');
        }
    }

    /**
     * Fungsi untuk menghapus data barang
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $barang = $this->barang_model->getBarang($id);
        // Mengecek apakah data barang ada di database.
        if (!empty($barang)) {
            // jika ada hapus data barang dengan id "$id"
            $this->barang_model->deleteBarang($id);

            // set pesan sukses ke user.
            $this->session->set_flashdata('success_message', 'Barang Berhasil dihapus!');
        } else {

            // jika tidak ada data barang set pesan error ke user.
            $this->session->set_flashdata('error_message', 'Barang tidak ditemukan');
        }

        // arahkan user kembali ke halaman list barang.
        redirect('barang');
    }

    /**
     * Fungsi untuk memvalidasi data yang diinput user.
     *
     * @return void
     */
    protected function validasiInput()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        return $this->form_validation->run();
    }
}
