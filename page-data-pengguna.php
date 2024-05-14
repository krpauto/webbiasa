<?php
include './include/navbar.php';
include './include/sidebar.php';
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Pengguna
    </h1>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">Tambah Data
              Pengguna</button>
          </div>

          <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="dataTable">
              <thead>
                <tr>

                  <th>No</th>
                  <th>NIK</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th width="10%">Detail</th>
                  <th>Aksi Data</th>
                </tr>
              </thead>
              <tbody>
                <?php
                require '../koneksi.php';

                $query = "SELECT * FROM lulusan";
                $queryRun = mysqli_query($conn, $query);

                $no = 1;

                if (mysqli_num_rows($queryRun) > 0) {
                  foreach ($queryRun as $row) {
                ?>
                <tr>
                  <td scope="row"><?= $no;
                                      $no++ ?></td>
                  <td><?= $row['nik'] ?></td>
                  <td><?= $row['username'] ?></td>
                  <td>***********</td>
                  <td>
                    <button class="btn btn-light" type="button" data-toggle="modal"
                      data-target="#modalDetail<?php echo $row['id_lulusan']; ?>">Lihat
                      Data</button>
                    <?php include './data-lulusan/view-data-lulusan.php' ?>
                  </td>
                  <td>
                    <form action="aksi-data-pengguna.php" method="post">

                      <button type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#modalEdit<?php echo $row['id_lulusan']; ?>">Update
                      </button>

                      <input type="hidden" name="delete_id" class="delete_id_value" value="<?= $row['id_lulusan'] ?>">
                      <a href="javascript:void(0)" class="btn btn-danger delete_btn_ajax"
                        value="<?= $row['id_lulusan']; ?>">Hapus</a>
                    </form>
                  </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit<?php echo $row['id_lulusan']; ?>" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                          <h4 class="modal-title">Edit Data Lulusan</h4>
                        </div>
                        <div class="modal-body">
                          <form action="aksi-data-pengguna.php" method="POST">
                            <input type="hidden" name="id_lulusan" id="id_lulusan" value="<?= $row['id_lulusan']; ?>">
                            <div class="row">
                              <div class="form-group col-md-6">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control"
                                  value="<?php echo $row['username']; ?>">
                              </div>
                              <div class="form-group col-md-6">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control"
                                  value="<?php echo $row['password']; ?>">
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-6">
                                <label>NIK</label>
                                <input type="text" name="nik" class="form-control" maxlength="16"
                                  value="<?php echo $row['nik']; ?>">
                              </div>
                              <div class="form-group col-md-6">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control"
                                  value="<?php echo $row['nama_lengkap']; ?>">
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-6">
                                <label>Alamat Lengkap</label>
                                <input type="text" name="alamat_lengkap" class="form-control"
                                  value="<?php echo $row['alamat_lengkap']; ?>">
                              </div>
                              <div class="form-group col-md-6">
                                <label>Nomor Telepon</label>
                                <input type="text" name="nomor_telepon" class="form-control"
                                  value="<?php echo $row['nomor_telepon']; ?>">
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-6">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir"
                                  value="<?php echo $row['tanggal_lahir'];  ?>">
                              </div>
                              <div class="form-group col-md-6">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                  <option>--- Pilih Jenis Kelamin ---</option>
                                  <?php
                                      if ($row['jenis_kelamin'] == 'Laki-laki') { ?>
                                  <option value="Laki-laki" selected>Laki-laki
                                  </option>
                                  <option value="Perempuan">Perempuan</option>
                                  <?php } elseif ($row['jenis_kelamin'] == 'Perempuan') { ?>
                                  <option value="Laki-laki">Laki-laki</option>
                                  <option value="Perempuan" selected>Perempuan
                                  </option>
                                  <?php } else { ?>
                                  <option value="Laki-laki">Laki-laki</option>
                                  <option value="Perempuan">Perempuan</option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-6">
                                <label>Status Pekerjaan</label>
                                <select name="status_pekerjaan" class="form-control">
                                  <option value="">--- Pilih Status Pekerjaan ---</option>
                                  <?php
                                      if ($row['status_pekerjaan'] == 'Bekerja') { ?>
                                  <option value="Bekerja" selected>Bekerja</option>
                                  <option value="Belum Bekerja">Belum Bekerja</option>
                                  <?php } elseif ($row['status_pekerjaan'] == 'Belum Bekerja') { ?>
                                  <option value="Bekerja">Bekerja</option>
                                  <option value="Belum Bekerja" selected>Belum Bekerja
                                  </option>
                                  <?php } else { ?>
                                  <option value="Bekerja">Bekerja</option>
                                  <option value="Belum Bekerja">Belum Bekerja</option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                          <button type="submit" name="updateData" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal Edit -->

                <?php
                  }
                } else {
                  echo "Data Tidak Ada";
                }

                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal Tambah -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Tambah Data Lulusan</h4>
          </div>
          <div class="modal-body">
            <form action="aksi-data-pengguna.php" method="POST">
              <p>Untuk Membuat Akun Data Lulusan Hanya Inputkan Username Dan Password Saja.</p>
              <hr>
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Masukkan Username">
                </div>
                <div class="form-group col-md-6">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="form-group col-md-6">
                  <label>NIK</label>
                  <input type="text" name="nik" class="form-control" maxlength="16" placeholder="Masukkan NIK">
                </div>
                <div class="form-group col-md-6">
                  <label>Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label>Alamat Lengkap</label>
                  <input type="text" name="alamat_lengkap" class="form-control" placeholder="Masukkan Alamat Lengkap">
                </div>
                <div class="form-group col-md-6">
                  <label>Nomor Telepon</label>
                  <input type="number" name="nomor_telepon" class="form-control" placeholder="Masukkan Nomor Telepon">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label>Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir">
                </div>
                <div class="form-group col-md-6">
                  <label>Jenis Kelamin</label>
                  <select name="jenis_kelamin" class="form-control">
                    <option value="">--- Pilih Jenis Kelamin ---</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label>Status Pekerjaan</label>
                  <select name="status_pekerjaan" class="form-control">
                    <option value="">--- Pilih Status Pekerjaan ---</option>
                    <option value="Bekerja">Bekerja</option>
                    <option value="Belum Bekerja">Belum Bekerja</option>
                  </select>
                </div>
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
            <button type="submit" name="tambahData" class="btn btn-primary">Simpan</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Tambah -->

</div>
<!-- /.content-wrapper -->
<?php
include './include/footer.php';
?>

<script>
$(document).ready(function() {
  $('#dataTable').DataTable({
    pageLength: 10,
    paging: true,
    searching: true,
    order: [
      [0, "asc"]
    ],
    columnDefs: [{
      orderable: false,
      targets: [7]
    }]
  });
});
</script>

<script>
$(document).ready(function() {
  $('.delete_btn_ajax').click(function(e) {
    e.preventDefault();

    var deleteId = $(this).closest("tr").find(".delete_id_value").val();
    console.log(deleteId);
    swal({
        title: "Yakin Ingin Dihapus ?",
        text: "Kamu Akan Menghapus Data Pengguna Ini.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            type: "POST",
            url: "aksi-data-pengguna.php",
            data: {
              "delete_btn_set": 1,
              "delete_id": deleteId,
            },
            success: function(response) {
              swal("Data Lulusan Berhasil Di Hapus!", {
                icon: "success",
              }).then((result) => {
                location.reload();
              })
            }
          });
        }
      });
  });
});
</script>