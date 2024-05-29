<?php
include './include/navbar.php';
include './include/sidebar.php';
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Dashboard Admin
    </h1>
    <br>
    <div class="alert bg-gray alert-dismissible">
      <h4><i class="icon fa fa-check"></i> Selamat Datang, <?= ucwords($_SESSION['nama']); ?>!</h4>
      Ini adalah dashboard admin.
    </div>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Jumlah Pengguna</span>
            <?php
                        require '../koneksi.php';

                        $query = "SELECT * FROM lulusan ORDER BY id_lulusan";
                        $qeryRun = mysqli_query($conn, $query);

                        $row = mysqli_num_rows($qeryRun);

                        echo "<span class='info-box-number'>$row Orang</span>";
                        ?>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Jumlah Laki-Laki</span>
            <span class="info-box-number">
              <?php
                            $query1 = "SELECT * FROM lulusan WHERE jenis_kelamin='Laki-Laki' ORDER BY id_lulusan";
                            $qeryRun1 = mysqli_query($conn, $query1);

                            $row1 = mysqli_num_rows($qeryRun1);

                            echo "<span class='info-box-number'>$row1 Orang</span>";
                            ?>
            </span>
          </div>
        </div>
      </div>

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Jumlah Perempuan</span>
            <span class="info-box-number">
              <?php
                            $query2 = "SELECT * FROM lulusan WHERE jenis_kelamin='Perempuan' ORDER BY id_lulusan";
                            $qeryRun2 = mysqli_query($conn, $query2);

                            $row2 = mysqli_num_rows($qeryRun2);

                            echo "<span class='info-box-number'>$row2 Orang</span>";
                            ?>
            </span>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 col-xs-10">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-bullhorn"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Jumlah Pengumuman</span>
            <span class="info-box-number">
              <?php
                            $query3 = "SELECT * FROM pengumuman ORDER BY id_pengumuman";
                            $qeryRun3 = mysqli_query($conn, $query3);

                            $row3 = mysqli_num_rows($qeryRun3);

                            echo "<span class='info-box-number'>$row3 Pengumuman</span>";
                            ?>
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>



<?php
include './include/footer.php';
?>
