<?php
require_once 'koneksi.php';
$idPost = $_POST['id_post'];
$gambarPost = $_POST['gambar_post'];


if (isset($_POST['delete_post'])) {
    try {
        if ($gambarPost != null) {
            unlink('../' . $gambarPost);
        }
        // $qDeleteLike = "DELETE FROM `like_post` WHERE `like_post`.`id_post` = ?";
        // $deleteLike = $conn->prepare($qDeleteLike);
        // $deleteLike->execute([$idPost]);
        $qDeleteComment = "DELETE FROM `komentar_post` WHERE `komentar_post`.`id_post` = ?";
        $deleteComment = $database_connection->prepare($qDeleteComment);
        $deleteComment->execute([$idPost]);
        $qDeletePost = "DELETE FROM `post` WHERE `post`.`id_post` = ?";
        $deletePost = $database_connection->prepare($qDeletePost);
        $deletePost->execute([$idPost]);
        header("Location: ../home.php");
    } catch (PDOException $err) {
        die($err->getMessage());
    }
}
