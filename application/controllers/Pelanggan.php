<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('pelanggan_model');
    }

    /**
     * Menampilkan view pelanggan.
     *
     * @return void
     */
    public function index()
    {
        $data['list_pelanggan'] = $this->pelanggan_model->listPelanggan();

        // set tampilan menggunakan view yang berada di views/pelanggan/index.php
        $data['view'] = 'pelanggan/index';

        // set judul halaman
        $data['title'] = 'Pelanggan';
        $this->load->view('layout', $data);
    }

    /**
     * Fungsi untuk menampilkan form pelanggan.
     *
     * @return void
     */
    public function tambah()
    {
        // cek jika user menglik submit
        if ($this->input->method() == 'post') {
            // lakukan penambahan data pelanggan
            $this->doTambah();
        }

        // beritahu ke view views/pelanggan/form bahwa form adalah tambah.
        $data['form_edit'] = false;

        // set tampillan menggunakan view yang erada di views/pelanggan/form.php
        $data['view'] = 'pelanggan/form';

        // set judul halaman
        $data['title'] = 'Tambah Pelanggan';
        $this->load->view('layout', $data);
    }

    /**
     * Fungsi untuk menambahkan data pelanggan.
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
                'no_hp' => $this->input->post('no_hp'),
                'alamat' => $this->input->post('alamat'),
            );

            // memanggil fungsi model untuk menyimpan data.
            $this->pelanggan_model->addPelanggan($data);

            // set pesan success ke form pelanggan.
            $this->session->set_flashdata('success_message', 'Pelanggan berhasil ditambahkan.');
            redirect('pelanggan');
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
        // mengambil data pelanggan dari database
        $pelanggan = $this->pelanggan_model->getPelanggan($id);
        // jika data pelanggan tidak ada di database, arahkan user kembali ke halaman daftar pelanggan
        if (empty($pelanggan)) {
            // set pesan error ke user.
            $this->session->set_flashdata('error_message', 'Pelanggan tidak ditemukan');
            redirect('pelanggan');
        }

        // jika pada user mengklik submit
        if ($this->input->method() == 'post') {
            // lakukan edit pelanggan.
            $this->doEdit($pelanggan);
        }

        $data['pelanggan'] = $pelanggan;

        // beritahu ke view views/pelanggan/form bahwa form adalah edit.
        $data['form_edit'] = true;

        // set tampillan menggunakan view yang erada di views/pelanggan/form.php
        $data['view'] = 'pelanggan/form';

        // set judul halaman
        $data['title'] = 'Edit Pelanggan';
        $this->load->view('layout', $data);
    }

    /**
     * Fungsi untuk menambahkan data pelanggan.
     *
     * @return void
     */
    public function doEdit($pelanggan)
    {
        // cek jika data yang diinput user telah valid
        if ($this->validasiInput()) {
            // mengumpulkan data yang diinput user untuk disimpan ke database.
            $data = array(
                'nama' => $this->input->post('nama') ? $this->input->post('nama') : $pelanggan->nama,
                'no_hp' => $this->input->post('no_hp') ? $this->input->post('no_hp') : $pelanggan->no_hp,
                'alamat' => $this->input->post('alamat') ? $this->input->post('alamat') : $pelanggan->alamat,
            );

            // memanggil fungsi model untuk menyimpan data.
            $this->pelanggan_model->updatePelanggan($pelanggan->id, $data);

            // set pesan success ke form pelanggan.
            $this->session->set_flashdata('success_message', 'Pelanggan berhasil diubah.');
            redirect('pelanggan');
        }
    }

    /**
     * Fungsi untuk menghapus data pelanggan
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $pelanggan = $this->pelanggan_model->getPelanggan($id);
        // Mengecek apakah data pelanggan ada di database.
        if (!empty($pelanggan)) {
            // jika ada hapus data pelanggan dengan id "$id"
            $this->pelanggan_model->deletePelanggan($id);

            // set pesan sukses ke user.
            $this->session->set_flashdata('success_message', 'Pelanggan Berhasil dihapus!');
        } else {

            // jika tidak ada data pelanggan set pesan error ke user.
            $this->session->set_flashdata('error_message', 'Pelanggan tidak ditemukan');
        }

        // arahkan user kembali ke halaman list pelanggan.
        redirect('pelanggan');
    }

    /**
     * Fungsi untuk memvalidasi data yang diinput user.
     *
     * @return void
     */
    protected function validasiInput()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        return $this->form_validation->run();
    }
}
