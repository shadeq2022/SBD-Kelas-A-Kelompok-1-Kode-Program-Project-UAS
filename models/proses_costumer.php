<?php
//menambah data Costumer
include 'koneksi.php'; // Memasukkan file koneksi.php
if(isset($_POST['addcostumer'])) {
    $CostumerName = $_POST['CostumerName'];
    $CostumerJK = $_POST['CostumerJK'];
    $CostumerPhone = $_POST['CostumerPhone'];
    $CostumerEmail = $_POST['CostumerEmail'];
    $CostumerAddress = $_POST['CostumerAddress'];

    // Cek data
    $query = "SELECT * FROM `tabel_costumer` WHERE `CostumerName` LIKE '$CostumerName'";
    $hasil = mysqli_query($koneksi, $query);
    $jumlah = mysqli_num_rows($hasil);

    if ($jumlah == 0) {
        $query = "INSERT INTO `tabel_costumer` (`CostumerName`, `CostumerJK`, `CostumerPhone`, `CostumerEmail`, `CostumerAddress`) VALUES ('$CostumerName', '$CostumerJK', '$CostumerPhone', '$CostumerEmail', '$CostumerAddress')";
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
            header('location:index.php?page=costumer');
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h6><i class="fas fa-ban"></i><b> Gagal!</b></h6>
            </div>
            <?php
            header('location:index.php?page=costumer');
        }
    }
	else {
		?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h6><i class="fas fa-ban"></i><b> Gagal! Nama costumer yang anda masukkan sudah ada!</b></h6>
		</div>
		<?php
		header('location:index.php?page=costumer');
	}
}

//update Data Costumer
if(isset($_POST['editcostumer'])){
	$idcos = $_POST['idcos'];
	$CostumerName = $_POST['CostumerName'];
    $CostumerJK = $_POST['CostumerJK'];
    $CostumerPhone = $_POST['CostumerPhone'];
    $CostumerEmail = $_POST['CostumerEmail'];
    $CostumerAddress = $_POST['CostumerAddress'];

	// Query update data
	$query = "UPDATE tabel_costumer SET CostumerName='$CostumerName', CostumerJK='$CostumerJK', CostumerPhone='$CostumerPhone', CostumerEmail='$CostumerEmail', CostumerAddress='$CostumerAddress' WHERE CostumerID='$idcos'";
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
		header('location:index.php?page=costumer');
		}else{
		?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h6><i class="fas fa-ban"></i><b> Gagal!</b></h6>
			</div>
			<?php
		header('location:index.php?page=costumer');
	}
}


//menghapus data HP
if(isset($_POST['hapuscostumer'])){
	$idcos = $_POST['idcos'];
	
	$query = "DELETE FROM `tabel_costumer` WHERE CostumerID = '$idcos'";
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
		header('location:index.php?page=costumer');
		}else{
		?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h6><i class="fas fa-ban"></i><b> Gagal!</b></h6>
		</div>
		<?php
		header('location:index.php?page=costumer');
	}
}
?>