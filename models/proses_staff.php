<?php
//menambah data Staff
include 'koneksi.php'; // Memasukkan file koneksi.php
if(isset($_POST['addstaff'])) {
    $NamaStaff = $_POST['NamaStaff'];
    $StaffJK = $_POST['StaffJK'];
    $StaffEmail = $_POST['StaffEmail'];
    $StaffAlamat = $_POST['StaffAlamat'];
    $PosisiStaff = $_POST['PosisiStaff'];

    // Cek data
    $query = "SELECT * FROM `tabel_staff` WHERE `NamaStaff` LIKE '$NamaStaff'";
    $hasil = mysqli_query($koneksi, $query);
    $jumlah = mysqli_num_rows($hasil);

    if ($jumlah == 0) {
        $query = "INSERT INTO `tabel_staff` (`NamaStaff`, `StaffJK`, `StaffEmail`, `StaffAlamat`, `PosisiStaff`) VALUES ('$NamaStaff', '$StaffJK', '$StaffEmail', '$StaffAlamat', '$PosisiStaff')";
		$tambah = mysqli_query($koneksi, $query);
		if($tambah){
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h6><i class="fas fa-check"></i><b> Success Entry!</b></h6>
            </div>
            <?php
            header('location:index.php?page=staff');
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h6><i class="fas fa-ban"></i><b> Gagal!</b></h6>
            </div>
            <?php
            header('location:index.php?page=staff');
        }
    }
	else {
		?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h6><i class="fas fa-ban"></i><b> Gagal! Nama staff yang anda masukkan sudah ada!</b></h6>
		</div>
		<?php
		header('location:index.php?page=staff');
	}
}

//update Data Staff
if(isset($_POST['editstaff'])){
	$idstaff = $_POST['idstaff'];
	$NamaStaff = $_POST['NamaStaff'];
    $StaffJK = $_POST['StaffJK'];
    $StaffEmail = $_POST['StaffEmail'];
    $StaffAlamat = $_POST['StaffAlamat'];
    $PosisiStaff = $_POST['PosisiStaff'];

	// Query update data
	$query = "UPDATE tabel_staff SET NamaStaff='$NamaStaff', StaffJK='$StaffJK', StaffEmail='$StaffEmail', StaffAlamat='$StaffAlamat', PosisiStaff='$PosisiStaff' WHERE StaffID='$idstaff'";
	$edit = mysqli_query($koneksi, $query);
	if($edit){
		?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h6><i class="fas fa-check"></i><b> Success Update!</b></h6>
		</div>
		<?php
		header('location:index.php?page=staff');
		}else{
		?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h6><i class="fas fa-ban"></i><b> Gagal!</b></h6>
			</div>
			<?php
		header('location:index.php?page=staff');
	}
}


//menghapus data Staff
if(isset($_POST['hapusstaff'])){
	$idstaff = $_POST['idstaff'];
	
	$query = "DELETE FROM `tabel_staff` WHERE StaffID = '$idstaff'";
	$hapus = mysqli_query($koneksi,$query);
	if($hapus){
		?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h6><i class="fas fa-check"></i><b> Data Terhapus !</b></h6>
		</div>
	<?php
		header('location:index.php?page=staff');
		}else{
		?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h6><i class="fas fa-ban"></i><b> Gagal!</b></h6>
		</div>
		<?php
		header('location:index.php?page=staff');
	}
}
?>