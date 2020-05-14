<div class="row">
    <div class="col-md-8">
        <?php echo form_open_multipart("penjualan/pembayaran", array('class' => 'form-horizontal', 'autocomplete' => 'off')); ?>
        <div class="form-group <?php echo form_error('penjualan_id') ? 'has-error' : ''; ?>">
            <label for="input-pelanggan" class="col-sm-2 control-label">Kode Penjualan</label>
            <div class="col-sm-10">
                <?php echo form_dropdown('penjualan_id', array('' => 'Pilih Penjualan') + $penjualan, set_value('penjualan_id', $this->input->get('penjualan_id')), 'id="input-pelanggan" class="form-control"'); ?>
                <?php echo form_error('penjualan_id', '<span class="help-block">', '</span>'); ?>
            </div>
        </div>
        <div class="form-group <?php echo form_error('tanggal') ? 'has-error' : ''; ?>">
            <label for="input-tanggal" class="col-sm-2 control-label">Tanggal</label>
            <div class="col-sm-10">
                <input type="date" name="tanggal" class="form-control" id="input-tanggal" placeholder="Tanggal Pembayaran" value="<?php echo set_value('tanggal'); ?>">
                <?php echo form_error('tanggal', '<span class="help-block">', '</span>'); ?>
            </div>
        </div>
        <div class="form-group <?php echo form_error('nominal') ? 'has-error' : ''; ?>">
            <label for="input-nominal" class="col-sm-2 control-label">Nominal</label>
            <div class="col-sm-10">
                <input type="text" name="nominal" class="form-control input-price" id="input-nominal" placeholder="Nominal" value="<?php echo set_value('nominal'); ?>">
                <?php echo form_error('nominal', '<span class="help-block">', '</span>'); ?>
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