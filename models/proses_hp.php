<?php
//menambah data HP
include 'koneksi.php'; // Memasukkan file koneksi.php
if(isset($_POST['addhp'])) {
    $nama_hp = $_POST['nama_hp'];
    $harga_hp = $_POST['harga_hp'];
	$stock = $_POST['stock'];
    $description = $_POST['description'];

    // Cek data
    $query = "SELECT * FROM `tabel_hp` WHERE `nama_hp` LIKE '$nama_hp'";
    $hasil = mysqli_query($koneksi, $query);
    $jumlah = mysqli_num_rows($hasil);

    if ($jumlah == 0) {
        $query = "INSERT INTO `tabel_hp` (`nama_hp`, `harga_hp`, `stock`, `description`) VALUES ('$nama_hp', '$harga_hp', '$stock', '$description')";
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
            header('location:index.php?page=hp');
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h6><i class="fas fa-ban"></i><b> Gagal!</b></h6>
            </div>
            <?php
            header('location:index.php?page=hp');
        }
    }
	else {
		?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h6><i class="fas fa-ban"></i><b> Gagal! HP yang anda masukkan sudah ada!</b></h6>
		</div>
		<?php
		header('location:index.php?page=hp');
	}
}

//update Data HP
if(isset($_POST['edithp'])){
	$idhp = $_POST['idhp'];
	$nama_hp = $_POST['nama_hp'];
    $harga_hp = $_POST['harga_hp'];
	$stock = $_POST['stock'];
    $description = $_POST['description'];

	// Query update data
	$query = "UPDATE tabel_hp SET nama_hp='$nama_hp', harga_hp='$harga_hp', stock='$stock', description='$description' WHERE id_hp='$idhp'";
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
		header('location:index.php?page=hp');
		}else{
		?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h6><i class="fas fa-ban"></i><b> Gagal!</b></h6>
			</div>
			<?php
		header('location:index.php?page=hp');
	}
}


//menghapus data HP
if(isset($_POST['hapushp'])){
	$idhp = $_POST['idhp'];
	
	$query = "DELETE FROM `tabel_hp` WHERE id_hp = '$idhp'";
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
		header('location:index.php?page=hp');
		}else{
		?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h6><i class="fas fa-ban"></i><b> Gagal!</b></h6>
		</div>
		<?php
		header('location:index.php?page=hp');
	}
}
?>

