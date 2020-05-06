<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="<?php echo site_url('penjualan/tambah'); ?>" class="btn btn-primary">Tambah Penjualan</a>
                &nbsp;
                <a href="<?php echo site_url('penjualan/pembayaran'); ?>" class="btn btn-info">Form Pembayaran</a>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px;">No.</th>
                            <th>Kode</th>
                            <th>Nama Pelanggan</th>
                            <th>Total</th>
                            <th style="width: 160px;">Tanggal Transaksi</th>
                            <th>Status</th>
                            <th style="width: 160px;">Tanggal Jatuh Tempo</th>
                            <th class="text-center" style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list_penjualan)) { ?>
                            <?php $no = 0;
                            foreach ($list_penjualan as $penjualan) { ?>
                                <tr>
                                    <td><?php echo $no += 1; ?></td>
                                    <td><?php echo $penjualan->kode; ?></td>
                                    <td><?php echo $penjualan->nama_pelanggan; ?></td>
                                    <td><?php echo format_rp($penjualan->total); ?></td>
                                    <td><?php echo $penjualan->tanggal; ?></td>
                                    <td><?php echo $penjualan->status; ?></td>
                                    <td><?php echo $penjualan->tanggal_jatuh_tempo; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="<?php echo site_url("penjualan/detail/" . $penjualan->id) ?>" class="btn btn-primary btn-sm">Detail</a>
                                            <?php if($penjualan->status == 'BELUM LUNAS'): ?>
                                                <a href="<?php echo site_url("penjualan/pembayaran?penjualan_id=" . $penjualan->id) ?>" class="btn btn-success btn-sm">Bayar</a>
                                            <?php endif; ?>
                                            <a href="<?php echo site_url("penjualan/delete/" . $penjualan->id) ?>" class="btn btn-danger btn-sm">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data Penjualan</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>