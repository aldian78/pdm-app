<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>"
    />
    <!-- icheck bootstrap -->
    <link
      rel="stylesheet"
      href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>"
    />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css') ?>" />
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Register a new member</p>

          <?php echo $this->session->flashdata('massage'); ?>
          <form action="<?php echo base_url(). 'login/register' ?>" method="post" autocomplete="off">
            <div class="input-group">
              <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>              
            </div>
            <?php echo form_error('nama', '<small class="text-danger pb-2">', '</small>'); ?>
            <div class="input-group mt-3">
              <input type="email" class="form-control" name="email" placeholder="Email" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <?php echo form_error('email', '<small class="text-danger pt-3">', '</small>'); ?>
            <div class="input-group mt-3">
              <input type="text" class="form-control" name="noHP" placeholder="No Handphone" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <?php echo form_error('noHP', '<small class="text-danger pt-3">', '</small>'); ?>
            <div class="input-group mt-3">
              <input type="text" class="form-control" name="noWa" placeholder="No Whattsapp" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <?php echo form_error('noWa', '<small class="text-danger pt-3">', '</small>'); ?>
            <div class="input-group mt-3">
              <input type="text" class="form-control" name="pin" placeholder="PIN"/>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <?php echo form_error('pin', '<small class="text-danger pt-3">', '</small>'); ?>    
            <div class="input-group mt-3">
              <input type="password" class="form-control" name="password1" placeholder="Password"/>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <?php echo form_error('password1', '<small class="text-danger pt-3">', '</small>'); ?>
            <div class="input-group mt-3">
              <input type="password" class="form-control" name="password2" placeholder="Password Confirm"/>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <?php echo form_error('password2', '<small class="text-danger pt-3">', '</small>'); ?>
            <!-- <div class="form-group mt-3">
              <label for="exampleSelectRounded0">Jenis User</label>
              <select class="custom-select rounded-0" name="jenisUser" id="exampleSelectRounded0">
                <option value="1">Admin</option>
                <option value="2">Manager</option>
                <option value="3">Staff</option>
              </select>
            </div> -->
            <div class="row">
              <div class="col-8">
              </div>
              <!-- /.col -->
              <div class="col-4 mt-3">
                <button type="submit" class="btn btn-primary btn-block">
                  Sign In
                </button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          <!-- /.social-auth-links -->

         <!--  <p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
          </p> -->
          <p class="mb-0">
            <a href="<?php echo base_url('login') ?>" class="text-center"
              >Back to login</a
            >
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/dist/js/adminlte.min.js') ?>"></script>
    <!-- bs-custom-file-input -->
    <script src="<?php base_url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') ?>"></script>
    <script src="<?php base_url('assets/dist/js/adminlte.min.js') ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php base_url('assets/dist/js/demo.js') ?>"></script>
    
    <script>
      $(function () {
        bsCustomFileInput.init();
      });

  </script>
  </body>
</html>
