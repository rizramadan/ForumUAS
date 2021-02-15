<?php
session_start();
require_once 'koneksi.php';

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  try {
    $sqlInsertUser = "SELECT `id_user` FROM `users` WHERE `username` = ? AND `password` = SHA1(?)";
    $q = $database_connection->prepare($sqlInsertUser);
    $q->execute([$username, $password]);
    foreach ($q as $data) {
      $idUser = $data['id_user'];
    }
    if ($q->rowCount() == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['id'] = $idUser;
      
      echo "<script>
      alert('Berhasil Login');
      window.location.replace('../home.php');
      </script>";
      return;
    } else {
      echo "<script>
      alert('Email atau password salah!');
      window.location.replace('../login.php');
      </script>";
    }
  } catch (PDOException $x) {
    echo $x->getMessage();
  }
}
