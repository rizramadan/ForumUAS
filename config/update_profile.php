<?php
require_once 'koneksi.php';
$id = $_POST['id_user'];
$nama_depan = $_POST['namadepan'];
$nama_belakang = $_POST['namabelakang'];
$email = $_POST['email'];
$currentPassword = $_POST['current_password'];
$password = $_POST["password"];
$newPassword = $_POST['new_password'];
$username = $_POST['username'];
$jns_kelamin = $_POST['jeniskelamin'];
$notel = $_POST['notel'];
$alamat = $_POST['alamat'];
$namaFile = $_FILES['photo']['name'];
$tmpName = $_FILES['photo']['tmp_name'];
// print_r($_POST);
// die;

if (isset($_POST['new_password'])) {
    try {
        if ($newPassword != '' || $newPassword != null) {
            if ($currentPassword == sha1($password)) {
                $qChangePassword = $database_connection->prepare("UPDATE `users` SET `password`= SHA1(?) WHERE `id_user` = ?");
                $qChangePassword->execute([$newPassword, $id]);
                echo "<script>
                alert('Profile telah berubah');
                window.location.replace('../home.php');
                </script>";
            } else {
                echo "<script>
            alert('Password tidak sama dengan password sebelumnya');
            window.location.replace('../biodata.php');
            </script>";
            }
        } else {
            echo "<script>
            alert('Profile telah berubah');
            window.location.replace('../home.php');
            </script>";
        }
    } catch (PDOException $err) {
        echo $err->getMessage();
    }
}
try {
    if ($namaFile == '') {
        $q = $database_connection->prepare(
            "UPDATE `users` SET `nama_depan`=?,`nama_belakang`=?,`username`=? WHERE `id_user` = ?;
            UPDATE `biodata` SET `jns_kelamin`=?,`no_tel`=?,`alamat`=? WHERE `id_user` = ?"
        );
        $q->execute([$nama_depan, $nama_belakang, $username, $id,$jns_kelamin, $notel, $alamat, $id]);
    } else {
        $getOldImage = $database_connection->prepare("SELECT `photo` FROM `biodata` WHERE `id_user` = ?");
        $getOldImage->execute([$id]);
        foreach ($getOldImage as $x) {
            $foto = $x['photo'];
        }
        if ($foto != null) {
            unlink('../' . $foto);
        }
        $q = $database_connection->prepare(
            "UPDATE `users` SET `nama_depan`=?,`nama_belakang`=?,`username`=? WHERE `id_user` = ?;
            UPDATE `biodata` SET `jns_kelamin`=?,`no_tel`=?,`alamat`=?,`photo`=? WHERE `id_user` = ?"
        );
        $q->execute([$nama_depan, $nama_belakang, $username, $id,$jns_kelamin, $notel, $alamat,  'images/' . $id . '-' . $namaFile, $id]);
        move_uploaded_file($tmpName, '../images/' . $id . '-' . $namaFile);
    }
} catch (PDOException $err) {
    echo $err->getMessage();
}
