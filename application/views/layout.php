<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo (isset($title) ? $title . ' - ' : '') . APP_NAME ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jumbotron-narrow.css') ?>">
</head>
<body>
    <div class="container" style="max-width: 100%;">
        <div class="header clearfix">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation" class="<?php echo $this->uri->segment(1) == 'barang' ? 'active' : '' ?>"><a href="<?php echo site_url('barang'); ?>">Barang</a></li>
                    <li role="presentation" class="<?php echo $this->uri->segment(1) == '' || $this->uri->segment(1) == 'penjualan' ? 'active' : '' ?>"><a href="<?php echo site_url(); ?>">Penjualan</a></li>
                    <li role="presentation" class="<?php echo $this->uri->segment(1) == 'penjualan' && $this->uri->segment(2) == 'laporan' ? 'active' : '' ?>"><a href="<?php echo site_url('penjualan/laporan'); ?>">Laporan</a></li>
                </ul>
            </nav>
            <h3 class="text-muted"><?php echo APP_NAME; ?></h3>
        </div>
        
        <?php $this->load->view('feedback'); ?>

        <?php $this->load->view($view); ?>

        <footer class="footer">
            <p>&copy; <?php echo date('Y'); ?> <?php echo APP_NAME; ?></p>
        </footer>
    </div>

    <script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>