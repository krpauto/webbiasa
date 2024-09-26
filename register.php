<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Create Account</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition register-page">

  <style>
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

  .radio-inline label {
    font-weight: normal;
  }
  </style>

  <div class="register-box">
    <div class="register-logo">
      <a href="#"><b>Daftar Akun</b></a>
    </div>

    <?php include('message.php'); ?>

    <div class="register-box-body">
      <p class="login-box-msg">Daftar Akun</p>

      <form action="aksi-login-register.php" method="POST">
        <div class="form-group">
          <label>NIK</label>
          <input required type="text" name="nik" class="form-control" maxlength="16" placeholder="Masukkan NIK">
        </div>
        <div class="form-group">
          <label>Nama Lengkap</label>
          <input required type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap">
        </div>
        <div class="form-group">
          <label>Pendidikan Terakhir</label>
          <select class="form-control" name="pendidikan_terakhir">
            <option>--- Pilih Pendidikan Terakhir ---</option>
            <option value="sd">SD</option>
            <option value="smp">SMP</option>
            <option value="sma">SMA</option>
            <option value="d3">D3</option>
            <option value="s1">S1</option>
            <option value="s2">S2</option>
          </select>
        </div>
        <div class="form-group">
          <label>Jenis Kelamin</label><br>
          <div class="radio-inline">
            <label>
              <input type="radio" name="jenis_kelamin" value="laki-laki">
              Laki-laki
            </label>
          </div>
          <div class="radio-inline">
            <label>
              <input type="radio" name="jenis_kelamin" value="perempuan">
              Perempuan
            </label>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label>Username</label>
          <input required type="text" name="username" class="form-control"
            placeholder="Masukkan Username : example12345">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input required type="password" name="password" id="password" class="form-control"
            placeholder="Masukkan Password">
        </div>
        <div class="form-group">
          <label>Konfirmasi Password</label>
          <input required type="password" name="password_konfirmasi" id="password_konfirmasi" class="form-control"
            placeholder="Masukkan Password">
        </div>
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" onclick="lihatPassword()"> Lihat Password
            </label>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12">
            <button type="submit" name="register" class="btn btn-primary btn-block btn-flat">Daftar</button>
          </div>
        </div>
      </form>

      <div>&nbsp;</div>
      <b>Sudah Punya Akun ? </b><a href="index.php" class="text-center">Login Disini</a>

    </div>
  </div>

  <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script>
  function lihatPassword() {
    var x = document.getElementById('password');
    var y = document.getElementById('password_konfirmasi');

    if (x.type === 'password' || y.type === 'password_konfirmasi') {
      x.type = 'text';
      y.type = 'text';
    } else {
      x.type = 'password';
      y.type = 'password';
    }
  }
  </script>
</body>

</html>
