<?php
require_once 'koneksi.php';
try {
    $sql = "SELECT u.username, p.id_post,p.id_user, p.post,p.gambar_post,p.tgl_post_dibuat , b.photo
    FROM `post` p  
    JOIN `users` u
    JOIN `biodata` b
    WHERE u.id_user = p.id_user AND u.id_user = b.id_user ORDER BY p.tgl_post_dibuat DESC";
    $qPost = $database_connection->prepare($sql);
    $qPost->execute();
} catch (PDOException $x) {
    die($x->getMessage());
}
function getJumlahKomen($database_connection, $idPost)
{

    try {
        $sql = "SELECT COUNT(komentar) AS jumlahKomen FROM komentar_post WHERE `id_post` = ?";
        $q = $database_connection->prepare($sql);
        $q->execute([$idPost]);
    } catch (PDOException $x) {
        die($x->getMessage());
    }
    foreach ($q as $data) {
        $jumlahKomen = $data['jumlahKomen'];
    }
    return $jumlahKomen;
}

