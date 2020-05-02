<?php if ($this->session->flashdata('success_message')){ ?>
    <div class="alert alert-success alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>
            <i class="icon fa fa-check"></i>
            Sukses!
        </h4>
        <?php echo $this->session->flashdata('success_message'); ?>
    </div>
<?php } ?>

<?php if($this->session->flashdata('error_message')){ ?>
    <div class="alert alert-danger alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>
            <i class="icon fa fa-warning"></i>
            Terjadi Kesalahan!
        </h4>
        <?php echo $this->session->flashdata('error_message'); ?>
    </div>
<?php } ?>

<?php if (isset($warning_message) && $warning_message) { ?>
    <div class="alert alert-warning alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>
            <i class="icon fa fa-warning"></i>
            Peringatan!
        </h4>
        <?php echo $warning_message; ?>
    </div>
<?php } ?>