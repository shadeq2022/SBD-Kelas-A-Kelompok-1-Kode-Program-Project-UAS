

<?php
//menambah data invoice utama
include 'koneksi.php'; // Memasukkan file koneksi.php

if (isset($_POST['addinvoiceutama'])) {
    $NoInvoice = $_POST['NoInvoice'];
    $Date = $_POST['Date'];
    $CostumerID = $_POST['CostumerID'];
    $StaffID = $_POST['StaffID'];

    // Cek data
    $query = "SELECT * FROM `invoice_utama` WHERE `NoInvoice` LIKE '$NoInvoice'";
    $hasil = mysqli_query($koneksi, $query);
    $jumlah = mysqli_num_rows($hasil);

    if ($jumlah == 0) {
        $query = "INSERT INTO `invoice_utama` (`NoInvoice`, `Date`, `CostumerID`, `StaffID`) VALUES ('$NoInvoice', '$Date', '$CostumerID', '$StaffID')";
        $tambah = mysqli_query($koneksi, $query);
		$id = mysqli_insert_id($koneksi);

        if ($tambah) {
            // Redirect ke halaman detail_inv_utama
			// echo $id;
            header('Location: http://localhost/penjualanhp_two/index.php?page=detail_inv_utama&id='.$id);
            exit();
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h6><i class="fas fa-ban"></i><b> Gagal!</b></h6>
            </div>
            <?php
            header('location:index.php?page=inv_utama');
            exit();
        }
    } else {
        ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h6><i class="fas fa-ban"></i><b> Gagal! No invoice yang anda masukkan sudah ada!</b></h6>
        </div>
        <?php
        header('location:index.php?page=inv_utama');
        exit();
    }
}

//menghapus data invoice
if(isset($_POST['hapusinvoice'])){
	$idinv = $_POST['idinv'];
	
	$query = "DELETE FROM `invoice_utama` WHERE id_inv = '$idinv'";
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
		header('location:index.php?page=inv_utama');
		}else{
		?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h6><i class="fas fa-ban"></i><b> Gagal!</b></h6>
		</div>
		<?php
		header('location:index.php?page=inv_utama');
	}
}
?>