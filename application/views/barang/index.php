<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="<?php echo site_url('barang/tambah'); ?>" class="btn btn-primary">Tambah Barang</a>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No.</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th style="width: 160px;">Tanggal Input</th>
                            <th style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list_barang)) { ?>
                            <?php $no = 0; foreach($list_barang as $barang) { ?>
                                <tr>
                                    <td><?php echo $no += 1; ?></td>
                                    <td><?php echo $barang->nama; ?></td>
                                    <td><?php echo format_rp($barang->harga); ?></td>
                                    <td><?php echo $barang->tanggal_input; ?></td>
                                    <td>
                                        <a href="<?php echo site_url("barang/edit/" . $barang->id) ?>" class="btn btn-info">Edit</a>
                                        <a href="<?php echo site_url("barang/delete/" . $barang->id)?>" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data Barang</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>