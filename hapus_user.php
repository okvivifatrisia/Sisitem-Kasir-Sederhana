<?php
include 'koneksi.php';

// Memastikan parameter ID ada di URL
if (isset($_GET['id'])) {
    
    // Ambil ID dan amankan dari SQL Injection
    $user_id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Query untuk menghapus data berdasarkan USER_ID
    $query = "DELETE FROM users WHERE USER_ID = '$user_id'";
    
    // Eksekusi query
    $eksekusi = mysqli_query($koneksi, $query);

    if ($eksekusi) {
        echo "<script>
                alert('User berhasil dihapus!');
                window.location.href='kelola_user.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus user! Error: " . mysqli_error($koneksi) . "');
                window.location.href='kelola_user.php';
              </script>";
    }

} else {
    // Jika diakses tanpa ID, kembalikan ke halaman utama
    header("Location: kelola_user.php");
    exit;
}
?>