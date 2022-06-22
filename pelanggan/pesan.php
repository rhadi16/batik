<div class="head-dt pb-2 mt-4">
  <h5>Daftar Barang</h5>
  <button type="button" class="btn btn-success df" data-bs-toggle="modal" data-bs-target="#list-pesanan">Lihat Pesanan Anda</button>
</div>

<!-- Modal Tambah Anggota -->
<div class="modal fade" id="list-pesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">List Pesanan Anda</h5>
      </div>
      <form action="func/checkout_func.php?action=insert" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <?php
            $user = $_SESSION['user'];
            $total_semua_harga = 0;
            $qry2 = "SELECT 
                      * 
                    FROM pesanan a
                    LEFT JOIN tb_barang b ON a.id_barang=b.id_barang
                    WHERE a.id_pelanggan = $user";
            $no = 1;
            $query2 = mysqli_query($mysqli, $qry2);
            $jum_pes = mysqli_num_rows($query2);
            while ($data2 = mysqli_fetch_array($query2)) {
          ?>
            <div class="card mb-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-2 text-center">
                    <img src="../admin/foto_brg/<?php echo $data2['foto'] ?>" class="keranjang">
                  </div>
                  <div class="col-8">
                    <input type="text" readonly class="form-control" value="<?php echo $data2['nama_barang'] ?>">

                    <input type="text" readonly class="form-control" value="<?php echo $data2['jum_dibeli'] ?>">

                    <input type="text" readonly class="form-control" value="Rp. <?php echo number_format($data2['total_harga'],0,",",".") ?>">
                    <?php 
                      $total_semua_harga += $data2['total_harga'];
                    ?>
                    <input type="hidden" readonly class="form-control" required name="id_pesanan[]" value="<?php echo $data2['id_pesanan'] ?>">
                    <input type="hidden" readonly class="form-control" required name="id_pelanggan" value="<?php echo $user; ?>">
                    <input type="hidden" readonly class="form-control" required name="id_barang[]" value="<?php echo $data2['id_barang'] ?>">
                    <input type="hidden" readonly class="form-control" name="jum_dibeli[]" value="<?php echo $data2['jum_dibeli'] ?>">
                    <input type="hidden" readonly class="form-control" required name="tgl_pesan" value="<?php echo $data2['tgl_pesan'] ?>">
                  </div>
                  <div class="col-2 text-center">
                    <button type="button" class="btn btn-danger mt-2 conf-del-pes<?php echo $data2['id_pesanan']; ?>">Hapus</button>
                  </div>
                </div>
              </div>
            </div>

            <script type="text/javascript">
              $('.conf-del-pes<?php echo $data2['id_pesanan']; ?>').on('click', function(e) {
                Swal.fire({
                  title: 'Anda Yakin?',
                  text: "Ingin Menghapus Pesanan <?php echo $data2['nama_barang']; ?>!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, Yakin!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = "<?php echo 'func/pesanan_func.php?action=delete&id_pesanan='.$data2['id_pesanan'].'&id_barang='.$data2['id_barang'] ?>";
                  }
                })
              });
            </script>
          <?php } ?>
          <div class="mb-3">
            <label class="form-label">Total Semua Harga</label>
            <input type="hidden" readonly class="form-control" name="total_harga" required value="<?php echo $total_semua_harga ?>">
            <input type="text" readonly class="form-control" required value="Rp. <?php echo number_format($total_semua_harga,0,",",".") ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Bayar Via</label>
            <select class="form-select" aria-label="Default select example" name="bayar_via" required>
              <option selected>Pilih Bayar Via</option>
              <option value="Mandiri">Mandiri - 02342837</option>
              <option value="BNI">BNI - 395737</option>
              <option value="BRI">BRI - 22342342</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Bukti Transfer</label>
            <input class="form-control" type="file" name="file_name" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger mt-2" data-bs-dismiss="modal">Close</button>
          <?php 
            if ($jum_pes > 0) {
          ?>
            <button type="submit" class="btn btn-success mt-2">Checkout</button>
          <?php } ?>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="row justify-content-center mt-3">
  <?php
    $qry2 = "SELECT * FROM tb_barang";
    $field = "nama_barang";
    $view = "index.php";
    $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;

    $limit = 15;
    $limitStart = ($page - 1) * $limit;
    $query2 = mysqli_query($mysqli, "$qry2 LIMIT ".$limitStart.",".$limit);

    while ($data2 = mysqli_fetch_array($query2)) {
  ?>
      <div class="col-6 col-md-4 col-lg-3 mb-3">
        <div class="card">
          <div class="img-barang" style="background-image: url('../admin/foto_brg/<?php echo $data2['foto'] ?>');"></div>
          <ul class="list-group list-group-flush text-center">
            <li class="list-group-item"><?php echo $data2['nama_barang']; ?></li>
            <li class="list-group-item">Rp. <?php echo number_format($data2['harga_barang'],0,",",".") ?></li>
            <li class="list-group-item">
              <?php 
                if ($data2['stok'] <= 0) {
                  echo '<span class="text-danger"><b>Sold Out</b></span>';
                } else {
                  echo '<span class="text-success"><b>Ready '.$data2['stok'].'</b></span>';
                }
              ?>
            </li>
            <li class="list-group-item pb-2">
              <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#detail-barang<?php echo $data2['id_barang']; ?>">Lihat Detail</button>
              <?php 
                if ($data2['stok'] <= 0) {
              ?>
                <button type="button" disabled class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#pesan-barang<?php echo $data2['id_barang']; ?>">Pesan</button>
              <?php } else { ?>
                <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#pesan-barang<?php echo $data2['id_barang']; ?>">Pesan</button>
              <?php } ?>
            </li>
          </ul>
        </div>
      </div>

      <!-- Detail Barang -->
      <div class="modal fade" id="detail-barang<?php echo $data2['id_barang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detail Barang</h5>
            </div>
            <form action="func/barang_func.php?action=update" enctype="multipart/form-data" method="post">
              <div class="modal-body">
                <div class="mb-3 text-center">
                  <img src="../admin/foto_brg/<?php echo $data2['foto'] ?>" class="img-thumbnail">
                </div>
                <div class="mb-3">
                  <input type="text" readonly class="form-control" id="nama_barang<?php echo $data2['id_barang']; ?>" name="nama_barang" required placeholder="Nama Barang" value="<?php echo $data2['nama_barang'] ?>">
                </div>
                <div class="mb-3">
                  <input type="text" readonly class="form-control" id="harga_barang<?php echo $data2['id_barang']; ?>" name="harga_barang" required placeholder="Harga Barang" value="Rp. <?php echo number_format($data2['harga_barang'],0,",",".") ?>">
                </div>
                <div class="mb-3">
                  <input type="text" readonly class="form-control" id="berat<?php echo $data2['id_barang']; ?>" name="berat" required placeholder="Berat Barang" value="<?php echo $data2['berat'] ?> Kg">
                </div>
                <div class="mb-3">
                  <input type="text" readonly class="form-control" id="desk_barang<?php echo $data2['id_barang']; ?>" name="desk_barang" required placeholder="Deskripsi Barang" value="<?php echo $data2['desk_barang'] ?>">
                </div>
                <div>
                  <input type="text" readonly class="form-control" id="stok<?php echo $data2['id_barang']; ?>" name="stok" required placeholder="Stok Barang" value="<?php echo $data2['stok'] ?>">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal Pesan -->
      <div class="modal fade" id="pesan-barang<?php echo $data2['id_barang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pesan Barang</h5>
            </div>
            <form action="func/pesanan_func.php?action=insert" enctype="multipart/form-data" method="post">
              <div class="modal-body">
                <input type="hidden" id="id_pelanggan<?php echo $data2['id_barang']/2; ?>" name="id_pelanggan" value="<?php echo $_SESSION['user']; ?>">
                <input type="hidden" id="id_barang<?php echo $data2['id_barang']/2; ?>" name="id_barang" value="<?php echo $data2['id_barang'] ?>">
                <input type="hidden" id="harga_barang<?php echo $data2['id_barang']/2; ?>" name="harga_barang" value="<?php echo $data2['harga_barang'] ?>">
                <div class="mb-3">
                  <input type="text" class="form-control" id="nama_barang<?php echo $data2['id_barang']/2; ?>" name="nama_barang" required placeholder="Nama Barang" value="<?php echo $data2['nama_barang'] ?>" readonly>
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" id="jum_dibeli<?php echo $data2['id_barang']/2; ?>" name="jum_dibeli" required placeholder="Jumlah Barang">
                </div>
                <div>
                  <input type="text" class="form-control" id="tgl_pesan<?php echo $data2['id_barang']/2; ?>" name="tgl_pesan" required value="<?php echo date('Y-m-d h:i:s') ?>" readonly>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Simpan Ke Keranjang</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  <?php } ?>
  <div class="mt-3">
    <?php include('btn-paginasi.php'); ?>
  </div>
</div>