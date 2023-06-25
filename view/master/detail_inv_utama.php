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
    <h1 class="h3 mb-0 text-gray-800">Invoice Utama</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="./">Home</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Invoice Utama</li>
    </ol>
  </div>
  <div class="card">
  <div class="card-body">

  <?php
// JOIN 3 tabel
$idutama = $_GET['id'];

$hasil = mysqli_query($koneksi, "SELECT * FROM (invoice_utama INNER JOIN tabel_costumer 
                                ON invoice_utama.CostumerID=tabel_costumer.CostumerID)
                                INNER JOIN tabel_staff ON invoice_utama.StaffID=tabel_staff.StaffID WHERE id_inv='$idutama'")
                                or die(mysqli_error($koneksi));

$data = mysqli_fetch_array($hasil);

// Ambil data costumer berdasarkan CostumerID
$costumerID = $data['CostumerID'];
$costumername = $data['CostumerName'];
$costumerhp = $data['CostumerPhone'];
$costumeraddr = $data['CostumerAddress'];

// Ambil data staff berdasarkan StaffID
$staffID = $data['StaffID'];
$staff = $data['NamaStaff'];

?>


<?php
$bln = date('m'); $thn = date('Y');
$bikin_nota = mysqli_query($koneksi, "SELECT max(NoInvoice) as kodeTerbesar11 FROM invoice_utama WHERE month(Date)='$bln' AND year(Date)='$thn'");
$datanya = mysqli_fetch_array($bikin_nota);
$kodenota= $datanya['kodeTerbesar11'];
$tgl = date("m/y");
$huruf = "INV-";
$urutan = (int) substr($kodenota, 4, 3);

$kodeCart = $huruf . sprintf("%03s", $urutan) . "/" . $tgl;
?>


<div class="row mt-3">
<div class="col-lg-3 mb-3">
    <div class="card small mb-3" >
        <div class="card-header p-2">
            <div class="card-tittle"><i class="far fa-file mr-1"></i> Informasi Invoice</div>
        </div>
        <div class="card-body p-2">
            <div class="row">
                <div class="col-4 mb-2 text-right pt-1 pr-1">No. Invoice : </div>
                <div class="col-8 mb-2 pl-0">
                    <input type="text" class="form-control form-control-sm bg-white" value="<?php echo $kodeCart ?>" readonly>

                    <input type="hidden" class="form-control form-control-sm bg-white"  value="<?php echo $idutama?>"  readonly>
                </div>
                <div class="col-4 mb-2 text-right pt-1 pr-1">Tanggal : </div>
                <div class="col-8 mb-2 pl-0">
                    <input type="text" class="form-control form-control-sm bg-white" name="tanggal"  value="<?php echo date("Y-m-d"); ?>" readonly>
                </div>
                <div class="col-4 text-right pt-1 pr-1">Staff : </div>
                <div class="col-8 pl-0">
                    <input type="text" class="form-control form-control-sm bg-white" value="<?php echo $staff;?>" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="card small mb-3">
        <div class="card-header p-2">
            <div class="card-tittle"><i class="far fa-user mr-1"></i> Informasi Costumer 
            </div>
        </div>
        <div class="card-body p-2">

            <!-- Informasi Costumer -->
    
            <div>
            <div class="row">
            <div class="col-4 mb-2 text-right pt-1 pr-1">Costumer : </div>
                <div class="col-8 mb-2 pl-0">
                    <input type="text" class="form-control form-control-sm bg-white" value="<?php echo $costumername?>" readonly>
                </div>
                <div class="col-4 mb-2 text-right pt-1 pr-1">Telepon : </div>
                <div class="col-8 mb-2 pl-0">
                    <input type="text" class="form-control form-control-sm bg-white" id="CostumerPhone"  value="<?php echo $costumerhp;?>" readonly>
                </div>
                <div class="col-4 text-right pt-1 pr-1">Alamat : </div>
                <div class="col-8 pl-0">
                    <input type="text" class="form-control form-control-sm bg-white" id="CostumerAddress" value="<?php echo $costumeraddr;?>" readonly>
                </div>
            </div>
            </div><!-- End informasi pelanggan -->
        </div>
    </div>
