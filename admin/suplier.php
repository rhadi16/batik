<?php 
  $qry4 = "SELECT
            *
          FROM suplier";
?>

<div class="head-dt pb-2 mt-4">
  <h5>Daftar Semua Suplier</h5>
  <button type="button" class="btn btn-success df" data-bs-toggle="modal" data-bs-target="#suplier-tambah">Tambah Suplier</button>
</div>

<!-- Modal Tambah Suplier -->
<div class="modal fade" id="suplier-tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Suplier Baru</h5>
      </div>
      <form action="func/suplier_func.php?action=insert" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <input type="text" class="form-control" id="nama_suplier" name="nama_suplier" required placeholder="Nama Suplier">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="no_suplier" name="no_suplier" required placeholder="Nomor Suplier">
          </div>
          <div>
            <input type="text" class="form-control" id="alamat_suplier" name="alamat_suplier" required placeholder="Alamat Suplier">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="datatable">
  <table id="example4" class="table table-striped align-middle text-center" style="width:100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Suplier</th>
        <th>Nomor Suplier</th>
        <th>Alamat Suplier</th>
        <th>Action</th>
      </tr>
    <tbody>
      <?php
        $no = 1;
        $query4 = mysqli_query($mysqli, $qry4);
        while ($data4 = mysqli_fetch_array($query4)) {
      ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data4['nama_suplier'] ?></td>
            <td><?php echo $data4['no_suplier'] ?></td>
            <td><?php echo $data4['alamat_suplier'] ?></td>
            <td>
              <button type="button" class="btn btn-danger mb-1 conf-del<?php echo $data4['id_suplier']; ?>">Hapus</button>
              <button type="button" class="btn btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#edit-suplier<?php echo $data4['id_suplier']; ?>">Edit</button>
            </td>
          </tr>

          <script type="text/javascript">
            $('.conf-del<?php echo $data4['id_suplier']; ?>').on('click', function(e) {
              Swal.fire({
                title: 'Anda Yakin?',
                text: "Ingin Menghapus Suplier <?php echo $data4['nama_suplier']; ?>!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Yakin!'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = "<?php echo 'func/suplier_func.php?action=delete&id_suplier='.$data4['id_suplier'] ?>";
                }
              })
            });
          </script>

          <!-- Modal Edit Anggota -->
          <div class="modal fade" id="edit-suplier<?php echo $data4['id_suplier']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Data Suplier</h5>
                </div>
                <form action="func/suplier_func.php?action=update" enctype="multipart/form-data" method="post">
                  <div class="modal-body">
                    <input type="hidden" id="id_suplier" name="id_suplier" value="<?php echo $data4['id_suplier'] ?>">
                    <div class="mb-3">
                      <input type="text" class="form-control" name="nama_suplier" required placeholder="Nama Suplier" value="<?php echo $data4['nama_suplier'] ?>">
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control" name="no_suplier" required placeholder="Nomor Suplier" value="<?php echo $data4['no_suplier'] ?>">
                    </div>
                    <div>
                      <input type="text" class="form-control" name="alamat_suplier" required placeholder="Alamat Suplier" value="<?php echo $data4['alamat_suplier'] ?>">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Ubah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <th>No</th>
        <th>Nama Suplier</th>
        <th>Nomor Suplier</th>
        <th>Alamat Suplier</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>