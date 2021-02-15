<?php
require_once 'koneksi.php';

$id = $_POST["id"];
$post = $_POST["post"];
$tgl = $_POST["tgl_post_dibuat"];
$namaImage = $_FILES['gambar_post']['name'];
$tmpNameImage = $_FILES['gambar_post']['tmp_name'];
// print_r($_POST);
// die;
if (isset($_POST['posting'])) {
    try {
        if ($namaImage == '') {
            $qUser = $database_connection->prepare("INSERT INTO `post` (`id_user`, `post`, `tgl_post_dibuat`) VALUES (?, ?, ?);");
            $qUser->execute([$id,  $post, $tgl]);
            header("Location: ../home.php");
        } else {
            $qUser = $database_connection->prepare("INSERT INTO `post` (`id_user`, `gambar_post`, `post`, `tgl_post_dibuat`) VALUES (?, ?, ?, ?);");
            $qUser->execute([$id, 'images/' . $id . '-' . strtotime($tgl) . '-' . $namaImage, $post, $tgl]);
            move_uploaded_file($tmpNameImage, '../images/' . $id . '-' . strtotime($tgl) . '-' . $namaImage);
            header("Location: ../home.php");
        }
    } catch (PDOException $x) {
        echo $x->getMessage();
    }
}
