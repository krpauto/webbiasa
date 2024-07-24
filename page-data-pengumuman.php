<?php
include './include/navbar.php';
include './include/sidebar.php';
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Pengumuman
    </h1>
  </section>

  <section class="content container-fluid">

    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah
              Pengumuman</button>
          </div>

          <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="dataTable1">
              <thead>
                <tr>
                  <th width="7%">No</th>
                  <th width="12%">Nama Pengupload</th>
                  <th>Judul Pengumuman</th>
                  <th>Tanggal Upload</th>
                  <th>File</th>
                  <th>Preview File</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <?php
                require '../koneksi.php';

                $query = "SELECT user.nama_lengkap, pengumuman.id_pengumuman, pengumuman.judul, pengumuman.tanggal_upload, pengumuman.file FROM pengumuman LEFT JOIN user ON pengumuman.id_user=user.id_user";
                $queryRun = mysqli_query($conn, $query);

                $no = 1;

                if (mysqli_num_rows($queryRun) > 0) {
                  foreach ($queryRun as $row) {
                ?>
                <tr>
                  <td><?= $no;
                          $no++ ?></td>
                  <td><?= $row['nama_lengkap']; ?></td>
                  <td><?= $row['judul']; ?></td>
                  <td><?= date("d-m-Y", strtotime($row['tanggal_upload'])) ?></td>
                  <td><?= $row['file']; ?></td>
                  <td>
                    <button class="btn btn-light" type="button" data-toggle="modal"
                      data-target="#modalDetail<?php echo $row['id_pengumuman']; ?>">Lihat
                      File</button>
                    <?php include './data-pengumuman/view-data-pengumuman.php' ?>
                  </td>
                  <td>
                    <form action="aksi-data-lulusan.php" method="post">

                      <button type="button" class="btn btn-success" data-toggle="modal"
                        data-target="#modalEdit<?php echo $row['id_pengumuman']; ?>">Update
                      </button>

                      <input type="hidden" class="delete_id_value" value="<?= $row['id_pengumuman'] ?>">
                      <a href="javascript:void(0)" class="btn btn-danger delete_btn_ajax"
                        value="<?= $row['id_pengumuman']; ?>">Hapus</a>
                    </form>
                  </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit<?php echo $row['id_pengumuman']; ?>" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                          <h4 class="modal-title">Edit Data Pengumuman</h4>
                        </div>
                        <div class="modal-body">
                          <form action="aksi-data-pengumuman.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_pengumuman" value="<?= $row['id_pengumuman']; ?>">
                            <div class="row">
                              <div class="form-group col-md-12">
                                <label>Judul Pengumuman</label>
                                <textarea class="form-control" name="judul"
                                  rows="3"><?php echo $row['judul']; ?></textarea>
                              </div>
                              <div class="form-group col-md-12">
                                <label>Tanggal Upload</label>
                                <input type="date" name="tanggal_upload" class="form-control"
                                  value="<?php echo $row['tanggal_upload']; ?>">
                              </div>
                              <div class="form-group col-md-12">
                                <label>File</label>
                                <input type="file" name="upload_file" class="form-control"
                                  value="<?php echo $row['file']; ?>">
                                <p class="help-block"><b>*File sebelumnya</b>: <?php echo $row['file']; ?></p>
                              </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                          <button type="submit" name="updatePengumuman" class="btn btn-primary">Simpan</button>
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
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Tambah Pengumuman</h4>
        </div>
        <div class="modal-body">

          <form action="aksi-data-pengumuman.php" method="POST" enctype="multipart/form-data">
            <?php
            $username = $_SESSION['username'];
            $data = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ");
            $b = mysqli_fetch_array($data);
            $id_user = $b['id_user'];
            ?>
            <input type="hidden" name="id_user" value="<?php echo $id_user ?>">

            <input type="hidden" name="id_pengumuman" class="form-control" value="<?php echo $kodePengumuman ?>">

            <div class="form-group">
              <label for="">Judul Pengumuman</label>
              <textarea class="form-control" name="judul" rows="3"></textarea>
            </div>

            <div class="form-group">
              <label for="">Tanggal Upload</label>
              <input type="date" name="tanggal_upload" class="form-control">
            </div>

            <div class="form-group">
              <label for="">Upload File</label>
              <input type="file" name="upload_file" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" name="simpanPengumuman" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal Tambah -->

</div>

<?php
include './include/footer.php';
?>

<script>
$(document).ready(function() {
  $('#dataTable1').DataTable();
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
        text: "Kamu Akan Menghapus Data Pengumuman Ini.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            type: "POST",
            url: "aksi-data-pengumuman.php",
            data: {
              "delete_btn_set": 1,
              "delete_id": deleteId,
            },
            success: function(response) {
              swal("Pengumuman Berhasil Dihapus!", {
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
