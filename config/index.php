<?php
require_once 'koneksi.php';
$sessionUsername = $_SESSION['username'];
try {
    $sql = "SELECT u.id_user,u.email,u.username,b.photo  
    FROM `users` u
    JOIN `biodata` b
    WHERE `username` LIKE ? AND u.id_user = b.id_user";
    $qUsers = $database_connection->prepare($sql);
    $qUsers->execute([$sessionUsername]);
} catch (PDOException $x) {
    die($x->getMessage());
}