</div>

<!-- Tambah cart -->
<div class="col-lg-9" id="print">
    <form method="post">
    <div class="row print-none">
        <div class="col-12 col-lg-4 m-pr-0">
        
        <?php 
            $barang=mysqli_query($koneksi, "SELECT * FROM tabel_hp ORDER BY id_hp ASC");
            $jsArray = "var harga_hp = new Array();";
            $jsArray3 = "var id_hp = new Array();";
            $jsArray4 = "var stock = new Array();";
            ?>
            <label class="mb-1">Nama HP</label>
            <div class="input-group">
                <select class="form-control form-control-sm" id="pilih"
                onchange='changeValue(this.value)' aria-describedby="basic-addon2" required>
                <option>Pilih HP</option>
                <?php  
                if(mysqli_num_rows($barang)) {
                 while($row_brg= mysqli_fetch_array($barang)) {?>
                        <option value="<?php echo $row_brg["id_hp"]?>">  <?php echo $row_brg["nama_hp"]?> 
                        <?php $jsArray .= "harga_hp['" . $row_brg['id_hp'] . "'] = {harga_hp:'" . addslashes($row_brg['harga_hp']) . "'};";
                                $jsArray3 .= "id_hp['" . $row_brg['id_hp'] . "'] = {id_hp:'" . addslashes($row_brg['id_hp']) . "'};";
                                $jsArray4 .= "stock['" . $row_brg['id_hp'] . "'] = {stock:'" . addslashes($row_brg['stock']) . "'};"; } ?>
                <?php } ?></option>
                
                 </select>
                 
                </div>
                
        </div>
        <input type="hidden" name="id_hp" id="id_hp" readonly>
        <div class="col-6 col-lg-3 m-pr-0">
            <label class="mb-1">Harga</label>
            <input type="text" class="form-control form-control-sm bg-white" id="harga_hp"
             onchange="total()">
        </div>
        <div class="col-6 col-lg-1 pr-0">
            <label class="mb-1">Stock</label>
            <input type="text" class="form-control form-control-sm bg-white" id="stock" readonly>
        </div>
        <div class="col-6 col-lg-1 m-pr-0">
            <label class="mb-1">Qty</label>
            <input type="number" class="form-control form-control-sm" id="quantity" onchange="total()"
            name="quantity" placeholder="0" required>
        </div>
        <div class="col-lg-3">
            <label class="mb-1">Subtotal</label>
            <div class="input-group">
                <input type="number" class="form-control form-control-sm bg-white" id="subtotal" name="tambahcuy" onchange="total()" readonly>
            <div class="input-group-append">
            <button class="btn btn-success btn-sm border-0" type="submit"><i class="fa fa-plus"></i> Submit</button>
            </div>
            </div>
        </div>
    </div><!-- end row -->
</form>

<?php

if(isset($_POST['tambahcuy'])){
    $id_hp  = $_POST['id_hp'];
    $quantity  = $_POST['quantity'];
    $cekBarang = mysqli_query($koneksi, "SELECT * FROM tabel_hp WHERE id_hp='$id_hp'");
    $stocknya  = mysqli_fetch_array($cekBarang);
    $stock     = $stocknya['stock'];
    $sisa      = $stock-$quantity;
    
    if ($stock < $quantity) {
    echo '<script>alert("Oops! Jumlah pengeluaran lebih besar dari stok ...");window.location="index.php?page=detail_inv_utama"</script>';
    }   
    else{
     $insert = mysqli_query($koneksi, "INSERT INTO detail_invoice (id_hp,quantity,id_inv) VALUES ('$id_hp','$quantity','$idutama')");
      if($insert){
        $upstok = mysqli_query($koneksi, "UPDATE tabel_hp SET stock='$sisa' WHERE id_hp='$id_hp'");
        echo '<script>window.location="index.php?page=detail_inv_utama&id='.$idutama.'"</script>';
     }
    else { echo '<script>alert("ERROR.");history.go(-1);</script>';}
    }
    }
