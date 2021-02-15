<?php
require_once "koneksi.php";
$nama_depan = $_POST["namadepan"];
$nama_belakang = $_POST["namabelakang"];
$jns_kelamin = $_POST["jeniskelamin"];
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];

$notel = $_POST["notel"];
$alamat = $_POST["alamat"];



if (isset($_POST['register'])) {
  try {
    $qUser = $database_connection->prepare("INSERT INTO `users` ( `nama_depan`, `nama_belakang`, `jns_kelamin`, `email`, `username`, `password`, `no_tel`, `alamat`) VALUES (?, ?, ?, ?, ?, SHA1(?), ?, ?);
      INSERT INTO `biodata` (`id_user`, `no_tel`, `alamat`) VALUES ( LAST_INSERT_ID(), ?, ?);");
    $qUser->execute([$nama_depan, $nama_belakang, $jns_kelamin, $email, $username, $password, $notel, $alamat, $notel, $alamat]);
    echo "<script>
            alert('Berhasil, silahkan login');
            window.location.replace('../login.php');
            </script>";
  } catch (PDOException $x) {
    echo $x->getMessage();
  }
}
