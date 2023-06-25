<?php

// Memeriksa apakah form login sudah disubmit
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa keberadaan username dan password dalam tabel staff
    $query = mysqli_query($koneksi,"SELECT * FROM tabel_staff WHERE StaffEmail = '$username' AND PosisiStaff = '$password'");
    $hasil=mysqli_fetch_array($query);
    $result = mysqli_num_rows($query);

    if ($result > 0) {
        // Login berhasil
        session_start();
        $_SESSION['log'] = 'true';
        $_SESSION['namayanglogin'] = $hasil['NamaStaff'];
        header("Location: http://localhost/penjualanhp_two/index.php?page=home"); // Ubah lokasi dengan halaman dashboard yang sesuai
        exit();
    } else {
        // Login gagal
        $error_message = "Username atau password salah.";
    }
}
?>