<?php
include("models/proses_staff.php");
?>

<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Staff</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="http://localhost/penjualanhp_two/index.php?page=home">Home</a>
      </li>
      <li class="breadcrumb-item">Data Master</li>
      <li class="breadcrumb-item active" aria-current="page">Data Staff</li>
    </ol>
  </div>

  <!-- DataTable with Hover -->
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Staff</h6>
        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#add">
          <i class="fas fa fa-plus"></i>
        </a>

        <!-- Modal add -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--Form input add Staff-->
                 <form method="POST">
                    <div class="form-group">
                      <label>Nama Staff</label>
                      <input type="text" name="NamaStaff" class="form-control">
                      <br>
                      <fieldset class="form-group">
                      <div class="row">
                        <legend class="col-form-label col-sm-3 pt-0">Jenis Kelamin</legend>
                        <div class="col-sm-9">
                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="StaffJK" value="1" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio1">Laki-laki</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="StaffJK" value="2" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio2">Perempuan</label>
                          </div>
                        </div>
                      </div>
                    </fieldset>
                      <br>
                      <label>Email</label>
                      <input type="email" name="StaffEmail" class="form-control">
                      <br>
                      <label>Alamat</label>
                      <input type="text" name="StaffAlamat" class="form-control">
                      <br>
                      <label>Posisi Staff</label>
                      <input type="text" name="PosisiStaff" class="form-control">
                    </div>
                  </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="addstaff" value="Simpan">
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
              <th>Nama Staff</th>
              <th>Jenis Kelamin</th>
              <th>Email</th>
              <th>Alamat</th>
              <th>Posisi Staff</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no=0;
        $hasil=mysqli_query($koneksi,"SELECT * FROM tabel_staff ORDER BY StaffID ASC");
        while($data=mysqli_fetch_array($hasil))
        {
          $no++;
          $id=$data['StaffID'];
        ?>
          <tr>
            <td><?=$no;?></td>
            <td><?=$data['NamaStaff'];?></td>
            <td><?php if ($data['StaffJK'] == 1) { echo "Laki-laki"; } else { echo "Perempuan"; } ?></td>
            <td><?=$data['StaffEmail'];?></td>
            <td><?=$data['StaffAlamat'];?></td>
            <td><?=$data['PosisiStaff'];?></td>
            <td>
              <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit<?=$id;?>">
                <i class="fas fa-pen"></i>
              </a>
              <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?=$id;?>">
                <i class="fas fa-trash"></i>
              </a>

               <!-- Modal edit Staff -->
        <div class="modal fade" id="edit<?=$id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--Form edit Staff-->
                 <form method="POST">
                    <div class="form-group">
                      <label>Nama Staff</label>
                      <input type="text" name="NamaStaff" class="form-control" value="<?=$data['NamaStaff'];?>">
                      <br>
                      <label>Jenis Kelamin</label><br>
                      <select name="StaffJK" class="form-control">
                        <option value="1" <?php if($data['StaffJK'] == 1) { echo 'selected'; } ?>>Laki-laki</option>
                        <option value="2" <?php if($data['StaffJK'] == 2) { echo 'selected'; } ?>>Perempuan</option>
                      </select>
                      <br>
                      <label>Email</label>
                      <input type="email" name="StaffEmail" class="form-control" value="<?=$data['StaffEmail'];?>">
                      <br>
                      <label>Alamat</label>
                      <input type="text" name="StaffAlamat" class="form-control"value="<?=$data['StaffAlamat'];?>">
                      <br>
                      <label>Posisi Staff</label>
                      <input type="text" name="PosisiStaff" class="form-control"value="<?=$data['PosisiStaff'];?>">
                      <input type="hidden" name="idstaff" class="form-control" value="<?=$id;?>">
                    </div>
                  
                  </div> 
              <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="editstaff" value="Simpan">
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>

            <!-- Modal Delete Staff -->
        <div class="modal fade" id="delete<?=$id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
                 <form method="POST">
                    <div class="form-group">
                      <p>Apakah anda yakin ingin menghapus data nama <?=$data['NamaStaff'];?> ?
                      <input type="hidden" name="idstaff" class="form-control" value="<?=$id;?>">
                    
                    </div>
                  <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="hapusstaff" value="Hapus">
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