<?php
include("models/proses_hp.php");
?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data HP</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="http://localhost/penjualanhp_two/index.php?page=home">Home</a>
      </li>
      <li class="breadcrumb-item">Data Master</li>
      <li class="breadcrumb-item active" aria-current="page">Data HP</li>
    </ol>
  </div>

  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data HP</h6>
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#add">
          <i class="fas fa fa-plus"></i>
        </a>

        <!-- Modal add -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data HP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--Form input add HP-->
                 <form method="POST">
                    <div class="form-group">
                      <label>Nama HP</label>
                      <input type="text" name="nama_hp" class="form-control">
                      <br>
                      <label>Harga HP</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" name="harga_hp" class="form-control">
                      <div class="input-group-append">
                      </div>
                    </div>
                    <br>
                    <label>Stok</label>
                      <input type="number" name="stock" class="form-control">
                      <br>
                      <label for="exampleFormControlTextarea1">Deskripsi</label> 
                      <textarea class="form-control" rows="3" maxlength="250" placeholder="Maksimal 250 karakter" name="description"></textarea>
                      <br>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="addhp" value="Simpan">
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th style="width: 50px;">No</th>
              <th>Nama HP</th>
              <th>Harga HP</th>
              <th>Stok</th>
              <th>Deskripsi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no=0;
        $hasil=mysqli_query($koneksi,"SELECT * FROM tabel_hp ORDER BY id_hp ASC");
        while($data=mysqli_fetch_array($hasil))
        {
          $no++;
          $id=$data['id_hp'];
        ?>
          <tr>
            <td><?=$no;?></td>
            <td><?=$data['nama_hp'];?></td>
            <td>Rp. <?= ribuan($data['harga_hp']);?></td>
            <td><?=$data['stock'];?></td>
            <td><?=$data['description'];?></td>
            <td>
              <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit<?=$id;?>">
                <i class="fas fa-pen"></i>
              </a>
              <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?=$id;?>">
                <i class="fas fa-trash"></i>
              </a>

               <!-- Modal edit HP -->
        <div class="modal fade" id="edit<?=$id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data HP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--Form edit HP-->
                 <form method="POST">
                    <div class="form-group">
                      <label>Nama HP</label>
                      <input type="text" name="nama_hp" class="form-control" value="<?=$data['nama_hp'];?>">
                      <br>
                      <label>Harga HP</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" name="harga_hp" class="form-control" value="<?=$data['harga_hp'];?>">
                          <div class="input-group-append">
                      </div>
                    </div>
                    <br>
                    <label>Stok</label>
                      <input type="number" name="stock" class="form-control" value="<?=$data['stock'];?>">
                      <br>
                      <label for="exampleFormControlTextarea1">Deskripsi</label>
                      <textarea class="form-control" name="description" rows="3" maxlength="250"><?=$data['description'];?></textarea>
                      <br>
                      <input type="hidden" name="idhp" class="form-control" value="<?=$id;?>">
                    </div>
                    
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="edithp" value="Simpan">
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>

            <!-- Modal Delete HP -->
        <div class="modal fade" id="delete<?=$id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data HP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--Form Hapus HP-->
                 <form method="POST">
                    <div class="form-group">
                      <p>Apakah anda yakin ingin menghapus data HP <?=$data['nama_hp'];?> ?
                      <input type="hidden" name="idhp" class="form-control" value="<?=$id;?>">
                    
                    </div>
                  <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="hapushp" value="Hapus">
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

  <!--Row-->