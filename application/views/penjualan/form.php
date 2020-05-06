<div class="row">
    <div class="col-md-8">
        <?php echo form_open_multipart("penjualan/tambah", array('class' => 'form-horizontal', 'autocomplete' => 'off')); ?>
            <div class="form-group <?php echo form_error('pelanggan_id') ? 'has-error' : ''; ?>">
                <label for="input-pelanggan" class="col-sm-2 control-label">Pelanggan</label>
                <div class="col-sm-10">
                    <?php echo form_dropdown('pelanggan_id', array('' => 'Pilih Pelanggan') + $pelanggan, set_value('pelanggan_id'), 'id="input-pelanggan" class="form-control"'); ?>
                    <?php echo form_error('pelanggan_id', '<span class="help-block">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group <?php echo form_error('barang_id') ? 'has-error' : ''; ?>">
                <label for="input-barang" class="col-sm-2 control-label">Barang</label>
                <div class="col-sm-10">
                    <?php echo form_dropdown('barang_id', array('' => 'Pilih Barang') + $barang, set_value('barang_id'), 'id="input-barang" class="form-control"'); ?>
                    <?php echo form_error('barang_id', '<span class="help-block">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group <?php echo form_error('qty') ? 'has-error' : ''; ?>">
                <label for="input-qty" class="col-sm-2 control-label">Kuantitas</label>
                <div class="col-sm-10">
                    <input type="text" name="qty" class="form-control" id="input-qty" placeholder="Kuantitas" value="<?php echo set_value('qty'); ?>">
                    <?php echo form_error('qty', '<span class="help-block">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group <?php echo form_error('tanggal_jatuh_tempo') ? 'has-error' : ''; ?>">
                <label for="input-tanggal_jatuh_tempo" class="col-sm-2 control-label">Tanggal Jatuh Tempo</label>
                <div class="col-sm-10">
                    <input type="date" name="tanggal_jatuh_tempo" class="form-control" id="input-tanggal_jatuh_tempo" placeholder="Tanggal Jatuh Tempo" value="<?php echo set_value('tanggal_jatuh_tempo'); ?>">
                    <?php echo form_error('tanggal_jatuh_tempo', '<span class="help-block">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a href="<?php echo site_url("penjualan"); ?>" class="btn btn-default">Batal</a>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>