?>

<!-- View tabel setelah barang diinput/ tambah ke cart -->

    <table class="table border border-primary table align-items-center table-sm table-bordered dt-responsive nowrap print-none" id="cart" width="100%">
                        <thead class="thead-light  ">
                        <tr >
                            <th>No.</th>
                            <th>Nama HP</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                           
                                $subtotalcart1= 0;
                                $no=1;
                                $data_hp=mysqli_query($koneksi, "SELECT * FROM detail_invoice INNER JOIN tabel_hp
                                                                ON detail_invoice.id_hp=tabel_hp.id_hp AND id_inv= $idutama ORDER BY id_inv ASC");

                                while ($d = mysqli_fetch_array($data_hp)) {
                                    $iddetail = $d['id_inv'];//butuh id_inv utk form hapus tabel
                                    $subtotalcart = $d['harga_hp'] * $d['quantity'];
                                    $subtotalcart1 += $subtotalcart;
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $d['nama_hp'] ?></td>
                                        <td>Rp.<?php echo ribuan($d['harga_hp']) ?></td>
                                        <td><?php echo $d['quantity'] ?></td>
                                        <td>Rp.<?php echo ribuan($subtotalcart) ?></td>
                                        <td>
                                            <!-- menghapus tabel detail invoice dengan klik hapus di tabel -->
                                            <form method="post" class="d-inline-block">
                                            <input type="hidden" name="idhp" value="<?php echo $d['id_hp'] ?>">
                                            <input type="hidden" name="idinv" value="<?php echo $d['id_inv'] ?>">
                                                <input type="hidden" name="jml" value="<?php echo $d['quantity'] ?>">
                                                <button type="submit" name="upone" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-xs mr-1"></i>Hapus</a></button>
                                            </form>
                                        </td>
                                    </tr>		
                        <?php 
                        if(isset($_POST['upone'])){ //Pd saat tombol hapus ditekan, maka stok hp akn diupdate lgi di tabel hp & data jg terhapus
                        
                            $idkeranjang = $_POST['idinv'];
                            $idhape = $_POST['idhp'];
                            $jml = $_POST['jml'];
                        
                            $cekBarang1 = mysqli_query($koneksi, "SELECT * FROM tabel_hp WHERE id_hp='$idhape'");
                            $stocknya1  = mysqli_fetch_array($cekBarang1);
                            $stockk     = $stocknya1['stock'];
                            $sisa1    =$stockk+$jml; //buat variabel yg menampung stok yg akn ditambah dgn kuantitas semula
                            
                            if ($stockk < $jml) {
                        
                            }
                            //proses    
                            else{
                                $insert1 = mysqli_query($koneksi, "UPDATE tabel_hp SET stock='$sisa1' WHERE id_hp='$idhape'");
                                    if($insert1){
                                        //proses hapus
                                        $hapus_data = mysqli_query($koneksi, "DELETE FROM detail_invoice WHERE id_inv ='$idkeranjang' AND id_hp = '$idhape'");
                                        echo '<script>window.location="index.php?page=detail_inv_utama&id='.$idutama.'"</script>';
                                    } else {
                                        echo '<script>alert("ERROR.");history.go(-1);</script>';
                                    }
                            }
                            }
                    }?>
					</tbody>
                </table>
                <!-- grand total bg biru -->
                
                <div class="bg-total p-2 text-center print-none">
                    Rp.<?php echo ribuan($subtotalcart1) ?>
                </div>
                <form method="POST" class="mt-2 print-none">
                    <div class="row">
                        <div class="col-lg-7 mb-2">
                            <textarea name="catatan" class="form-control form-control-sm" id="catatan_baru"
                            placeholder="Catatan Transaksi (Jika Ada)"cols="10" rows="5" onchange="new_catatan()"></textarea>
                        </div>
                        <div class="col-lg-5 mb-2 print-none">
                            <div class="row">
                            <div class="col-5 mb-2 text-right pt-1 pr-2" style="font-weight:500;">Pembayaran :</div>
                                <div class="col-7 mb-2 pl-0">
                                <?php    
                                $data_detail = mysqli_query($koneksi, "SELECT * FROM invoice_utama 
                                INNER JOIN detail_invoice ON invoice_utama.id_inv = detail_invoice.id_inv 
                                WHERE invoice_utama.id_inv = $idutama");


                                $d = mysqli_fetch_array($data_detail);
                                $iddetail = $d['id_inv'];//butuh id_inv utk update data ke invoice_utama
                                    ?>
                                  
                                    <input type="hidden" name="id_inv" value="<?php echo $iddetail ?>">
                                    <input type="hidden" name="totalbeli" value="<?php echo $subtotalcart1 ?>" id="hargatotal">
                                    <input type="number" class="form-control form-control-sm bg-white" placeholder="0"
                                    name="pembayaran" id="bayarnya" onchange="totalnya()" required>
                                </div>
                                <div class="col-5 text-right pt-1 pr-2" style="font-weight:500;">Kembalian :</div>
                                <div class="col-7 pl-0">
                                    <input type="text" class="form-control form-control-sm bg-white" 
                                    placeholder="0" name="kembalian" id="total1" readonly>
                            </div>
                            </div>
                            <div class="col-12 text-right pr-0 mt-2">
                            
                                <button type="reset" class="btn btn-danger btn-sm px-3">
                                    <i class="fa fa-trash-restore-alt mr-1"></i> Reset
                                </button>
                                <button type="submit" name="save" class="btn btn-primary btn-sm px-3">
                                    <i class="far fa-file mr-1"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </div><!-- end row -->
                </form>
                </div><!-- Akhir dari cart dan print -->
</div><!-- end col-lg-9 -->

</div><!-- end row -->
<?php 
if(isset($_POST['save'])){
    $id_inv= $_POST['id_inv'];
    $pembayaran= $_POST['pembayaran'];
    $kembalian = $_POST['kembalian'];
    $totalbeli = $_POST['totalbeli'];
    $catatan = htmlspecialchars($_POST['catatan']);

     $update_inv_utama = mysqli_query($koneksi, "UPDATE invoice_utama
     SET catatan = '$catatan', pembayaran = '$pembayaran', kembalian = '$kembalian', totalbeli = '$totalbeli'
     WHERE id_inv = $idutama");
    
    if($update_inv_utama){
        echo '<script>window.location="index.php?page=inv_utama"</script>';
    } else {
        echo '<script>window.location="index.php?page=detail_inv_utama&id='.$idutama.'"</script>';
    }

}
?>

  </div>
  
</div>
        
<script type="text/javascript">
      <?php echo $jsArray,$jsArray3,$jsArray4,$jsArrayp,$jsArrayp1,$jsArrayp2; ?>
    function changeValue(id_hp) {

      document.getElementById("harga_hp").value = harga_hp[id_hp].harga_hp;
      document.getElementById("id_hp").value = id_hp;
      document.getElementById("stock").value = stock[id_hp].stock;
      console.log(id_hp[id_hp])
    };

function total() {
   var harga =  parseInt(document.getElementById('harga_hp').value);
   var jumlah_beli =  parseInt(document.getElementById('quantity').value);
   var jumlah_harga = harga * jumlah_beli;
    document.getElementById('subtotal').value = jumlah_harga;
    //document.getElementById("myCartNew").submit();
  }
    
  function totalnya() {
   var harga =  parseInt(document.getElementById('hargatotal').value);
   var pembayaran =  parseInt(document.getElementById('bayarnya').value);
   var kembali = pembayaran - harga;
    document.getElementById('total1').value = kembali;
    document.getElementById('total2').innerHTML = kembali;
    document.getElementById('bayarnya1').innerHTML = pembayaran;
  }

    function new_catatan() {
    var c = document.getElementById("catatan_baru").value;
    document.getElementById("new_catatan").innerHTML = c;
    }
  </script>

<script>

</script>
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
</div>
</div>

<?php include 'template/footer.php';?>

<!-- List library javascript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>




  <!--Row-->