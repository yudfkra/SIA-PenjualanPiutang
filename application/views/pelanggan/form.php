<div class="row">
    <div class="col-md-8">
        <?php
            // cek jika $form_edit adalah true jika false maka akan diarahkan ke tambah.
            $fungsi = $form_edit ? 'edit/' . $pelanggan->id : 'tambah';
        ?>
        <?php echo form_open_multipart("pelanggan/" . $fungsi, array('class' => 'form-horizontal', 'autocomplete' => 'off')); ?>
            <div class="form-group <?php echo form_error('nama') ? 'has-error' : ''; ?>">
                <label for="input-nama" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" id="input-nama" placeholder="Nama" value="<?php echo set_value('nama', $form_edit ? $pelanggan->nama : null); ?>">
                    <?php echo form_error('nama', '<span class="help-block">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group <?php echo form_error('no_hp') ? 'has-error' : ''; ?>">
                <label for="input-no_hp" class="col-sm-2 control-label">No. HP</label>
                <div class="col-sm-10">
                    <input type="text" name="no_hp" class="form-control" id="input-no_hp" placeholder="No. HP" value="<?php echo set_value('no_hp', $form_edit ? $pelanggan->no_hp : null); ?>">
                    <?php echo form_error('no_hp', '<span class="help-block">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group <?php echo form_error('alamat') ? 'has-error' : ''; ?>">
                <label for="input-alamat" class="col-sm-2 control-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea name="alamat" id="input-alamat" cols="20" rows="5" class="form-control" placeholder="Alamat"><?php echo set_value('alamat', $form_edit ? $pelanggan->alamat : null); ?></textarea>
                    <?php echo form_error('alamat', '<span class="help-block">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a href="<?php echo site_url("pelanggan"); ?>" class="btn btn-default">Batal</a>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>