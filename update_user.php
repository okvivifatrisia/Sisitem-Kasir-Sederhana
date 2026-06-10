<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil data dari form edit_user
    $user_id  = mysqli_real_escape_string($koneksi, $_POST['user_id']);
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $role     = mysqli_real_escape_string($koneksi, $_POST['role']);
    $password = $_POST['password']; 

    // Cek apakah kolom password baru diisi oleh admin
    if (!empty($password)) {
        // TANPA ENKRIPSI (Sesuai dengan file login kamu yang polosan)
        $password_bersih = mysqli_real_escape_string($koneksi, $password);
        
        $query = "UPDATE users SET 
                    NAMA = '$nama', 
                    USERNAME = '$username', 
                    PASSWORD = '$password_bersih', 
                    ROLE = '$role' 
                  WHERE USER_ID = '$user_id'";
    } else {
        // Jika password baru dikosongkan, jangan update kolom PASSWORD
        $query = "UPDATE users SET 
                    NAMA = '$nama', 
                    USERNAME = '$username', 
                    ROLE = '$role' 
                  WHERE USER_ID = '$user_id'";
    }

    // Eksekusi query ke database
    $eksekusi = mysqli_query($koneksi, $query);

    if ($eksekusi) {
        echo "<script>
                alert('Data user berhasil diperbarui!');
                window.location.href='kelola_user.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menyimpan data! Error: " . mysqli_error($koneksi) . "');
                window.location.href='edit_user.php?id=" . $user_id . "';
              </script>";
    }

} else {
    header("Location: kelola_user.php");
    exit;
}
?>