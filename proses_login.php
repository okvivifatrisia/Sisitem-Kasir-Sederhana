<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$role     = $_POST['role'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM USERS
     WHERE USERNAME='$username'
     AND PASSWORD='$password'
     AND ROLE='$role'"
);

$data = mysqli_fetch_assoc($query);

if ($data) {

    $_SESSION['user_id'] = $data['USER_ID'];
    $_SESSION['nama'] = $data['NAMA'];
    $_SESSION['username'] = $data['USERNAME'];
    $_SESSION['role'] = $data['ROLE'];

    if ($data['ROLE'] == 'admin') {
        header("Location: admin.php");
    } elseif ($data['ROLE'] == 'kasir') {
        header("Location: kasir.php");
    }

    exit();

} else {

    echo "
    <script>
        alert('Username, Password, atau Role Salah!');
        window.location='login.php';
    </script>
    ";
}
?>