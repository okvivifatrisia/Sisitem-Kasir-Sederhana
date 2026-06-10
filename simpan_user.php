<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil data dari form tambah_user
    $user_id  = mysqli_real_escape_string($koneksi, $_POST['user_id']); // Menangkap teks 'usr003'
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']); // Polosan tanpa enkripsi
    $role     = mysqli_real_escape_string($koneksi, $_POST['role']);

    // Query INSERT (Nama kolom tetap menyesuaikan struktur tabel DB kamu yang HURUF BESAR)
    $query = "INSERT INTO users (USER_ID, NAMA, USERNAME, PASSWORD, ROLE) 
              VALUES ('$user_id', '$nama', '$username', '$password', '$role')";

    // Eksekusi query
    $eksekusi = mysqli_query($koneksi, $query);

    if ($eksekusi) {
        echo "<script>
                alert('User baru dengan ID " . $user_id . " berhasil ditambahkan!');
                window.location.href='kelola_user.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan user! Error: " . mysqli_error($koneksi) . "');
                window.location.href='tambah_user.php';
              </script>";
    }

} else {
    header("Location: kelola_user.php");
    exit;
}
?>