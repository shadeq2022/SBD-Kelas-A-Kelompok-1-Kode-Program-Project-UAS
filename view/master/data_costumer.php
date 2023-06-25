<?php
include("models/proses_costumer.php");
?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Costumer</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="http://localhost/penjualanhp_two/index.php?page=home">Home</a>
      </li>
      <li class="breadcrumb-item">Data Master</li>
      <li class="breadcrumb-item active" aria-current="page">Data Costumer</li>
    </ol>
  </div>

  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Costumer</h6>
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#add">
          <i class="fas fa fa-plus"></i>
        </a>

        <!-- Modal add -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Costumer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--Form input add Costumer-->
                 <form method="POST">
                    <div class="form-group">
                      <label>Nama Costumer</label>
                      <input type="text" name="CostumerName" class="form-control">
                      <br>
                      <fieldset class="form-group">
                      <div class="row">
                        <legend class="col-form-label col-sm-3 pt-0">Jenis Kelamin</legend>
                        <div class="col-sm-9">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="CostumerJK" value="1" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio1">Laki-laki</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="CostumerJK" value="2" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio2">Perempuan</label>
                          </div>
                        </div>
                      </div>
                    </fieldset>
                      <br>
                      <label>No HP</label>
                      <input type="text" name="CostumerPhone" class="form-control">
                      <br>
                      <label>Email</label>
                      <input type="email" name="CostumerEmail" class="form-control">
                      <br>
                      <label>Alamat</label>
                      <input type="text" name="CostumerAddress" class="form-control">
                    </div>
                  </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="addcostumer" value="Simpan">
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
              <th>No</th>
              <th>Nama Costumer</th>
              <th>Jenis Kelamin</th>
              <th>No HP</th>
              <th>Email</th>
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no=0;
        $hasil=mysqli_query($koneksi,"SELECT * FROM tabel_costumer ORDER BY CostumerID ASC");
        while($data=mysqli_fetch_array($hasil))
        {
          $no++;
          $id=$data['CostumerID'];
        ?>
          <tr>
            <td><?=$no;?></td>
            <td><?=$data['CostumerName'];?></td>
            <td><?php if ($data['CostumerJK'] == 1) { echo "Laki-laki"; } else { echo "Perempuan"; } ?></td>
            <td><?=$data['CostumerPhone'];?></td>
            <td><?=$data['CostumerEmail'];?></td>
            <td><?=$data['CostumerAddress'];?></td>
            <td>
              <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit<?=$id;?>">
                <i class="fas fa-pen"></i>
              </a>
              <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?=$id;?>">
                <i class="fas fa-trash"></i>
              </a>

               <!-- Modal edit Costumer -->
        <div class="modal fade" id="edit<?=$id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Costumer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--Form edit Costumer-->
                 <form method="POST">
                    <div class="form-group">
                      <label>Nama Costumer</label>
                      <input type="text" name="CostumerName" class="form-control" value="<?=$data['CostumerName'];?>">
                      <br>
                      <label>Jenis Kelamin</label><br>
                      <select name="CostumerJK" class="form-control">
                        <option value="1" <?php if($data['CostumerJK'] == 1) { echo 'selected'; } ?>>Laki-laki</option>
                        <option value="2" <?php if($data['CostumerJK'] == 2) { echo 'selected'; } ?>>Perempuan</option>
                      </select>
                      <br>
                      <label>No HP</label>
                      <input type="text" name="CostumerPhone" class="form-control" value="<?=$data['CostumerPhone'];?>">
                      <br>
                      <label>Email</label>
                      <input type="email" name="CostumerEmail" class="form-control"value="<?=$data['CostumerEmail'];?>">
                      <br>
                      <label>Alamat</label>
                      <input type="text" name="CostumerAddress" class="form-control"value="<?=$data['CostumerAddress'];?>">
                      <input type="hidden" name="idcos" class="form-control" value="<?=$id;?>">
                    </div>
                  
                  </div> 
              <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="editcostumer" value="Simpan">
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>

            <!-- Modal Delete Costumer -->
        <div class="modal fade" id="delete<?=$id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Costumer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--Form hapus costumer-->
                 <form method="POST">
                    <div class="form-group">
                      <p>Apakah anda yakin ingin menghapus data nama <?=$data['CostumerName'];?> ?
                      <input type="hidden" name="idcos" class="form-control" value="<?=$id;?>">
                    
                    </div>
                  <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="hapuscostumer" value="Hapus">
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