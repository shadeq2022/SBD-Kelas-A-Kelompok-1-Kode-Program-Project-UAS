<?php 
 
$koneksi = mysqli_connect("localhost","root","","penjualanhp");
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
date_default_timezone_set('Asia/Jakarta');   
error_reporting(0);

?>