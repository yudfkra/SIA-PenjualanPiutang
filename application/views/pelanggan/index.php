<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="<?php echo site_url('pelanggan/tambah'); ?>" class="btn btn-primary">Tambah Pelanggan</a>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No.</th>
                            <th>Nama</th>
                            <th>No Hp</th>
                            <th style="width: 160px;">Alamat</th>
                            <th style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list_pelanggan)) { ?>
                            <?php $no = 0; foreach($list_pelanggan as $pelanggan) { ?>
                                <tr>
                                    <td><?php echo $no += 1; ?></td>
                                    <td><?php echo $pelanggan->nama; ?></td>
                                    <td><?php echo $pelanggan->no_hp; ?></td>
                                    <td><?php echo $pelanggan->alamat; ?></td>
                                    <td>
                                        <a href="<?php echo site_url("pelanggan/edit/" . $pelanggan->id) ?>" class="btn btn-info">Edit</a>
                                        <a href="<?php echo site_url("pelanggan/delete/" . $pelanggan->id)?>" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data Pelanggan</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>