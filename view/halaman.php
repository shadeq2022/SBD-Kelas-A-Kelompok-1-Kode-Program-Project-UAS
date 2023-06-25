<?php
error_reporting(0);
@session_start();
switch ($_GET['page']) {

    case "home":
        include 'view/home/dashboard.php';
        break;

    case "hp":
        include 'view/master/data_hp.php';
        break;

    case "costumer":
        include 'view/master/data_costumer.php';
        break;

    case "staff":
        include 'view/master/data_staff.php';
        break;

    case "inv_utama":
        include 'view/master/data_inv_utama.php';
        break;

    case "detail_inv_utama":
        include 'view/master/detail_inv_utama.php';
        break;

    case "view_detail":
        include 'view/master/view_detail.php';
        break;
        
    case "exit":
        include 'proses/logout.php';
        exit();
        break;

    default:
        if (!empty($_GET['page'])) {
            echo "<script> $(document).ready(function(){ alertify.error('Halaman Yang anda minta tidak tersedia!'); }); </script>";
            include_once 'error/404.php';
        } else {
            include_once 'dashboard.php';
        }
        break;
}
?>