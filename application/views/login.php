<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link href="<?= base_url('assets/vendor/fonts/circular-std/style.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/libs/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') ?>">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center">
                <a href="/">
                    <img class="logo-img" src="<?= base_url('assets/images/logo/logo.jpg') ?>" alt="logo" width="50%">
                </a>
                <span class="splash-description">BACK OFFICE FINANCE INFORMATION SYSTEM</span>
                <?php $this->load->view('admin/layout/alert') ?>
            </div>
            <div class="card-body">
                <form action="<?= site_url('auth/login') ?>" method="POST">
                    <div class="form-group">
                        <select name="type" id="type" class="form-control type" required>
                            <option value="">Chose user...</option>
                            <option value="1">Tenant</option>
                            <option value="2">Backoffice</option>
                        </select>
                        <small class="mini-text text-muted">Select user first.</small>

                        <small class="text-danger"><?= form_error('username') ?></small>
                    </div>

                    <div class="form-group">
                        <input class="form-control form-control-lg" id="username" type="text" placeholder="Username" name="username">

                        <small class="text-danger"><?= form_error('username') ?></small>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" type="password" placeholder="Password" name="password">

                        <small class="text-danger"><?= form_error('password') ?></small>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="<?= base_url('assets/vendor/jquery/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.js') ?>"></script>
    <script>
        $(document).ready(function(){
            $('.type').change(function(){
                let type = $(this).val();

                if(type == 1){
                    $('#username').attr('placeholder', 'Tenant Code');
                }else{
                    $('#username').attr('placeholder', 'Username');
                }
            });
        });
    </script>
</body>
 
</html>