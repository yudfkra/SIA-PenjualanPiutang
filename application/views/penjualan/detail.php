<div class="row">
    <div class="col-md-8">
        <div class="form-horizontal">
            <div class="form-group">
                <label for="input-kode" class="col-sm-3 control-label">Kode</label>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo $penjualan->kode; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="input-pelanggan" class="col-sm-3 control-label">Nama Pelanggan</label>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo $penjualan->nama_pelanggan; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="input-pelanggan" class="col-sm-3 control-label">No HP & Alamat</label>
                <div class="col-sm-9">
                    <p class="form-control-static">
                        <?php echo $penjualan->no_hp; ?><br>
                        <?php echo $penjualan->alamat; ?>
                    </p>
                </div>
            </div>
            <div class="form-group">
                <label for="input-barang" class="col-sm-3 control-label">Nama Barang</label>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo $penjualan->nama_barang; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="input-qty" class="col-sm-3 control-label">Kuantitas</label>
                <div class="col-sm-9">
                    <p class="form-control-static"><b><?php echo $penjualan->qty; ?></b> x <?php echo format_rp($penjualan->harga); ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="input-tanggal" class="col-sm-3 control-label">Tanggal Transaksi</label>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo $penjualan->tanggal; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="input-status" class="col-sm-3 control-label">Status</label>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo $penjualan->status; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="input-tanggal_jatuh_tempo" class="col-sm-3 control-label">Tanggal Jatuh Tempo</label>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo $penjualan->tanggal_jatuh_tempo; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="input-pembayaran" class="col-sm-3 control-label">Pembayaran</label>
                <div class="col-sm-8">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 10px;">No.</th>
                                <th style="width: 160px;">Tanggal</th>
                                <th class="text-center">Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($penjualan->pembayaran)) { ?>
                                <?php $no = 0;
                                foreach ($penjualan->pembayaran as $pembayaran) { ?>
                                    <tr>
                                        <td><?php echo $no += 1; ?></td>
                                        <td><?php echo $pembayaran->tanggal; ?></td>
                                        <td class="text-right"><?php echo format_rp($pembayaran->nominal); ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada data Pembayaran</td>
                                </tr>
                            <?php } ?>
                            <tr><td colspan="3"></td></tr>
                            <tr>
                                <th class="text-right" colspan="2">Total</th>
                                <td class="text-right"><?php echo format_rp($penjualan->total); ?></td>
                            </tr>
                            <tr>
                                <th class="text-right" colspan="2">Terbayar</th>
                                <td class="text-right"><?php echo format_rp($penjualan->total_terbayar); ?></td>
                            </tr>
                            <tr>
                                <th class="text-right" colspan="2">Sisa</th>
                                <td class="text-right"><?php echo format_rp($penjualan->piutang); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right">
                                    <?php if ($penjualan->status == 'BELUM LUNAS') : ?>
                                        <a href="<?php echo site_url("penjualan/pembayaran?penjualan_id=" . $penjualan->id) ?>" class="btn btn-success btn-sm">Tambah Pembayaran</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>