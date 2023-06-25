<?php
include("models/proses_inv_utama.php");
?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Invoice Utama</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="http://localhost/penjualanhp_two/index.php?page=home">Home</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Invoice Utama</li>
    </ol>
  </div>
  <div class="card-body">
  
  
  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Invoice Utama</h6>
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#add">
          <i class="fas fa fa-plus"></i>
        </a>
        <!--Kode Invoice otomatis -->
        <?php 
        $bln = date('m'); $thn = date('Y');
        $bikin_nota = mysqli_query($koneksi, "SELECT max(NoInvoice) as kodeTerbesar11 FROM invoice_utama WHERE month(Date)='$bln' AND year(Date)='$thn'");
        $datanya = mysqli_fetch_array($bikin_nota);
        $kodenota= $datanya['kodeTerbesar11'];
        $tgl = date("m/y");
        $huruf = "INV-";
        $urutan = (int) substr($kodenota, 4, 3);
        $urutan++;
        $kodeCart = $huruf . sprintf("%03s", $urutan) . "/" . $tgl;
        ?>

        <!-- Modal add -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Invoice Utama</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--Form input add inv utama-->
                <form method="POST">
                  <div class="form-group">
                    <label>Nomor Invoice</label>
                      <input type="text" name="NoInvoice" class="form-control" value="<?php echo $kodeCart ?>" readonly>
                      <br>
                      <label>Tanggal Transaksi</label>
                      <input type="date" name="Date" class="form-control" value="<?php echo date("Y-m-d"); ?>" readonly>
                      <br>
                      <label>Costumer</label>
                        <select class="form-control mb-3" name="CostumerID">
                          <option>Pilih Costumer</option>
                          <?php
                          $hasil=mysqli_query($koneksi,"SELECT * FROM tabel_costumer");
                          while($data=mysqli_fetch_array($hasil))
                          {
                          ?>
                          <option value="<?=$data['CostumerID'];?>"><?=$data['CostumerName'];?></option>
                          <?php
                          }
                          ?>
                        </select>
                      <label>Staff</label>
                      <select class="form-control mb-3" name="StaffID">
                          <option>Pilih Staff</option>
                          <?php
                          $hasil=mysqli_query($koneksi,"SELECT * FROM tabel_staff");
                          while($data=mysqli_fetch_array($hasil))
                          {
                          ?>
                          <option value="<?=$data['StaffID'];?>"><?=$data['NamaStaff'];?></option>
                          <?php
                          }
                          ?>
                        </select>
                      <br>
                    </div>
                  </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info " name="addinvoiceutama"> 
                <i class="fa fa-arrow-right fa-xs mr-1" ></i>Lanjut<a href="http://localhost/penjualanhp_two/index.php?page=detail_inv_utama">
                    </a></button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<!-- ----------------------------------------------------------------------------------------------------- -->
      <div class="table-responsive p-3" >
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>No</th>
              <th>Nomor Invoice</th>
              <th>Tanggal Transaksi</th>
              <th>Costumer</th>
              <th>Staff</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no=0;
          $hasil = mysqli_query($koneksi, "SELECT * FROM (invoice_utama INNER JOIN tabel_costumer 
                                        ON invoice_utama.CostumerID=tabel_costumer.CostumerID)
                                        INNER JOIN tabel_staff ON invoice_utama.StaffID=tabel_staff.StaffID ORDER BY id_inv ASC")
                                        or die(mysqli_error($koneksi));

      while ($data = mysqli_fetch_array($hasil)) {
          $no++;
          $id = $data['id_inv'];
          $costumerData = $data['CostumerName'];
          $staffData = $data['NamaStaff'];
          ?>
          <tr>
              <td><?= $no; ?></td>
              <td><?= $data['NoInvoice']; ?></td>
              <td><?= $data['Date']; ?></td>
              <td>
                  <?php
                  echo $costumerData
                  ?>
              </td>
              <td>
                  <?php
                  echo $staffData
                  ?>
              </td>
              <td>
              
              <a class="btn btn-primary" href="index.php?page=view_detail&id=<?php echo $id ?>">
                                            <i class="fa fa-eye mr-1"></i>View</a>
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$id;?>">
                      <i class="fas fa-trash"></i>
                    </a>

            <!-- Modal Delete invoice -->
        <div class="modal fade" id="delete<?=$id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--Form Hapus invoice-->
                 <form method="POST">
                    <div class="form-group">
                      <p>Apakah anda yakin ingin menghapus data <?=$data['NoInvoice'];?> ?
                      <input type="hidden" name="idinv" class="form-control" value="<?=$id;?>">
                    
                    </div>
                  <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="hapusinvoice" value="Hapus">
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      
            </td>
          </tr>
          <?php
        }
        ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!--Row--></div>