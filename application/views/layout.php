<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo (isset($title) ? $title . ' - ' : '') . 'Rental Mobil XYZ' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jumbotron-narrow.css') ?>">
</head>
<body>
    <div class="container" style="max-width: 100%;">
        <div class="header clearfix">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <?php if ($this->session->userdata('user_id')): ?>
                        <!-- <li role="presentation" class="<?php echo $this->uri->segment(1) == '' ? 'active' : '' ?>"><a href="<?php echo site_url(); ?>">Home</a></li> -->
                        <li role="presentation" class="<?php echo $this->uri->segment(1) == '' || $this->uri->segment(1) == 'mobil' ? 'active' : '' ?>"><a href="<?php echo site_url('mobil'); ?>">Mobil</a></li>
                        <li role="presentation" class="<?php echo $this->uri->segment(1) == 'pesanan' ? 'active' : '' ?>"><a href="<?php echo site_url('pesanan'); ?>">Pesanan</a></li>
                        <li role="presentation"><a href="<?php echo site_url('auth/logout'); ?>">Logout</a></li>
                    <?php else: ?>
                        <li role="presentation" class="<?php echo $this->uri->segment(1) == 'auth' && $this->uri->segment(2) == 'login' ? 'active' : '' ?>"><a href="<?php echo site_url('auth/login'); ?>">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <h3 class="text-muted">Rental XYZ</h3>
        </div>
        
        <?php $this->load->view('feedback'); ?>

        <?php $this->load->view($view); ?>

        <footer class="footer">
            <p>&copy; <?php echo date('Y'); ?> Rental XYZ, Inc.</p>
        </footer>
    </div>

    <script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>