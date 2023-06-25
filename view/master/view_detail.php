
<!-- css -->
<link rel="icon" href="favicon.ico">
<link rel="icon" href="icon.ico" type="image/ico">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/style-manual.css" rel="stylesheet">
<link href="css/ruang-admin.min.css" rel="stylesheet">


<?php
include('koneksi.php');

?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Invoice</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="./">Home</a>
      </li>
      <li class="breadcrumb-item">Invoice Utama</li>
      <li class="breadcrumb-item active" aria-current="page">Detail Invoice</li>
    </ol>
  </div>
  <div class="card">
  <div class="card-body">

<?php
$idutama = $_GET['id'];
if(!isset($_GET['id'])){
    echo '<script>alert("Data Tidak Di Temukan");history.go(-1);</script>';
}


$liatcust = mysqli_query($koneksi,"SELECT * FROM (invoice_utama INNER JOIN tabel_costumer ON invoice_utama.CostumerID=tabel_costumer.CostumerID)
                                INNER JOIN tabel_staff ON invoice_utama.StaffID=tabel_staff.StaffID WHERE id_inv='$idutama'");

$checkdb = mysqli_fetch_array($liatcust);

?>
<div class="text-right">
    <a href="index.php?page=inv_utama">
        <button class="btn btn-primary mb-2">
            <i class="fa fa-arrow-left fa-xs"></i> Kembali
        </button>
    </a>
</div>


<div class="row">
    <div class="col-sm-6">
    <h6 class="mb-1"><strong>Invoice: <?php echo $checkdb['NoInvoice'] ?> </strong></h6>
        <p class=" mb-0">Kasir : <?php echo $checkdb['NamaStaff'] ?></p>
        <p class=" mb-0">Tanggal : <?php echo $checkdb['Date'] ?></p>
    </div>
    <div class="col-sm-6">
        <p class=" mb-0">Nama : <?php echo $checkdb['CostumerName'] ?></p>
        <p class=" mb-0">Telepon : <?php echo $checkdb['CostumerPhone'] ?></p>
        <p class=" mb-0">Alamat : <?php echo $checkdb['CostumerAddress'] ?></p>
    </div>
</div>
<table class="table table-sm table-bordered dt-responsive nowrap border-0" width="100%">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nama HP</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                 $no=1;
                                 $data_produk=mysqli_query($koneksi,"SELECT * FROM detail_invoice t, tabel_hp p
                                 WHERE id_inv='$idutama' and t.id_hp=p.id_hp ORDER BY t.id_hp ASC");
                                 while($d=mysqli_fetch_array($data_produk)){
                                    $total = $d['quantity']*$d['harga_hp'];
                                    ?>
                                    
                                    <tr>
                                        <td style="border: 1px solid #dee2e6;"><?php echo $no++ ?></td>
                                        <td style="border: 1px solid #dee2e6;"><?php echo $d['nama_hp'] ?></td>
                                        <td style="border: 1px solid #dee2e6;"><?php echo $d['quantity'] ?></td>
                                        <td style="border: 1px solid #dee2e6;">Rp.<?php echo ribuan($d['harga_hp']) ?></td>
                                        <td style="border: 1px solid #dee2e6;">Rp.<?php echo ribuan($total) ?></td>
                                    </tr>		
                        <?php }?>
					</tbody>
                    <tr>
                        <th class="d-none d-md-block border-0 bg-white"></th>
                        <th class="border-0 bg-white"></th>
                        <th class="border-0 bg-white"></th>
                        <th class="text-right bg-light" style="border: 1px solid #dee2e6;font-weight:600;">Total :</th>
                        <th class="bg-light" style="border: 1px solid #dee2e6;font-weight:600;">Rp.<?php echo ribuan($checkdb['totalbeli']) ?></th>
                    </tr>
                    <tr>
                        <th class="d-none d-sm-block d-md-block border-0 bg-white"></th>
                        <th class="border-0 bg-white"></th>
                        <th class="border-0 bg-white"></th>
                        <th class="text-right bg-light" style="border: 1px solid #dee2e6;font-weight:600;">Bayar :</th>
                        <th class="bg-light" style="border: 1px solid #dee2e6;font-weight:600;">Rp.<?php echo ribuan($checkdb['pembayaran']) ?></th>
                    </tr>
                    <tr>
                        <th class="d-none d-sm-block d-md-block border-0 bg-white"></th>
                        <th class="border-0 bg-white"></th>
                        <th class="border-0 bg-white"></th>
                        <th class="text-right bg-light" style="border: 1px solid #dee2e6;font-weight:600;">Kembalian :</th>
                        <th class="bg-light" style="border: 1px solid #dee2e6;font-weight:600;">Rp.<?php echo ribuan($checkdb['kembalian']) ?></th>
                    </tr>
                </table>
                <p class="small mb-0" style="font-weight:600;">Catatan :</p>
                <p class="small text-muted"><?php echo $checkdb['catatan'] ?></p>

</div>
</div>

<!-- Modal Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah kamu yakin ingin keluar?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                <a href="models/proses_logout.php" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>



<?php include 'template/footer.php';?>

<!-- List library javascript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>
