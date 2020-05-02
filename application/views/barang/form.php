<div class="row">
    <div class="col-md-8">
        <?php
            // cek jika $form_edit adalah true jika false maka akan diarahkan ke tambah.
            $fungsi = $form_edit ? 'edit/' . $barang->id : 'tambah';
        ?>
        <?php echo form_open_multipart("barang/" . $fungsi, array('class' => 'form-horizontal', 'autocomplete' => 'off')); ?>
            <div class="form-group <?php echo form_error('nama') ? 'has-error' : ''; ?>">
                <label for="input-nama" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" id="input-nama" placeholder="Nama" value="<?php echo set_value('nama', $form_edit ? $barang->nama : null); ?>">
                    <?php echo form_error('nama', '<span class="help-block">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group <?php echo form_error('harga') ? 'has-error' : ''; ?>">
                <label for="input-harga" class="col-sm-2 control-label">Harga</label>
                <div class="col-sm-10">
                    <input type="text" name="harga" class="form-control" id="input-harga" placeholder="Harga" value="<?php echo set_value('harga', $form_edit ? $barang->harga : null); ?>">
                    <?php echo form_error('harga', '<span class="help-block">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a href="<?php echo site_url("barang"); ?>" class="btn btn-default">Batal</a>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>