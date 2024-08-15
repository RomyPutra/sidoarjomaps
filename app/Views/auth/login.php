<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MetaPolije - Business Mapping Partner</title>
  <link rel="shortcut icon" href="<?php echo base_url('adminlte/dist'); ?>/img/150x150.png" />
  <link rel="stylesheet" href="<?php echo base_url('adminlte/plugins'); ?>/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url('adminlte/dist'); ?>/css/adminlte.min.css">
  <style>
    #debug-icon {
      display: none !important;
    }
  </style>
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo" style="font-size: 30px; text-align: left;">
      <a href="<?php echo base_url('auth/login'); ?>">
        <img src="<?php echo base_url('adminlte/dist'); ?>/img/150x150.png" alt="METAPOLIJE" class="img-circle elevation-3" style="opacity: .8; width: 15%;">
        <span class="brand-text font-weight-light" style="text-align: justify;">METAPOLIJE</span>
      </a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php $errors = session()->getFlashdata('errors');
        if(!empty($errors)){ ?>
          <div class="alert alert-danger" role="alert">
            Whoops! Ada kesalahan saat input data, yaitu:
            <ul>
              <?php foreach ($errors as $error) { ?>
              <li><?php echo esc($error); ?></li>
              <?php } ?>
            </ul>
          </div>
        <?php } ?>
        <?php 
        $error_login = session()->getFlashdata('error_login');
        if(!empty($error_login)){ ?>
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-danger text-center">
                <?php echo $error_login; ?>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php 
        $change_password = session()->getFlashdata('change_password');
        if(!empty($change_password)){ ?>
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-success text-center">
                <?php echo $change_password; ?>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if($success_register = session()->getFlashdata('success_register')){ ?>
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-success text-center">
                <?php echo $success_register; ?>
              </div>
            </div>
          </div>
        <?php 
        } 
        $inputs = session()->getFlashdata('inputs'); 
        echo form_open(base_url('auth/proses_login')); 
        ?>
        <div class="input-group mb-3">
          <?php
          $email = [
            'type'  => 'email',
            'name'  => 'email',
            'id'    => 'email',
            'value' => $inputs == null ? old('email') : $inputs['email'],
            'class' => 'form-control',
            'placeholder' => 'your_email@domain.com'
          ];
          echo form_input($email); 
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <?php
          $password = [
            'type'  => 'password',
            'name'  => 'password',
            'id'    => 'password',
            'value' => $inputs == null ? old('password') : $inputs['password'],
            'class' => 'form-control',
            'placeholder' => 'your password'
          ];
          echo form_input($password); 
          ?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <p class="mb-0">
              <!-- <a href="<?php echo base_url('auth/register'); ?>" class="text-center">Register</a> -->
            </p>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
        </div>
      <?php echo form_close(); ?>
      </div>
    </div>
  </div>
<script src="<?php echo base_url('adminlte/plugins'); ?>/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('adminlte/plugins'); ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url('adminlte/dist'); ?>/js/adminlte.min.js"></script>
</body>
</html>